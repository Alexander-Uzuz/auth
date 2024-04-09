<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password\StoreRequest;
use App\Models\Password;
use App\Models\User;
use App\Notifications\Password\ConfirmNotification;
use Auth;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function store(StoreRequest $request)
    {
        $email = $request->input('email');
        $ip = $request->ip();

        $user = User::query()->where(compact('email'))->first();
        $password = Password::query()->create(compact('ip', 'email') + ['user_id' => $user?->id]);

        $user?->notify(new ConfirmNotification($password));

        return to_route('password.confirm');
    }

    public function edit(Password $password)
    {
        abort_unless($password->user_id, 404);

        return view('password.edit', compact('password'));
    }

    public function update(Request $request, Password $password)
    {
        abort_unless($password->uuid, 404);

        $user = $password->user;
        /**@var User */
        $user->updatePassword($request->input('password'));

        Auth::login($user);

        return to_route('login');
    }
}
