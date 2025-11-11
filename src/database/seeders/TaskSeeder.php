<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Task;
use Faker\Factory as Faker;


class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            Task::create([
            'employee_id' => $faker->numberBetween(1, 5),
            'status' => $faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'due_date' => $faker->date(),
            'description' => $faker->sentence(),
            'title' => $faker->sentence(3),
            ]);
        }
    }
}