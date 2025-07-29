<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'role:freelancer']);
    }

    public function myTasks()
    {
        $user = auth()->user();
        $tasks = $user->tasks;
        return response()->json($tasks);
    }

    public function updateTaskStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = auth()->user()->tasks()->findOrFail($id);
        $task->status = $request->status;
        $task->save();

        return response()->json([
            'message' => 'Task status updated',
            'task' => $task,
        ]);
    }

    public function showTask($id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        return response()->json($task);
    }

}
