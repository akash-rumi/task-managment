<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Create a user for John Doe
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'), // You can set a default password
        ]);
        Employee::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'designation' => 'Software Engineer',
            'phone' => '01712345678',
            'user_id' => $user1->id,
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('password123'),
        ]);
        Employee::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'designation' => 'Project Manager',
            'phone' => '01911122233',
            'user_id' => $user2->id,
        ]);

        $user3 = User::create([
            'name' => 'Mohammad Rahman',
            'email' => 'mohammad.rahman@example.com',
            'password' => Hash::make('password123'),
        ]);
        Employee::create([
            'name' => 'Mohammad Rahman',
            'email' => 'mohammad.rahman@example.com',
            'designation' => 'Data Analyst',
            'phone' => '01819988776',
            'user_id' => $user3->id,
        ]);

        $user4 = User::create([
            'name' => 'Fatima Ahmed',
            'email' => 'fatima.ahmed@example.com',
            'password' => Hash::make('password123'),
        ]);
        Employee::create([
            'name' => 'Fatima Ahmed',
            'email' => 'fatima.ahmed@example.com',
            'designation' => 'UX Designer',
            'phone' => '01612345670',
            'user_id' => $user4->id,
        ]);

        $user5 = User::create([
            'name' => 'Rashid Khan',
            'email' => 'rashid.khan@example.com',
            'password' => Hash::make('password123'),
        ]);
        Employee::create([
            'name' => 'Rashid Khan',
            'email' => 'rashid.khan@example.com',
            'designation' => 'System Administrator',
            'phone' => '01519876543',
            'user_id' => $user5->id,
        ]);
    }
}
