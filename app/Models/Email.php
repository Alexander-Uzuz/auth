<?php

namespace App\Models;

use App\Enums\EmailStatusEnum;
use App\Traits\BelongsToUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory, HasFactory, HasUuid, BelongsToUser;

    protected $fillable = [
        'uuid',
        'value',
        'user_id',
        'status',
        'code'
    ];

    protected $casts = [
        'status' => EmailStatusEnum::class,
        'code' => 'encrypted',
    ];

    public static function booted(): void
    {
        self::creating(function (Email $email) {
            $email->code = code();
        });
    }

    public function updateStatus(EmailStatusEnum $status): bool
    {

        if ($this->status->is($status)) {
            return false;
        }

        return $this->update(compact('status'));
    }
}
