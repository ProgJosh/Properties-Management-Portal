<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the commission associated with this payment
     */
    public function commission()
    {
        return $this->hasOne(Commission::class);
    }

    /**
     * Check if payment has commission
     */
    public function hasCommission()
    {
        return $this->commission()->exists();
    }

    /**
     * Get commission amount
     */
    public function getCommissionAmount()
    {
        return $this->commission?->commission_amount ?? 0;
    }

    /**
     * Get net amount after commission
     */
    public function getNetAmount()
    {
        return $this->commission?->net_amount ?? $this->amount;
    }
}

