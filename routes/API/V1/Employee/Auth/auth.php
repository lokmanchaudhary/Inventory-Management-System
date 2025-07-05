<?php

use App\Http\Controllers\API\V1\Employee\Auth\LoginController;
use App\Http\Controllers\API\V1\Employee\Auth\PasswordResetController;
use App\Http\Controllers\API\V1\Employee\Auth\PasswordResetEmailController;

Route::prefix('auth')->group(function () {

    Route::post('/login', LoginController::class);

    //Password Reset Routes
    Route::post('/forget-password', PasswordResetEmailController::class)->middleware('throttle:6,1')->name('password.email');
    Route::post('/reset-password', PasswordResetController::class)->name('password.reset');
});
