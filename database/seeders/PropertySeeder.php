<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::create([
            'landlord_id' => 1,
            'name' => 'DENIELLE LEEN APARTMENT',
            'description' => 'A clean and affordable apartment in San Miguel',
            'address' => 'San Miguel',
            'barangay' => 'San Miguel',
            'price' => 10000,
            'status' => 1,
            'bedroom' => 2,
        ]);

        Property::create([
            'landlord_id' => 1,
            'name' => 'GUIAO APARTMENT',
            'description' => 'A 2 story Apartment roadside with parking space',
            'address' => 'San Juan Bautista',
            'barangay' => 'San Juan Bautista',
            'price' => 5000,
            'status' => 1,
            'bedroom' => 1,
        ]);

        Property::create([
            'landlord_id' => 1,
            'name' => 'GOZUM APARTMENT',
            'description' => 'Along sideroad with parking, near Chapel and Convenience Store',
            'address' => 'San Juan Nepomuceno',
            'barangay' => 'San Juan Nepomuceno',
            'price' => 8000,
            'status' => 1,
            'bedroom' => 2,
        ]);
    }
}
