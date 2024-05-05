<?php

namespace App\Models;

use App\Enums\SocialEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'driver',
        'driver_user_id',
    ];

    protected $casts = [
        'driver' => SocialEnum::class,
    ];
}
