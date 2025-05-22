<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleTasks = [
            'Complete Project Proposal',
            'Review Code Changes',
            'Update Documentation',
            'Client Meeting',
            'Team Standup'
        ];

        foreach (range(1, 5) as $userId) {
            foreach ($sampleTasks as $taskTitle) {
                Task::create([
                    'title' => $taskTitle,
                    'content' => 'This is a sample task description for ' . $taskTitle,
                    'is_completed' => false,
                    'due_date' => now()->addDays(rand(1, 30)),
                    'user_id' => $userId,
                    'category_id' => Category::inRandomOrder()->first()->id,
                ]);
            }
        }
    }
}
