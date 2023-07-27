<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Models\Detail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SaveUserDetails
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        $user = $event->user;

        $middlename = $user->middlename ? ucfirst($user->middlename[0]) . '.' : null;

        $format = '%s %s %s';
        $fullName = sprintf(
            $format,
            $user->firstname,
            $middlename,
            $user->lastname
        );

        $gender = match ($user->prefixname) {
            'Mr' => 'Male',
            'Mrs', 'Ms' => 'Female',
            default => null,
        };

        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Full Name'],
            ['value' => $fullName, 'type' => 'bio']
        );

        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Middle Initial'],
            ['value' => $middlename, 'type' => 'bio']
        );

        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Avatar'],
            ['value' => $user->photo, 'type' => 'bio']
        );

        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Gender'],
            ['value' => $gender, 'type' => 'bio']
        );
    }
}
