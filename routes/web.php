<?php

use App\Http\Controllers\{UserController, AuthController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('register-user');
});

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'formLogin'])->name('login');
Route::post('loginWeb', [AuthController::class, 'loginWeb'])->name('loginWeb');

Route::view('dashboard', 'dashboard-user')->middleware('auth')->name('dashboard');
