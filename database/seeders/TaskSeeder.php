<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Task::factory(10)->create([
            'user_id' => 1,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        ]);
        \App\Models\Task::factory(10)->create([
            'user_id' => 2,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        ]);
        \App\Models\Task::factory(10)->create([
            'user_id' => 3,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        ]);
        \App\Models\Task::factory(10)->create([
            'user_id' => 4,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        ]);
        \App\Models\Task::factory(10)->create([
            'user_id' => 5,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        ]);
    }
}
