<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Employee;


class EmployeeSeeder extends Seeder
{
    public function run()
    {
        Employee::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'designation' => 'Software Engineer',
            'phone' => '01712345678',
        ]);

        Employee::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'designation' => 'Project Manager',
            'phone' => '01911122233',
        ]);

        Employee::create([
            'name' => 'Mohammad Rahman',
            'email' => 'mohammad.rahman@example.com',
            'designation' => 'Data Analyst',
            'phone' => '01819988776',
        ]);

        Employee::create([
            'name' => 'Fatima Ahmed',
            'email' => 'fatima.ahmed@example.com',
            'designation' => 'UX Designer',
            'phone' => '01612345670',
        ]);

        Employee::create([
            'name' => 'Rashid Khan',
            'email' => 'rashid.khan@example.com',
            'designation' => 'System Administrator',
            'phone' => '01519876543',
        ]);
    }
}
