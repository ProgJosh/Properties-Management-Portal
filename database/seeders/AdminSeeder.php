<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '1234567890',
                'role' => 0, // Admin
                'image' => 'default.jpg',
                'status' => 1, // Active
                'address' => '123 Admin Street',
                'gender' => 'Male',
                'dob' => '1990-01-01',
                'nid' => '123456789',
                'payment_method' => 'Bank',
                'bank_name' => 'Admin Bank',
                'branch_name' => 'Main Branch',
                'account_name' => 'Admin Account',
                'account_number' => '9876543210',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Change to a secure password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
