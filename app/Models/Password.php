<?php

namespace App\Models;

use App\Enums\PasswordStatusEnum;
use App\Traits\BelongsToUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Password extends Model
{
    use HasFactory, HasUuid, BelongsToUser;

    protected $fillable = [
        'uuid',
        'email',
        'user_id',
        'status',
        'ip',
    ];

    protected $casts = [
        'status' => PasswordStatusEnum::class,
    ];


    public function updateStatus(PasswordStatusEnum $status): bool
    {
        if ($this->status->is($status)) {
            return false;
        }

        return $this->update(compact('status'));
    }
}
