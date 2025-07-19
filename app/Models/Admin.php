<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Property;

class Admin extends  Authenticatable
{
    use HasFactory;

    protected $guarded = [];


    public function properties(){

        return $this->hasMany(Property::class, 'landlord_id');
    }

    public function withdraws(){

        return $this->hasMany(Withdraw::class, 'landlord_id');
    }
}
