<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {

        $tasks = Task::all();
        $users = User::all();

        if ($tasks->count() == 0 || $users->count() == 0) {
            $this->command->info('No tasks or users found, skipping comments seeding.');
            return;
        }

        foreach ($tasks as $task) {
            $client = $task->client;
            $freelancer = $task->freelancer;

            if ($client) {
                Comment::create([
                    'task_id' => $task->id,
                    'user_id' => $client->id,
                    'content' => 'Client comment on task: ' . $task->title,
                ]);
            }

            if ($freelancer) {
                Comment::create([
                    'task_id' => $task->id,
                    'user_id' => $freelancer->id,
                    'content' => 'Freelancer comment on task: ' . $task->title,
                ]);
            }
        }
    }
}
