<?php

use App\Http\Controllers\V1\Tweet\TweetsController;

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/tweets', [TweetsController::class, 'index'])
        ->name('tweets.index');

    Route::get('/tweets/{tweet}', [TweetsController::class, 'show'])
        ->name('tweets.show')
        ->middleware('can:show,tweet');

    Route::post('/tweets', [TweetsController::class, 'store'])
        ->name('tweets.store');

    Route::patch('/tweets/{tweet}', [TweetsController::class, 'update'])
        ->name('tweets.update')
        ->middleware('can:update,tweet');

    Route::delete('/tweets/{tweet}', [TweetsController::class, 'destroy'])
        ->name('tweets.destroy')
        ->middleware('can:destroy,tweet');
});
