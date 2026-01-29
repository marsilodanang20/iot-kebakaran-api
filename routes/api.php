<?php

use App\Http\Controllers\Api\SensorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Health Check
Route::get('/health', [SensorController::class, 'health']);
Route::get('/sensor', [SensorController::class, 'index']);

// Endpoints yang dilindungi API Key
Route::middleware('api.key')->group(function () {
    Route::post('/sensor', [SensorController::class, 'store']);
    Route::get('/sensor/latest', [SensorController::class, 'latest']);
    Route::get('/sensor/logs', [SensorController::class, 'logs']);
});
