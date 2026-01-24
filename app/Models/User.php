<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'rental_policy_accepted',
        'rental_policy_accepted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'rental_policy_accepted' => 'boolean',
            'rental_policy_accepted_at' => 'datetime',
        ];
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function userDetails(){
        return $this->hasOne(UserDetail::class);
    }

    /**
     * Check if user has submitted ID for verification
     */
    public function hasSubmittedId(): bool
    {
        return $this->id_submitted_at !== null;
    }

    /**
     * Check if user's ID is verified and approved
     */
    public function isIdVerified(): bool
    {
        return $this->id_verified === true;
    }

    /**
     * Check if user's ID verification is pending
     */
    public function isIdPending(): bool
    {
        $userDetails = $this->userDetails;
        return $userDetails && $userDetails->id_verification_status === 'pending';
    }

    /**
     * Check if user's ID was rejected
     */
    public function isIdRejected(): bool
    {
        $userDetails = $this->userDetails;
        return $userDetails && $userDetails->id_verification_status === 'rejected';
    }

    /**
     * Get reason why ID was rejected
     */
    public function getIdRejectionReason(): ?string
    {
        $userDetails = $this->userDetails;
        return $userDetails ? $userDetails->verification_notes : null;
    }

    /**
     * Check if ID is expired
     */
    public function isIdExpired(): bool
    {
        $userDetails = $this->userDetails;
        if (!$userDetails || !$userDetails->id_expiry_date) {
            return true;
        }
        return $userDetails->id_expiry_date < now()->toDateString();
    }

    /**
     * Get days until ID expires
     */
    public function getDaysUntilIdExpiry(): ?int
    {
        $userDetails = $this->userDetails;
        if (!$userDetails || !$userDetails->id_expiry_date) {
            return null;
        }
        return now()->diffInDays($userDetails->id_expiry_date);
    }

    /**
     * Check if user can perform actions that require ID verification
     * (e.g., sign lease agreement as tenant, publish as landlord)
     */
    public function canPerformIdRequiredActions(): bool
    {
        return $this->isIdVerified() && !$this->isIdExpired();
    }

    /**
     * Get ID verification status badge
     */
    public function getIdStatusBadge(): string
    {
        if ($this->isIdVerified()) {
            return '<span class="badge badge-success">✓ ID Verified</span>';
        }
        if ($this->isIdPending()) {
            return '<span class="badge badge-warning">⏳ Pending</span>';
        }
        if ($this->isIdRejected()) {
            return '<span class="badge badge-danger">✗ Rejected</span>';
        }
        return '<span class="badge badge-secondary">Not Submitted</span>';
    }

    /**
     * Get ID verification status for display
     */
    public function getIdVerificationStatus(): string
    {
        if (!$this->hasSubmittedId()) {
            return 'not_submitted';
        }
        if ($this->isIdRejected()) {
            return 'rejected';
        }
        if ($this->isIdPending()) {
            return 'pending';
        }
        if ($this->isIdVerified()) {
            return $this->isIdExpired() ? 'expired' : 'approved';
        }
        return 'unknown';
    }
}
