<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

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

Route::view('/registration', 'registration.index')->name('registration');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

Route::view('/login', 'login.index')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
