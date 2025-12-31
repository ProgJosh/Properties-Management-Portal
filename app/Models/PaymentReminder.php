<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentReminder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'email_sent' => 'boolean',
        'sms_sent' => 'boolean',
        'in_app_sent' => 'boolean',
        'email_sent_at' => 'datetime',
        'sms_sent_at' => 'datetime',
        'in_app_sent_at' => 'datetime',
        'acknowledged_at' => 'datetime',
    ];

    /**
     * Get the booking associated with this reminder
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the user (tenant) associated with this reminder
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the property associated with this reminder
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get all notification logs for this reminder
     */
    public function notificationLogs()
    {
        return $this->hasMany(NotificationLog::class);
    }

    /**
     * Scope: Get pending reminders
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Get reminders for a specific date
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('due_date', $date);
    }

    /**
     * Scope: Get reminders due in X days
     */
    public function scopeDueInDays($query, $days = 5)
    {
        return $query->whereDate('due_date', '=', now()->addDays($days)->toDateString());
    }

    /**
     * Scope: Get overdue reminders
     */
    public function scopeOverdue($query)
    {
        return $query->where('reminder_type', 'overdue')
                    ->whereDate('due_date', '<', now()->toDateString());
    }

    /**
     * Scope: Get advance reminders
     */
    public function scopeAdvance($query)
    {
        return $query->where('reminder_type', 'advance');
    }

    /**
     * Check if all notifications have been sent
     */
    public function allNotificationsSent()
    {
        return $this->email_sent && $this->sms_sent && $this->in_app_sent;
    }

    /**
     * Get the number of failed notification attempts
     */
    public function getFailedAttempts()
    {
        return $this->notificationLogs()
                    ->where('status', 'failed')
                    ->count();
    }

    /**
     * Mark reminder as acknowledged by tenant
     */
    public function acknowledge()
    {
        $this->update([
            'status' => 'acknowledged',
            'acknowledged_at' => now(),
        ]);
    }

    /**
     * Get formatted due date
     */
    public function getFormattedDueDateAttribute()
    {
        return $this->due_date->format('F d, Y');
    }

    /**
     * Get days until due
     */
    public function getDaysUntilDueAttribute()
    {
        return $this->due_date->diffInDays(now());
    }

    /**
     * Check if reminder is overdue
     */
    public function isOverdueAttribute()
    {
        return $this->due_date < now()->toDateString();
    }
}
