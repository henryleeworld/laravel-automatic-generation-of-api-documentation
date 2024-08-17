<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingsController;
use App\Http\Controllers\Api\PlacesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('bookings', BookingsController::class);
    Route::post('logout',[AuthController::class, 'logout']);
    Route::get('/places', PlacesController::class);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
