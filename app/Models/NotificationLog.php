<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Get the payment reminder associated with this log
     */
    public function paymentReminder()
    {
        return $this->belongsTo(PaymentReminder::class);
    }

    /**
     * Scope: Get logs by channel
     */
    public function scopeByChannel($query, $channel)
    {
        return $query->where('channel', $channel);
    }

    /**
     * Scope: Get failed logs
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope: Get sent logs
     */
    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }
}
