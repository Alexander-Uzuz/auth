<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\User\SettingsController;
use App\Http\Controllers\User\Settings\ProfileController;
use App\Http\Controllers\User\Settings\PasswordController as UserPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/registration');

Route::middleware('guest')->group(function () {

    Route::view('/registration', 'registration.index')->name('registration');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

    Route::view('/login', 'login.index')->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::view('/password', 'password.index')->name('password');
    Route::post('/password', [PasswordController::class, 'store'])->name('password.store');
    Route::view('/password/confirm', 'password.confirm')->name('password.confirm');
    Route::get('/password/{password:uuid}', [PasswordController::class, 'edit'])->name('password.edit')->whereUuid('password');
    Route::post('/password/{password:uuid}', [PasswordController::class, 'update'])->name('password.update')->whereUuid('password');
});

Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'online'])->group(function () {
    Route::redirect('/user', '/user/settings')->name('user');
    Route::get('/user/settings', [SettingsController::class, 'index'])->name('user.settings');
    Route::get('/user/settings/profile', [ProfileController::class, 'edit'])->name('user.settings.profile.edit');
    Route::post('/user/settings/profile', [ProfileController::class, 'update'])->name('user.settings.profile.update');
    Route::get('/user/settings/password', [UserPasswordController::class, 'edit'])->name('user.settings.password.edit');
    Route::post('/user/settings/password', [UserPasswordController::class, 'update'])->name('user.settings.password.update');
});
