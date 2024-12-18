<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\AmenityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/get', [UserController::class, 'get']);
        Route::post('/logout', [UserController::class, 'logout']);
    });

    Route::prefix('questions')->group(function () {
        Route::get('', [QuestionController::class, 'getAll']);
        Route::get('{id}', [QuestionController::class, 'get']);
        Route::post('', [QuestionController::class, 'create']);
        Route::put('', [QuestionController::class, 'update']);
        Route::delete('{id}', [QuestionController::class, 'delete']);
    });

    Route::prefix('properties')->group(function () {
        Route::get('', [PropertyController::class, 'getAll']);
        Route::get('{id}', [PropertyController::class, 'get']);
        Route::post('', [PropertyController::class, 'create']);
        Route::put('', [PropertyController::class, 'update']);
        Route::delete('{id}', [PropertyController::class, 'delete']);
    });

    Route::prefix('amenities')->group(function () {
        Route::get('', [AmenityController::class, 'getAll']);
        Route::get('{id}', [AmenityController::class, 'get']);
        Route::post('', [AmenityController::class, 'create']);
        Route::put('', [AmenityController::class, 'update']);
        Route::delete('{id}', [AmenityController::class, 'delete']);
    });
});

Route::prefix('users')->group(function () {
    Route::post('', [UserController::class, 'create']);
    Route::post('/login', [UserController::class, 'login']);
});
