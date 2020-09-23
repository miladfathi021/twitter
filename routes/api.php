<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function () {
    Route::get('/test', function () {
        return 'done';
    })->middleware(['auth:api']);
   require('Auth/user.php');
});
