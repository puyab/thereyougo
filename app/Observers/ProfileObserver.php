<?php

namespace App\Observers;

use App\Jobs\RegisterUserToBrevo;
use App\Jobs\SyncUserToBrevo;
use App\Mail\WelcomeUser;
use App\Models\Profile;
use Mail;

class ProfileObserver
{
    /**
     * Handle the Profile "created" event.
     */
    public function created(Profile $profile): void
    {

        Mail::to($profile->user)->send(new WelcomeUser($profile->first_name . ' ' . $profile->last_name));
        dispatch(new RegisterUserToBrevo($profile->user->email, $profile));
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updated(Profile $profile): void
    {
        dispatch(new SyncUserToBrevo($profile->user->email, $profile));
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $profile): void
    {
        //
    }
}
