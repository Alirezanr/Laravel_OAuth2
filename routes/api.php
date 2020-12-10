<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/signup', [AuthController::class, 'signup']);
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [AuthController::class, 'index']);
        Route::get('logout', [AuthController::class, 'logout']);
    });

});
