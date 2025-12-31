<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'transaction_amount' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'net_amount' => 'decimal:2',
    ];

    /**
     * Get the admin that owns this commission
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the payment that triggered this commission
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Get the booking associated with this commission
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Scope to filter by admin
     */
    public function scopeByAdmin($query, $adminId)
    {
        return $query->where('admin_id', $adminId);
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter by month
     */
    public function scopeByMonth($query, $monthYear)
    {
        return $query->where('month_year', $monthYear);
    }

    /**
     * Scope to get deducted commissions only
     */
    public function scopeDeducted($query)
    {
        return $query->where('status', 'deducted');
    }

    /**
     * Scope to get pending commissions
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Get total commission for a specific admin
     */
    public static function getTotalByAdmin($adminId)
    {
        return self::byAdmin($adminId)->deducted()->sum('commission_amount');
    }

    /**
     * Get monthly commissions for a specific admin
     */
    public static function getMonthlyByAdmin($adminId, $monthYear = null)
    {
        $query = self::byAdmin($adminId)->deducted();
        
        if ($monthYear) {
            $query->byMonth($monthYear);
        }
        
        return $query->sum('commission_amount');
    }

    /**
     * Get commission statistics for admin dashboard
     */
    public static function getStatsByAdmin($adminId)
    {
        return [
            'total_commission' => self::getTotalByAdmin($adminId),
            'pending_commission' => self::byAdmin($adminId)->pending()->sum('commission_amount'),
            'total_transactions' => self::byAdmin($adminId)->count(),
            'refunded_commission' => self::byAdmin($adminId)->where('status', 'refunded')->sum('commission_amount'),
        ];
    }

    /**
     * Get commission history with pagination
     */
    public static function getHistoryByAdmin($adminId, $perPage = 15)
    {
        return self::byAdmin($adminId)
            ->with(['payment', 'booking'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
