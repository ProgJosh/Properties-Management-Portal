<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Admin;
use App\Services\CommissionService;
use Illuminate\Http\Request;
use PDF;

class CommissionController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    /**
     * Display admin commission dashboard
     */
    public function dashboard()
    {
        $admin = auth()->user();
        
        if (!$admin || !$admin instanceof Admin) {
            return redirect('/');
        }

        $stats = $this->commissionService->getDashboardStats($admin->id);
        $breakdown = $this->commissionService->getAdminCommissionBreakdown($admin->id);
        $thisMonthReport = $this->commissionService->getMonthlyCommissionReport($admin->id);

        return view('admin.commission.dashboard', [
            'stats' => $stats,
            'breakdown' => $breakdown,
            'thisMonth' => $thisMonthReport,
        ]);
    }

    /**
     * Display commission history
     */
    public function history(Request $request)
    {
        $admin = auth()->user();
        
        if (!$admin || !$admin instanceof Admin) {
            return redirect('/');
        }

        $perPage = $request->get('per_page', 15);
        $commissions = Commission::getHistoryByAdmin($admin->id, $perPage);

        return view('admin.commission.history', [
            'commissions' => $commissions,
        ]);
    }

    /**
     * Display monthly commission report
     */
    public function monthlyReport(Request $request)
    {
        $admin = auth()->user();
        
        if (!$admin || !$admin instanceof Admin) {
            return redirect('/');
        }

        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $report = $this->commissionService->getMonthlyCommissionReport($admin->id, $year, $month);

        return view('admin.commission.monthly-report', [
            'report' => $report,
            'year' => $year,
            'month' => $month,
        ]);
    }

    /**
     * Display yearly commission report
     */
    public function yearlyReport(Request $request)
    {
        $admin = auth()->user();
        
        if (!$admin || !$admin instanceof Admin) {
            return redirect('/');
        }

        $year = $request->get('year', now()->year);
        $report = $this->commissionService->getYearlyCommissionReport($admin->id, $year);

        return view('admin.commission.yearly-report', [
            'report' => $report,
        ]);
    }

    /**
     * Download commission report as PDF
     */
    public function downloadPDF(Request $request)
    {
        $admin = auth()->user();
        
        if (!$admin || !$admin instanceof Admin) {
            return redirect('/');
        }

        $type = $request->get('type', 'monthly'); // monthly or yearly
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        if ($type === 'monthly') {
            $report = $this->commissionService->getMonthlyCommissionReport($admin->id, $year, $month);
            $pdf = PDF::loadView('admin.commission.pdf.monthly', [
                'admin' => $admin,
                'report' => $report,
            ]);
            $filename = "commission-report-{$year}-{$month}.pdf";
        } else {
            $report = $this->commissionService->getYearlyCommissionReport($admin->id, $year);
            $pdf = PDF::loadView('admin.commission.pdf.yearly', [
                'admin' => $admin,
                'report' => $report,
            ]);
            $filename = "commission-report-{$year}.pdf";
        }

        return $pdf->download($filename);
    }

    /**
     * Display commission statistics API endpoint
     */
    public function stats()
    {
        $admin = auth()->user();
        
        if (!$admin || !$admin instanceof Admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $stats = $this->commissionService->getDashboardStats($admin->id);
        
        return response()->json($stats);
    }

    /**
     * Display API for commission history
     */
    public function historyApi(Request $request)
    {
        $admin = auth()->user();
        
        if (!$admin || !$admin instanceof Admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $perPage = $request->get('per_page', 15);
        $commissions = Commission::getHistoryByAdmin($admin->id, $perPage);

        return response()->json($commissions);
    }
}
