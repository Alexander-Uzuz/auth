<?php

namespace App\Console\Commands\Passwords;

use App\Enums\PasswordStatusEnum;
use App\Models\Password;
use Illuminate\Console\Command;

class ExpirePasswordsCommand extends Command
{
    protected $signature = 'app:expire-passwords-command';


    public function handle()
    {
        $this->warm('passwords');

        $this->expirePasswords();

        $this->info('Expired passwords');
    }

    private function expirePasswords(): void
    {
        Password::query()
            ->where('status', PasswordStatusEnum::pending)
            ->where('created_at', '<', now()->subHours(1))
            ->update(['status' => PasswordStatusEnum::expired]);
    }
}
