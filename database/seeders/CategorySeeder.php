<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            'Urgent',
            'Important',
            'Personal',
            'Work',
            'Home',
            'Fitnesss',
            'Shopping',
            'Travel',
            'Finance',
            'Health',
        ])->each(fn ($name) => \App\Models\Category::create(compact('name')));
    }
}
