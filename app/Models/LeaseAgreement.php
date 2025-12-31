<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class LeaseAgreement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_id',
        'tenant_id',
        'landlord_id',
        'property_id',
        'start_date',
        'end_date',
        'monthly_rent',
        'security_deposit',
        'terms_and_conditions',
        'additional_terms',
        'status',
        'tenant_signed_at',
        'landlord_signed_at',
        'tenant_signature_path',
        'landlord_signature_path',
        'agreement_document_path',
        'tenant_notes',
        'landlord_notes',
        'sent_to_tenant_at',
        'sent_to_landlord_at',
        'executed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'additional_terms' => 'json',
        'tenant_signed_at' => 'datetime',
        'landlord_signed_at' => 'datetime',
        'sent_to_tenant_at' => 'datetime',
        'sent_to_landlord_at' => 'datetime',
        'executed_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function landlord()
    {
        return $this->belongsTo(Admin::class, 'landlord_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSignedByTenant($query)
    {
        return $query->where('status', 'signed_by_tenant');
    }

    public function scopeSignedByLandlord($query)
    {
        return $query->where('status', 'signed_by_landlord');
    }

    public function scopeExecuted($query)
    {
        return $query->where('status', 'executed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeExpired($query)
    {
        return $query->where('end_date', '<', now()->toDateString());
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'executed')
            ->where('start_date', '<=', now()->toDateString())
            ->where('end_date', '>=', now()->toDateString());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'executed')
            ->where('start_date', '>', now()->toDateString());
    }

    public function scopeByTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public function scopeByLandlord($query, $landlordId)
    {
        return $query->where('landlord_id', $landlordId);
    }

    public function scopeByProperty($query, $propertyId)
    {
        return $query->where('property_id', $propertyId);
    }

    /**
     * Accessors
     */
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date?->format('M d, Y');
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date?->format('M d, Y');
    }

    public function getDaysRemainingAttribute()
    {
        if ($this->status !== 'executed') {
            return null;
        }
        
        $days = now()->diffInDays($this->end_date, false);
        return $days > 0 ? $days : 0;
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'executed' &&
               $this->start_date <= now()->toDateString() &&
               $this->end_date >= now()->toDateString();
    }

    public function getIsExpiredAttribute()
    {
        return $this->end_date < now()->toDateString();
    }

    public function getIsFullySignedAttribute()
    {
        return $this->tenant_signed_at && $this->landlord_signed_at;
    }

    public function getTenantSignedStatusAttribute()
    {
        if ($this->tenant_signed_at) {
            return 'Signed on ' . $this->tenant_signed_at->format('M d, Y at h:i A');
        }
        return 'Not signed';
    }

    public function getDurationInMonths()
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }
        return $this->start_date->diffInMonths($this->end_date);
    }

    public function isActive()
    {
        return $this->status === 'executed' &&
               $this->start_date <= now()->toDateString() &&
               $this->end_date >= now()->toDateString();
    }

    public function isCompleted()
    {
        return $this->status === 'executed' && $this->end_date < now()->toDateString();
    }

    public function isSigned()
    {
        return $this->tenant_signed_at && $this->landlord_signed_at;
    }

    public function getLandlordSignedStatusAttribute()
    {
        if ($this->landlord_signed_at) {
            return 'Signed on ' . $this->landlord_signed_at->format('M d, Y at h:i A');
        }
        return 'Not signed';
    }

    /**
     * Methods
     */
    public function signByTenant($signaturePath = null)
    {
        if ($this->status === 'pending' || $this->status === 'signed_by_landlord') {
            $this->update([
                'tenant_signed_at' => now(),
                'tenant_signature_path' => $signaturePath,
                'status' => $this->status === 'signed_by_landlord' ? 'executed' : 'signed_by_tenant',
            ]);

            // If both have signed, update executed_at
            if ($this->is_fully_signed) {
                $this->update(['executed_at' => now()]);
            }

            return true;
        }
        return false;
    }

    public function signByLandlord($signaturePath = null)
    {
        if ($this->status === 'pending' || $this->status === 'signed_by_tenant') {
            $this->update([
                'landlord_signed_at' => now(),
                'landlord_signature_path' => $signaturePath,
                'status' => $this->status === 'signed_by_tenant' ? 'executed' : 'signed_by_landlord',
            ]);

            // If both have signed, update executed_at
            if ($this->is_fully_signed) {
                $this->update(['executed_at' => now()]);
            }

            return true;
        }
        return false;
    }

    public function cancel($reason = null)
    {
        $this->update([
            'status' => 'cancelled',
            'tenant_notes' => $reason,
        ]);
        return true;
    }

    /**
     * Check if lease is currently during the agreement period
     * 
     * @return bool
     */
    public function isDuringAgreementPeriod()
    {
        return $this->status === 'executed' &&
               $this->start_date <= now()->toDateString() &&
               $this->end_date >= now()->toDateString();
    }

    /**
     * Check if lease agreement can be deleted
     * Active leases cannot be deleted until end date
     * 
     * @return bool
     */
    public function canBeDeleted()
    {
        // Cannot delete if currently active/executing
        if ($this->isDuringAgreementPeriod()) {
            return false;
        }

        // Cannot delete if status is executed but not expired
        if ($this->status === 'executed' && !$this->isCompleted()) {
            return false;
        }

        // Can delete: pending, cancelled, or expired
        return true;
    }

    /**
     * Get reason why lease cannot be deleted
     * 
     * @return string|null
     */
    public function getDeletionBlockReason()
    {
        if ($this->isDuringAgreementPeriod()) {
            $daysRemaining = $this->end_date->diffInDays(now());
            return "This lease agreement is currently active and cannot be deleted. The agreement ends on {$this->end_date->format('M d, Y')} ({$daysRemaining} days remaining). You may cancel this agreement instead.";
        }

        if ($this->status === 'executed' && !$this->isCompleted()) {
            return "This agreement is in executed status and cannot be deleted. Please wait until the agreement end date or cancel it if needed.";
        }

        return null;
    }

    public function regenerateDocument()
    {
        // This will trigger document generation in service
        return true;
    }

    public static function getStatusColor($status)
    {
        return match($status) {
            'pending' => 'warning',
            'signed_by_tenant' => 'info',
            'signed_by_landlord' => 'info',
            'executed' => 'success',
            'cancelled' => 'danger',
            'expired' => 'secondary',
            default => 'secondary',
        };
    }

    public static function getStatusLabel($status)
    {
        return match($status) {
            'pending' => 'Pending Signature',
            'signed_by_tenant' => 'Tenant Signed',
            'signed_by_landlord' => 'Landlord Signed',
            'executed' => 'Active Agreement',
            'cancelled' => 'Cancelled',
            'expired' => 'Expired',
            default => 'Unknown',
        };
    }

    public static function createFromBooking(Booking $booking)
    {
        return static::create([
            'booking_id' => $booking->id,
            'tenant_id' => $booking->user_id,
            'landlord_id' => $booking->property->landlord_id,
            'property_id' => $booking->property_id,
            'start_date' => $booking->checkin,
            'end_date' => $booking->checkout,
            'monthly_rent' => $booking->amount ?? 0,
            'status' => 'pending',
        ]);
    }
}
