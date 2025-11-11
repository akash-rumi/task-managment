<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a single admin user with the necessary fields
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com', // You can change this email
            'password' => Hash::make('password123'), // Make sure to hash the password
        ]);
    }
}