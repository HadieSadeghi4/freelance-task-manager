<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\API\AuthenticateController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Freelancer\FreelancerController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
// Auth

Route::post('/register', [AuthenticateController::class, 'register']);
Route::post('/login', [AuthenticateController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticateController::class, 'logout']);
    Route::get('/profile', [AuthenticateController::class, 'profile']);
});

// Admin (middleware role:admin )
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('admin/users', [AdminController::class, 'allUsers']);
    Route::delete('admin/users/{id}', [AdminController::class, 'deleteUser']);
    Route::patch('admin/users/{id}/role', [AdminController::class, 'changeRole']);
    Route::get('admin/tasks', [AdminController::class, 'allTasks']);

});

// Client (middleware role:client)
Route::middleware(['auth:sanctum', 'role:client'])->group(function () {
    Route::get('client/tasks', [ClientController::class, 'myTasks']);
    Route::post('client/tasks', [ClientController::class, 'createTask']);
    Route::put('client/tasks/{id}', [ClientController::class, 'updateTask']);
    Route::get('client/tasks/{task}/proposals', [ProposalController::class, 'index']);
    Route::post('client/proposals/{proposal}/accept', [ProposalController::class, 'accept']);
    Route::post('client/proposals/{proposal}/reject', [ProposalController::class, 'reject']);

});

// Freelancer (middleware role:freelancer)
Route::middleware(['auth:sanctum', 'role:freelancer'])->group(function () {
    Route::get('freelancer/my-tasks', [FreelancerController::class, 'myTasks']);
    Route::post('freelancer/tasks/{task}/proposals', [\App\Http\Controllers\ProposalController::class, 'store']);
    Route::patch('freelancer/tasks/{id}/status', [FreelancerController::class, 'updateTaskStatus']);
    Route::get('freelancer/tasks/{id}', [FreelancerController::class, 'showTask']);
});



