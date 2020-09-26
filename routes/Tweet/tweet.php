<?php

use App\Http\Controllers\V1\Tweet\TweetsController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/tweets', [TweetsController::class, 'store'])
        ->name('tweets.store');
});
