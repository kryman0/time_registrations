<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimestampController;
use App\Http\Middleware\EnsureUserIsValid;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\EnsureUserCannotCheckInOrCheckOutMoreThanOnce;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login')->middleware([EnsureUserIsValid::class])->name('user.login');
    Route::get('/user/{id}/account', 'account')->middleware([EnsureTokenIsValid::class])->name('user.account');
    Route::post('/user/{id}/account', 'changePassword')->middleware([EnsureTokenIsValid::class])->name('user.account.password');
});

Route::controller(TimestampController::class)->group(function () {
    Route::post('/user/{id}/checkin', 'checkin')->middleware([EnsureTokenIsValid::class, EnsureUserCannotCheckInOrCheckOutMoreThanOnce::class])->name('user.checkin');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/timestamps', 'show')->name('admin.timestamps');
    Route::post('/admin/timestamp/{id}/edit', 'editTimestamp')->name('admin.timestamp.edit');
});
