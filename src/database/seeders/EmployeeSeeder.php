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
            'phone' => '+8801712345678',
        ]);

        Employee::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'designation' => 'Project Manager',
            'phone' => '+8801911122233',
        ]);

        Employee::create([
            'name' => 'Mohammad Rahman',
            'email' => 'mohammad.rahman@example.com',
            'designation' => 'Data Analyst',
            'phone' => '+8801819988776',
        ]);

        Employee::create([
            'name' => 'Fatima Ahmed',
            'email' => 'fatima.ahmed@example.com',
            'designation' => 'UX Designer',
            'phone' => '+8801612345670',
        ]);

        Employee::create([
            'name' => 'Rashid Khan',
            'email' => 'rashid.khan@example.com',
            'designation' => 'System Administrator',
            'phone' => '+8801519876543',
        ]);
    }
}
