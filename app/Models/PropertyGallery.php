<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
