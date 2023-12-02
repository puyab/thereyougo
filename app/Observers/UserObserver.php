<?php

namespace App\Observers;

use App\Jobs\RegisterUserToBrevo;
use App\Mail\WelcomeUser;
use App\Models\User;
use Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $new_user = User::query()->where('id', $user->id)->with('profile')->first();

        dispatch(new RegisterUserToBrevo($new_user));
        Mail::to($user)->send(new WelcomeUser($user->profile->first_name . ' ' . $user->profile->last_name));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
