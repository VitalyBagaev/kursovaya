<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionBatchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'register']);
Route::post('auth', [UserController::class, 'auth']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('userGet', [UserController::class, 'userGet']);

    Route::middleware('role:admin,master,worker,inspector')->group(function () {
        Route::get('productAll', [ProductController::class, 'productAll']);
        Route::get('productGet/{product}', [ProductController::class, 'productGet']);

        Route::get('workshopAll', [WorkshopController::class, 'workshopAll']);
        Route::get('workshopGet/{workshop}', [WorkshopController::class, 'workshopGet']);

        Route::get('batchAll', [ProductionBatchController::class, 'batchAll']);
        Route::get('batchGet/{batch}', [ProductionBatchController::class, 'batchGet']);

        Route::get('reportAll', [ReportController::class, 'reportAll']);
        Route::get('reportGet/{report}', [ReportController::class, 'reportGet']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::post('productAdd', [ProductController::class, 'productAdd']);
        Route::patch('productEdit/{product}', [ProductController::class, 'productEdit']);
        Route::delete('productDelete/{product}', [ProductController::class, 'productDelete']);

        Route::post('workshopAdd', [WorkshopController::class, 'workshopAdd']);
        Route::patch('workshopEdit/{workshop}', [WorkshopController::class, 'workshopEdit']);
        Route::delete('workshopDelete/{workshop}', [WorkshopController::class, 'workshopDelete']);
    });

    Route::middleware('role:admin,master,worker')->group(function () {
        Route::post('batchAdd', [ProductionBatchController::class, 'batchAdd']);
    });

    Route::middleware('role:admin,master')->group(function () {
        Route::patch('batchEdit/{batch}', [ProductionBatchController::class, 'batchEdit']);
        Route::delete('batchDelete/{batch}', [ProductionBatchController::class, 'batchDelete']);
    });

    Route::middleware('role:admin,inspector')->group(function () {
        Route::post('reportAdd', [ReportController::class, 'reportAdd']);
        Route::patch('reportEdit/{report}', [ReportController::class, 'reportEdit']);
        Route::delete('reportDelete/{report}', [ReportController::class, 'reportDelete']);
    });
});