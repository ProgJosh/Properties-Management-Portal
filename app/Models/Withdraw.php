<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function landlord()
    {
        return $this->belongsTo(Admin::class, 'landlord_id');
    }
}
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function landlord()
    {
        return $this->belongsTo(Admin::class, 'landlord_id');
    }
}
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
