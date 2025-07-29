<?php

namespace App\Observers;

use App\Models\user;
use Illuminate\Support\Facades\Log;


class UserObserver
{
     /**
     * Handle the user "created" event.
     */
    public function created(user $user): void
    {
        if (in_array($user->role, ['freelancer', 'client'])) {
            Log::info("User created: {$user->name} ({$user->role})");
        }
    }

    /**
     * Handle the user "updated" event.
     */
    public function updated(user $user): void
    {
        if (in_array($user->role, ['freelancer', 'client'])) {
            Log::info("User updated: {$user->name} ({$user->role})");
        }
    }

    /**
     * Handle the user "deleted" event.
     */
    public function deleted(user $user): void
    {
        if (in_array($user->role, ['freelancer', 'client'])) {
            Log::warning("User deleted: {$user->name} ({$user->role})");
        }
    }

    /**
     * Handle the user "restored" event.
     */
    public function restored(user $user): void
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     */
    public function forceDeleted(user $user): void
    {
        //
    }
}
