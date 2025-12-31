<?php

namespace App\Services;

use App\Models\Commission;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    /**
     * Commission percentage (3%)
     */
    protected const COMMISSION_PERCENTAGE = 3;

    /**
     * Process commission for a payment
     * This should be called when a payment is successfully processed
     */
    public function processPaymentCommission(Payment $payment)
    {
        try {
            DB::beginTransaction();

            $booking = $payment->booking;
            $admin = $booking->property->admin; // Assuming property belongs to admin
            $transactionAmount = (float) $payment->amount;

            // Calculate commission
            $commissionAmount = $this->calculateCommission($transactionAmount);
            $netAmount = $transactionAmount - $commissionAmount;

            // Create commission record
            $commission = Commission::create([
                'admin_id' => $admin->id,
                'payment_id' => $payment->id,
                'booking_id' => $booking->id,
                'transaction_amount' => $transactionAmount,
                'commission_percentage' => self::COMMISSION_PERCENTAGE,
                'commission_amount' => $commissionAmount,
                'net_amount' => $netAmount,
                'status' => 'deducted', // Automatically marked as deducted
                'payment_status' => 'successful',
                'month_year' => Carbon::now()->format('Y-m'),
                'notes' => "Commission for booking #{$booking->id}",
            ]);

            DB::commit();

            return $commission;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Commission processing error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Calculate commission amount based on transaction amount
     */
    public function calculateCommission($amount)
    {
        return ($amount * self::COMMISSION_PERCENTAGE) / 100;
    }

    /**
     * Get commission breakdown for an admin
     */
    public function getAdminCommissionBreakdown($adminId)
    {
        $commissions = Commission::byAdmin($adminId)->deducted()->get();

        return [
            'total_transactions' => $commissions->count(),
            'total_revenue' => $commissions->sum('transaction_amount'),
            'total_commission' => $commissions->sum('commission_amount'),
            'total_net_payout' => $commissions->sum('net_amount'),
            'commission_percentage' => self::COMMISSION_PERCENTAGE,
            'average_commission_per_transaction' => $commissions->count() > 0 
                ? $commissions->sum('commission_amount') / $commissions->count() 
                : 0,
        ];
    }

    /**
     * Get monthly commission report for an admin
     */
    public function getMonthlyCommissionReport($adminId, $year = null, $month = null)
    {
        $year = $year ?? Carbon::now()->year;
        $month = $month ?? Carbon::now()->month;
        $monthYear = Carbon::createFromDate($year, $month)->format('Y-m');

        $commissions = Commission::byAdmin($adminId)
            ->byMonth($monthYear)
            ->deducted()
            ->get();

        return [
            'month_year' => $monthYear,
            'total_transactions' => $commissions->count(),
            'total_revenue' => $commissions->sum('transaction_amount'),
            'total_commission_deducted' => $commissions->sum('commission_amount'),
            'net_payout' => $commissions->sum('net_amount'),
            'commissions' => $commissions,
        ];
    }

    /**
     * Get all monthly reports for year
     */
    public function getYearlyCommissionReport($adminId, $year = null)
    {
        $year = $year ?? Carbon::now()->year;
        $months = [];

        for ($month = 1; $month <= 12; $month++) {
            $report = $this->getMonthlyCommissionReport($adminId, $year, $month);
            if ($report['total_transactions'] > 0) {
                $months[] = $report;
            }
        }

        return [
            'year' => $year,
            'monthly_reports' => $months,
            'yearly_total_commission' => collect($months)->sum('total_commission_deducted'),
            'yearly_total_payout' => collect($months)->sum('net_payout'),
        ];
    }

    /**
     * Refund commission (in case of payment refund)
     */
    public function refundCommission(Commission $commission, $reason = null)
    {
        try {
            DB::beginTransaction();

            $commission->update([
                'status' => 'refunded',
                'payment_status' => 'refunded',
                'notes' => $reason ?? 'Commission refunded',
            ]);

            DB::commit();

            return $commission;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Commission refund error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get commission statistics dashboard
     */
    public function getDashboardStats($adminId)
    {
        $allCommissions = Commission::byAdmin($adminId);
        
        return [
            'total_commission_earned' => $allCommissions->deducted()->sum('commission_amount'),
            'pending_commission' => $allCommissions->pending()->sum('commission_amount'),
            'refunded_commission' => $allCommissions->where('status', 'refunded')->sum('commission_amount'),
            'total_transactions' => $allCommissions->count(),
            'this_month_commission' => Commission::byAdmin($adminId)
                ->byMonth(Carbon::now()->format('Y-m'))
                ->deducted()
                ->sum('commission_amount'),
        ];
    }
}
