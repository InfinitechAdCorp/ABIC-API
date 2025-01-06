<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\CertificateController;
use App\Http\Controllers\API\ScheduleController;
use App\Http\Controllers\API\SubmissionController;
use App\Http\Controllers\API\TestimonialController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\API\ItemController;

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
        Route::get('', [UserController::class, 'getAll']);
        Route::get('{id}', [UserController::class, 'get']);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});

Route::prefix('properties')->group(function () {
    Route::get('', [PropertyController::class, 'getAll']);
    Route::get('{id}', [PropertyController::class, 'get']);
    Route::post('', [PropertyController::class, 'create']);
    Route::put('', [PropertyController::class, 'update']);
    Route::delete('{id}', [PropertyController::class, 'delete']);
});

Route::prefix('certificates')->group(function () {
    Route::get('', [CertificateController::class, 'getAll']);
    Route::get('{id}', [CertificateController::class, 'get']);
    Route::post('', [CertificateController::class, 'create']);
    Route::put('', [CertificateController::class, 'update']);
    Route::delete('{id}', [CertificateController::class, 'delete']);
});

Route::prefix('schedules')->group(function () {
    Route::get('', [ScheduleController::class, 'getAll']);
    Route::get('{id}', [ScheduleController::class, 'get']);
    Route::post('', [ScheduleController::class, 'create']);
    Route::put('', [ScheduleController::class, 'update']);
    Route::delete('{id}', [ScheduleController::class, 'delete']);

    Route::post('/change-status', [ScheduleController::class, 'changeStatus']);
});

Route::prefix('testimonials')->group(function () {
    Route::get('', [TestimonialController::class, 'getAll']);
    Route::get('{id}', [TestimonialController::class, 'get']);
    Route::post('', [TestimonialController::class, 'create']);
    Route::put('', [TestimonialController::class, 'update']);
    Route::delete('{id}', [TestimonialController::class, 'delete']);

    Route::post('/change-status', [TestimonialController::class, 'changeStatus']);
});

Route::prefix('submissions')->group(function () {
    Route::get('', [SubmissionController::class, 'getAll']);
    Route::get('{id}', [SubmissionController::class, 'get']);
    Route::post('', [SubmissionController::class, 'create']);
    Route::put('', [SubmissionController::class, 'update']);
    Route::delete('{id}', [SubmissionController::class, 'delete']);

    Route::post('/change-status', [SubmissionController::class, 'changeStatus']);
});

Route::prefix('partners')->group(function () {
    Route::get('', [PartnerController::class, 'getAll']);
    Route::get('{id}', [PartnerController::class, 'get']);
    Route::post('', [PartnerController::class, 'create']);
    Route::put('', [PartnerController::class, 'update']);
    Route::delete('{id}', [PartnerController::class, 'delete']);
});

Route::prefix('items')->group(function () {
    Route::get('', [ItemController::class, 'getAll']);
    Route::get('{id}', [ItemController::class, 'get']);
    Route::post('', [ItemController::class, 'create']);
    Route::put('', [ItemController::class, 'update']);
    Route::delete('{id}', [ItemController::class, 'delete']);
});

Route::prefix('users')->group(function () {
    Route::post('', [UserController::class, 'create']);
    Route::post('/login', [UserController::class, 'login']);
});
