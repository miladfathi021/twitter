<?php


use App\Http\Controllers\V1\Person\PersonController;

Route::group(['middleware' => 'auth:api'], function () {
   Route::get('/{username}', [PersonController::class, 'index'])
       ->name('username.index');
});
