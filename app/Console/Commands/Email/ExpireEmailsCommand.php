<?php

namespace App\Console\Commands\Email;

use App\Enums\EmailStatusEnum;
use App\Models\Email;
use Illuminate\Console\Command;

class ExpireEmailsCommand extends Command
{
    protected $signature = 'emails:expire';

    public function handle()
    {
        $this->warn('Просрачивание имейлов...');

        $this->expireEmails();

        $this->info('Имейлы просрачены.');
    }

    private function expireEmails(): void
    {
        Email::query()
            ->where('status', EmailStatusEnum::pending)
            ->where('created_at', '<=', now()->subWeek())
            ->update(['status' => EmailStatusEnum::expired]);
    }
}
