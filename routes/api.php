<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsValid;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login')->middleware([EnsureUserIsValid::class])->name('user.login');
    Route::get('/user/{id}/account', 'account')->middleware([EnsureTokenIsValid::class])->name('user.account');
    Route::post('/user/{id}/account', 'changePassword')->middleware([EnsureTokenIsValid::class])->name('user.account.password');
    Route::post('/user/{id}/register', 'register')->middleware([EnsureTokenIsValid::class])->name('user.register');
});
