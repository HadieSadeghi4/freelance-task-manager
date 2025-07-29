<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'role:client']);
    }

    public function myTasks()
    {
        $user = auth()->user();
        $tasks = $user->clientTasks()->get();
        return response()->json([
            'message' => 'Client tasks fetched successfully.',
            'tasks' => $tasks
        ]);

    }

    public function createTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task,
        ]);
    }

    public function updateTask(Request $request, $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
        ]);

        $task->update($request->only(['title', 'description']));

        return response()->json([
            'message' => 'Task updated',
            'task' => $task,
        ]);
    }
    public function assignTask(Request $request, Task $task)
    {
        $request->validate([
            'freelancer_id' => 'required|exists:users,id'
        ]);

        $task->freelancer_id = $request->freelancer_id;
        $task->status = 'assigned';
        $task->save();

        return response()->json([
            'message' => 'Task assigned successfully.',
            'task' => $task
        ]);
    }


}
