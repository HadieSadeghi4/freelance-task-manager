<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    // Freelancer submits a proposal
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        // Prevent duplicate proposals
        if (Proposal::where('task_id', $task->id)->where('freelancer_id', Auth::id())->exists()) {
            return response()->json(['message' => 'You already submitted a proposal for this task.'], 409);
        }

        $proposal = Proposal::create([
            'task_id' => $task->id,
            'freelancer_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Proposal submitted successfully.', 'proposal' => $proposal]);
    }

    // Client views proposals for a specific task
    public function index(Task $task)
    {
        //$this->authorize('view', $task);  Optional: implement policy
        $proposals = $task->proposals()->with('freelancer')->get();
        return response()->json($proposals);
    }

    // Client accepts a proposal
    public function accept(Proposal $proposal)
    {
        $proposal->status = 'accepted';
        $proposal->save();

        // Update the task
        $task = $proposal->task;
        $task->freelancer_id = $proposal->freelancer_id;
        $task->status = 'assigned';
        $task->save();

        return response()->json(['message' => 'Proposal accepted. Task assigned.']);
    }

    // Client rejects a proposal
    public function reject(Proposal $proposal)
    {
        $proposal->status = 'rejected';
        $proposal->save();
        $proposal->refresh();
        dd($proposal);

        return response()->json(['message' => 'Proposal rejected.']);
    }
}
