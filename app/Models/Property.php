<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;
use App\Models\PropertyGallery;
use App\Support\PublicImage;


class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'title_verification_status' => 'pending',
    ];

    public function isTitleVerified(): bool
    {
        return $this->title_verification_status === 'approved';
    }

    public function getTitleVerificationBadgeAttribute(): string
    {
        return match($this->title_verification_status) {
            'approved' => '<span class="badge badge-success">✓ Approved</span>',
            'rejected' => '<span class="badge badge-danger">✗ Rejected</span>',
            default    => '<span class="badge badge-warning">⏳ Pending</span>',
        };
    }


    public function landlord()
    {
        return $this->belongsTo(Admin::class, 'landlord_id');
    }


    public function gallery()
    {
        return $this->hasMany(PropertyGallery::class, 'property_id');
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'property_id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function getThumbnailUrlAttribute()
    {
        return PublicImage::url($this->thumbnail);
    }
}
