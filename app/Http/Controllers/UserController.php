<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadIdRequest;
use App\Models\User;
use App\Services\IdValidationService;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    protected IdValidationService $idValidationService;

    public function __construct(IdValidationService $idValidationService)
    {
        $this->idValidationService = $idValidationService;
        $this->middleware('auth');
    }

    /**
     * Show ID verification form
     */
    public function showIdUploadForm()
    {
        $user = Auth::user();

        return view('user.id-verification', [
            'user' => $user,
        ]);
    }

    /**
     * Handle ID document upload
     */
    public function uploadId(UploadIdRequest $request)
    {
        $user = Auth::user();

        // Check if user is a tenant or landlord (not admin)
        if (!$user instanceof User) {
            Toastr::error('Invalid user type. Only tenants and landlords can verify ID.');
            return back();
        }

        // Get validated data
        $validated = $request->validated();

        // Process ID upload
        $result = $this->idValidationService->processIdUpload(
            $user,
            $validated['id_document'],
            $validated['id_type'],
            $validated['id_number'],
            $validated['full_name_on_id'],
            $validated['id_expiry_date']
        );

        if ($result['success']) {
            Toastr::success($result['message']);
            return redirect()->route('user.profile')->with('success', $result['message']);
        } else {
            Toastr::error($result['message']);
            return back()->withInput();
        }
    }

    /**
     * View ID verification status
     */
    public function viewIdStatus()
    {
        $user = Auth::user();
        $status = $this->idValidationService->getVerificationStatus($user);

        return view('user.id-status', [
            'user' => $user,
            'status' => $status,
        ]);
    }

    /**
     * Delete submitted ID and allow resubmission
     */
    public function deleteId()
    {
        $user = Auth::user();

        // Only allow deletion if ID is pending or rejected
        if (!$user->isIdPending() && !$user->isIdRejected()) {
            Toastr::error('Cannot delete a verified ID.');
            return back();
        }

        $success = $this->idValidationService->deleteDocument($user);

        if ($success) {
            Toastr::success('ID document deleted. You can upload a new one.');
            return redirect()->route('user.id-upload');
        } else {
            Toastr::error('Failed to delete ID document. Please try again.');
            return back();
        }
    }

    /**
     * Resubmit rejected ID
     */
    public function resubmitId()
    {
        $user = Auth::user();

        if (!$user->isIdRejected()) {
            Toastr::info('Your ID is not rejected. No need to resubmit.');
            return back();
        }

        return redirect()->route('user.id-upload');
    }

    /**
     * Check if user can perform ID-required actions
     */
    public function checkIdVerification()
    {
        $user = Auth::user();

        if (!$user->canPerformIdRequiredActions()) {
            $status = $user->getIdVerificationStatus();

            return response()->json([
                'verified' => false,
                'status' => $status,
                'message' => match ($status) {
                    'not_submitted' => 'Please submit your ID for verification to continue.',
                    'pending' => 'Your ID is being verified. Please wait for approval.',
                    'rejected' => 'Your ID was rejected. Please resubmit with better clarity.',
                    'expired' => 'Your ID has expired. Please resubmit a valid ID.',
                    default => 'Please complete ID verification to continue.',
                },
            ], 403);
        }

        return response()->json([
            'verified' => true,
            'status' => 'approved',
            'message' => 'ID is verified.',
        ]);
    }
}
