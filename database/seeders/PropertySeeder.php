<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Property::create([
            'landlord_id' => 1,
            'address' => 'San Miguel',
            'barangay' => 'San Miguel',
            'price' => 10000,
            'status' => 1,
            'bedroom' => 2
        ]);

        Property::create([
            'landlord_id' => 1,
            'address' => 'San Juan Bautista',
            'barangay' => 'San Juan Bautista',
            'price' => 5000,
            'status' => 1,
            'bedroom' => 1
        ]);

        Property::create([
            'landlord_id' => 1,
            'address' => 'San Juan Nepomuceno',
            'barangay' => 'San Juan Nepomuceno',
            'price' => 8000,
            'status' => 1,
            'bedroom' => 2
        ]);
    }
}
