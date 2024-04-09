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
        'email', 'email_confirmed_at',
        'password',
        'password_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'gender' => GenderEnum::class,
        'email_confirmed_at' => 'datetime',
        'online_at' => 'datetime',
        'password' => 'hashed',
        'password_at' => 'datetime',
    ];

    public function getFullName(): string
    {
        return implode(' ', array_filter(
            [$this->first_name, $this->middle_name, $this->last_name],
        ));
    }

    public function updatePassword(string $password): bool
    {
        return $this->update([
            'password' => $password,
            'password_at' => now(),
        ]);
    }

    public function isEmailConfirmed(): bool
    {
        return (bool) $this->email_confirmed_at;
    }
}
