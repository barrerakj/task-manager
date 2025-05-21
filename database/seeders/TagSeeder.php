<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
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
        ])->each(fn ($name) => Tag::create(compact('name')));
    }
}
