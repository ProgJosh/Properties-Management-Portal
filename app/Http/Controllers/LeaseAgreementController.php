<?php

namespace App\Http\Controllers;

use App\Models\LeaseAgreement;
use App\Models\Booking;
use App\Services\LeaseAgreementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LeaseAgreementController extends Controller
{
    private LeaseAgreementService $leaseService;

    public function __construct(LeaseAgreementService $leaseService)
    {
        $this->leaseService = $leaseService;
    }

    /**
     * Show lease agreement for tenant signature
     */
    public function show(LeaseAgreement $agreement)
{
    $agreement->load(['tenant', 'property', 'landlord', 'booking']);

    return view('lease-agreements.show', [
        'lease' => $agreement,      // ← This is what your Blade needs!
        'agreement' => $agreement,  // ← This too, for flexibility
        'tenant' => $agreement->tenant,
        'landlord' => $agreement->landlord,
        'property' => $agreement->property,
        'booking' => $agreement->booking,
    ]);
}

    /**
     * Tenant signs the agreement
     */
    public function signByTenant(Request $request, LeaseAgreement $agreement)
    {
        // Validate user is the tenant
        if (Auth::id() !== $agreement->tenant_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: You are not the tenant of this agreement'
            ], 403);
        }

        try {
            $agreement->signByTenant();

            // Send notification to landlord
            $this->leaseService->notifyLandlordOfSignature($agreement);

            // Check if both signed
            if ($agreement->is_fully_signed) {
                $this->leaseService->generateAgreementDocument($agreement);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Agreement signed! The agreement is now active.',
                    'status' => $agreement->status,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Agreement signed successfully. Waiting for landlord signature.',
                'status' => $agreement->status,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error signing agreement: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Landlord signs the agreement (admin)
     */
    public function signByLandlord(Request $request, LeaseAgreement $agreement)
    {
        // Validate user is the landlord
        if (Auth::guard('admin')->id() !== $agreement->landlord_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: You are not the landlord of this agreement'
            ], 403);
        }

        try {
            $agreement->signByLandlord();

            // Send notification to tenant
            $this->leaseService->notifyTenantOfSignature($agreement);

            // Check if both signed
            if ($agreement->is_fully_signed) {
                $this->leaseService->generateAgreementDocument($agreement);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Agreement signed! The agreement is now active.',
                    'status' => $agreement->status,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Agreement signed successfully. Waiting for tenant signature.',
                'status' => $agreement->status,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error signing agreement: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Download lease agreement PDF
     */
    public function download(LeaseAgreement $agreement)
    {
        try {
            if (!$agreement->agreement_document_path || !Storage::exists($agreement->agreement_document_path)) {
                // Generate if not exists
                $this->leaseService->generateAgreementDocument($agreement);
            }

            $filePath = $agreement->agreement_document_path;
            $fileName = "Lease-Agreement-{$agreement->id}.pdf";

            return Storage::download($filePath, $fileName);
        } catch (\Exception $e) {
            return back()->with('error', 'Error downloading agreement: ' . $e->getMessage());
        }
    }

    /**
     * Tenant: List all agreements
     */
    public function tenantList()
    {
        $agreements = LeaseAgreement::byTenant(Auth::id())
            ->with(['property', 'landlord', 'booking'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('lease-agreements.tenant-list', compact('agreements'));
    }

    /**
     * Admin: Dashboard of all agreements
     */
    public function adminDashboard()
    {
        $stats = [
            'total' => LeaseAgreement::count(),
            'pending' => LeaseAgreement::pending()->count(),
            'executed' => LeaseAgreement::executed()->count(),
            'active' => LeaseAgreement::active()->count(),
            'expired' => LeaseAgreement::expired()->count(),
            'cancelled' => LeaseAgreement::cancelled()->count(),
        ];

        $recentAgreements = LeaseAgreement::with(['tenant', 'property', 'landlord'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $pendingSignature = LeaseAgreement::where(function ($q) {
            $q->where('status', 'pending')
              ->orWhere('status', 'signed_by_tenant')
              ->orWhere('status', 'signed_by_landlord');
        })->count();

        return view('admin.lease-agreements.dashboard', compact('stats', 'recentAgreements', 'pendingSignature'));
    }

    /**
     * Admin: List all agreements
     */
    public function adminList(Request $request)
    {
        $query = LeaseAgreement::with(['tenant', 'property', 'landlord']);

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by property
        if ($request->property_id) {
            $query->where('property_id', $request->property_id);
        }

        // Search
        if ($request->search) {
            $query->whereHas('tenant', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })
            ->orWhereHas('property', function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%");
            });
        }

        $agreements = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.lease-agreements.list', compact('agreements'));
    }

    /**
     * Admin: View agreement details
     */
    public function adminShow(LeaseAgreement $agreement)
    {
        return view('admin.lease-agreements.show', compact('agreement'));
    }

    /**
     * Tenant: Acknowledge/Accept agreement
     */
    public function acknowledge(LeaseAgreement $agreement)
    {
        if (Auth::id() !== $agreement->tenant_id) {
            return back()->with('error', 'Unauthorized');
        }

        try {
            $agreement->signByTenant();

            return back()->with('success', 'Agreement acknowledged successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error acknowledging agreement: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Send agreement to tenant
     */
    public function sendToTenant(LeaseAgreement $agreement)
    {
        try {
            $this->leaseService->sendToTenant($agreement);
            
            return back()->with('success', 'Agreement sent to tenant!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error sending agreement: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Cancel agreement
     */
    public function cancel(Request $request, LeaseAgreement $agreement)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        try {
            $agreement->cancel($request->reason);
            
            $this->leaseService->notifyOfCancellation($agreement, $request->reason);

            return back()->with('success', 'Agreement cancelled successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error cancelling agreement: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Delete agreement (only non-active agreements)
     * Active agreements cannot be deleted until end date
     */
    public function destroy(LeaseAgreement $agreement)
    {
        // Check if agreement can be deleted
        if (!$agreement->canBeDeleted()) {
            $reason = $agreement->getDeletionBlockReason();
            return back()->with('error', $reason ?? 'This agreement cannot be deleted.');
        }

        try {
            // Permanently delete from database
            $agreement->forceDelete();
            return back()->with('success', 'Agreement deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting agreement: ' . $e->getMessage());
        }
    }

    /**
     * Get agreement statistics
     */
    public function statistics()
    {
        $user = Auth::user();

        $stats = [
            'total' => LeaseAgreement::byTenant($user->id)->count(),
            'pending' => LeaseAgreement::byTenant($user->id)->pending()->count(),
            'executed' => LeaseAgreement::byTenant($user->id)->executed()->count(),
            'active' => LeaseAgreement::byTenant($user->id)->active()->count(),
            'expired' => LeaseAgreement::byTenant($user->id)->expired()->count(),
        ];

        return response()->json($stats);
    }
}
