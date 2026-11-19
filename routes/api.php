<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionBatchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']);

    Route::apiResource('users', UserController::class)->except(['store']);
    Route::apiResource('workshops', WorkshopController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('batches', ProductionBatchController::class);
    Route::apiResource('reports', ReportController::class);
});
