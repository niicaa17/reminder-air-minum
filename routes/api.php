<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\WaterLogController;
use App\Http\Controllers\API\ProfileController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/waterlogs', [WaterlogController::class, 'index']);
    Route::post('/waterlogs', [WaterlogController::class, 'store']);
    Route::delete('/waterlogs/delete/{id}', [WaterlogController::class, 'destroy']);
    Route::get('/waterlogs/today/total', [WaterlogController::class, 'todayTotal']);
    Route::get('/waterlogs/today/progress', [WaterlogController::class, 'todayProgress']);
    Route::put('/profile/daily-target', [ProfileController::class, 'updateTarget']);
    Route::get('/waterlogs/all', [WaterlogController::class, 'getAllLogs']);
    Route::put('/profile/password', [ProfileController::class, 'editPassword']);
    Route::put('/profile/email', [ProfileController::class, 'editEmail']);
    Route::put('/profile/name', [ProfileController::class, 'editName']);
    Route::put('/waterlogs/edit/{id}', [WaterlogController::class, 'editLog']);
});