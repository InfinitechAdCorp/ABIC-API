<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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
        Route::post('', [UserController::class, 'create']); 

        Route::post('/login', [UserController::class, 'login']);       
        Route::post('/logout', [UserController::class, 'logout']);       
    });
});


