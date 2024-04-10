<?php

namespace App\Models;

use App\Enums\EmailStatusEnum;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory, HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'value',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => EmailStatusEnum::class,
    ];

    public function updateStatus(EmailStatusEnum $status): bool
    {

        if ($this->status->is($status)) {
            return false;
        }

        return $this->update(compact('status'));
    }
}
