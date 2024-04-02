<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\GenderEnum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'online_at',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'gender' => GenderEnum::class,
        'online_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullName(): string
    {
        return implode(' ', array_filter(
            [$this->first_name, $this->middle_name, $this->last_name],
        ));
    }
}
