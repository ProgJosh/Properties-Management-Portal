<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'checkin' => 'date',
        'checkout' => 'date',
        'rent_due_date' => 'date',
        'next_payment_date' => 'date',
        'monthly_rent' => 'decimal:2',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function leaseAgreement()
    {
        return $this->hasOne(LeaseAgreement::class);
    }

    public function paymentReminders()
    {
        return $this->hasMany(PaymentReminder::class);
    }
}