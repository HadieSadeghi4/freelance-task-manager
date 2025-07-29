<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'role:admin']);
    }

    public function allUsers()
    {
        return User::all();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }


    public function changeRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,client,freelancer',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Role updated']);
    }
    public function allTasks()
    {
        $tasks = Task::with(['client', 'freelancer'])->latest()->get();

        return response()->json([
            'message' => 'All tasks fetched successfully.',
            'tasks' => $tasks
        ]);
    }

}
