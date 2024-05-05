<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Social;
use App\Enums\SocialEnum;
use Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect(SocialEnum $driver)
    {
        session()->flash('social_back_url', url()->previous());

        return Socialite::driver($driver->value)->redirect();
    }

    public function callback(SocialEnum $driver)
    {
        try {
            $data = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            report($e);

            return redirect(session('social_back_url', '/'));
        }

        /**@var Social */
        $social = Social::query()->firstOrCreate([
            'driver' => $driver->value,
            'driver_user_id' => $data->getId(),
        ]);

        if (is_null($social->user_id)) {
            $user = User::query()->create(['password' => Str::random(12)]);
            $social->user()->associate($user)->save();
        }

        Auth::login($social->user);

        return redirect()->intended('/user');
    }
}
