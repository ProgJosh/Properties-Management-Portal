<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;
use App\Models\PropertyGallery;


class Property extends Model
{
    use HasFactory;

    protected $guarded = [];


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
}
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;
use App\Models\PropertyGallery;


class Property extends Model
{
    use HasFactory;

    protected $guarded = [];


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
}
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
