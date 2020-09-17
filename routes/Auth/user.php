<?php

use App\Http\Controllers\V1\Auth\UserLoginController;
use App\Http\Controllers\V1\Auth\UserRegisterController;

Route::post('/register', [UserRegisterController::class, 'store'])
    ->name('user-register.store');

Route::post('/login', [UserLoginController::class, 'store'])
    ->name('user-login.store');
