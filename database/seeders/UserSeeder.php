<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();
        $customerRole = Role::where('name', 'customer')->first();

        // 1. Admin User
        $admin = User::firstOrCreate(['email' => 'admin@eccommers.com'], [
            'name' => 'Hariom Admin',
            'phone' => '+91 9876543210',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole ? $adminRole->id : null,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // 2. Staff User
        $staff = User::firstOrCreate(['email' => 'staff@eccommers.com'], [
            'name' => 'Support Manager',
            'phone' => '+91 9876543211',
            'password' => Hash::make('password123'),
            'role_id' => $staffRole ? $staffRole->id : null,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // 3. Demo Customer User
        $customer = User::firstOrCreate(['email' => 'customer@eccommers.com'], [
            'name' => 'Phil Andreson',
            'phone' => '+91 9876543212',
            'password' => Hash::make('password123'),
            'role_id' => $customerRole ? $customerRole->id : null,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create sample addresses for customer
        Address::firstOrCreate(['user_id' => $customer->id, 'name' => 'Phil Andreson (Home)'], [
            'phone' => '+91 9876543212',
            'address_line_1' => 'Flat 402, Green Valley Heights',
            'address_line_2' => 'MG Road, Sector 14',
            'apartment' => 'Building B',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
            'pincode' => '400001',
            'landmark' => 'Near Central Park',
            'address_type' => 'home',
            'is_default' => true,
        ]);

        Address::firstOrCreate(['user_id' => $customer->id, 'name' => 'Phil Andreson (Office)'], [
            'phone' => '+91 9876543212',
            'address_line_1' => 'Tech Tower, 7th Floor',
            'address_line_2' => 'Cyber City',
            'city' => 'Gurugram',
            'state' => 'Haryana',
            'country' => 'India',
            'pincode' => '122002',
            'address_type' => 'work',
            'is_default' => false,
        ]);
    }
}
