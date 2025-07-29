<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TasksTableSeeder extends Seeder
{
    public function run()
    {

        $client = User::where('role', 'client')->first();
        $freelancer = User::where('role', 'freelancer')->first();

        if ($client && $freelancer) {
            Task::create([
                'client_id' => $client->id,
                'freelancer_id' => $freelancer->id,
                'title' => 'Design a Landing Page',
                'description' => 'Create a responsive landing page for our new product.',
                'status' => 'todo',
                'deadline' => now()->addDays(7),
            ]);
        }
    }
}
