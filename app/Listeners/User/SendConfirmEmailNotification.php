<?php

namespace App\Listeners\User;

use App\Models\Email;
use App\Enums\EmailStatusEnum;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmEmailNotification implements ShouldQueue
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
    public function handle(object $event): void
    {
        if ($event->user->isEmailConfirmed()) {
            return;
        }

        $email = Email::query()->create([
            'value' => $event->user->email,
            'user_id' => $event->user->id,
            'status' => EmailStatusEnum::pending,
        ]);
    }
}
