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
