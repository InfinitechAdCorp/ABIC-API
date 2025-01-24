<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\PropertyController;
use App\Http\Controllers\API\Admin\CertificateController;
use App\Http\Controllers\API\Admin\ScheduleController;
use App\Http\Controllers\API\Admin\TestimonialController;
use App\Http\Controllers\API\Admin\PartnerController;
use App\Http\Controllers\API\Admin\ItemController;
use App\Http\Controllers\API\Admin\AmenityController;
use App\Http\Controllers\API\Admin\CareerController;
use App\Http\Controllers\API\Admin\ApplicationController;
use App\Http\Controllers\API\Admin\ArticleController;
use App\Http\Controllers\API\Admin\InfrastructureController;
use App\Http\Controllers\API\Admin\InquiryController;
use App\Http\Controllers\API\Admin\ServiceController;
use App\Http\Controllers\API\AgentController;

use App\Http\Controllers\API\MainController;

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

Route::prefix('users')->group(function () {
    Route::post('', [UserController::class, 'create']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('request-reset', [UserController::class, 'requestReset']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
});

Route::middleware('auth.admin')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('', [UserController::class, 'getAll']);
        Route::get('{id}', [UserController::class, 'get']);
        Route::put('', [UserController::class, 'update']);
        Route::post('/logout', [UserController::class, 'logout']);
    });

    Route::prefix('properties')->group(function () {
        Route::get('', [PropertyController::class, 'getAll']);
        Route::get('{id}', [PropertyController::class, 'get']);
        Route::post('', [PropertyController::class, 'create']);
        Route::put('', [PropertyController::class, 'update']);
        Route::delete('{id}', [PropertyController::class, 'delete']);

        Route::post('/set-status', [PropertyController::class, 'setStatus']);
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

        Route::post('/set-status', [ScheduleController::class, 'setStatus']);
    });

    Route::prefix('amenities')->group(function () {
        Route::get('', [AmenityController::class, 'getAll']);
        Route::get('{id}', [AmenityController::class, 'get']);
        Route::post('', [AmenityController::class, 'create']);
        Route::put('', [AmenityController::class, 'update']);
        Route::delete('{id}', [AmenityController::class, 'delete']);
    });

    Route::prefix('infrastructures')->group(function () {
        Route::get('', [InfrastructureController::class, 'getAll']);
        Route::get('{id}', [InfrastructureController::class, 'get']);
        Route::post('', [InfrastructureController::class, 'create']);
        Route::put('', [InfrastructureController::class, 'update']);
        Route::delete('{id}', [InfrastructureController::class, 'delete']);
    });

    Route::prefix('testimonials')->group(function () {
        Route::get('', [TestimonialController::class, 'getAll']);
        Route::get('{id}', [TestimonialController::class, 'get']);
        Route::post('', [TestimonialController::class, 'create']);
        Route::put('', [TestimonialController::class, 'update']);
        Route::delete('{id}', [TestimonialController::class, 'delete']);
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

    Route::prefix('inquiries')->group(function () {
        Route::get('', [InquiryController::class, 'getAll']);
        Route::get('{id}', [InquiryController::class, 'get']);
        Route::post('', [InquiryController::class, 'create']);
        Route::put('', [InquiryController::class, 'update']);
        Route::delete('{id}', [InquiryController::class, 'delete']);
    });

    Route::prefix('services')->group(function () {
        Route::get('', [ServiceController::class, 'getAll']);
        Route::get('{id}', [ServiceController::class, 'get']);
        Route::post('', [ServiceController::class, 'create']);
        Route::put('', [ServiceController::class, 'update']);
        Route::delete('{id}', [ServiceController::class, 'delete']);
    });

    Route::prefix('careers')->group(function () {
        Route::get('', [CareerController::class, 'getAll']);
        Route::get('{id}', [CareerController::class, 'get']);
        Route::post('', [CareerController::class, 'create']);
        Route::put('', [CareerController::class, 'update']);
        Route::delete('{id}', [CareerController::class, 'delete']);
    });

    Route::prefix('applications')->group(function () {
        Route::get('', [ApplicationController::class, 'getAll']);
        Route::get('{id}', [ApplicationController::class, 'get']);
        Route::post('', [ApplicationController::class, 'create']);
        Route::put('', [ApplicationController::class, 'update']);
        Route::delete('{id}', [ApplicationController::class, 'delete']);
    });

    Route::prefix('articles')->group(function () {
        Route::get('', [ArticleController::class, 'getAll']);
        Route::get('{id}', [ArticleController::class, 'get']);
        Route::post('', [ArticleController::class, 'create']);
        Route::put('', [ArticleController::class, 'update']);
        Route::delete('{id}', [ArticleController::class, 'delete']);
    });
});

Route::prefix('agent')->middleware('auth.agent')->group(function () {
    Route::get('properties', [MainController::class, 'propertiesGetAll']);
    Route::get('testimonials', [AgentController::class, 'testimonialsGetAll']);

    Route::post('submit-inquiry', [AgentController::class, 'submitInquiry']);
    Route::post('submit-schedule', [AgentController::class, 'submitSchedule']);
});

Route::prefix('main')->group(function () {
    Route::get('properties', [MainController::class, 'propertiesGetAll']);
    Route::get('testimonials', [MainController::class, 'testimonialsGetAll']);
    Route::get('partners', [MainController::class, 'partnersGetAll']);
    Route::get('careers', [MainController::class, 'careersGetAll']);
    Route::get('services', [MainController::class, 'servicesGetAll']);
    Route::get('articles', [MainController::class, 'articlesGetAll']);
    Route::get('infrastructures', [MainController::class, 'infrastructuresGetAll']);

    Route::post('submit-application', [MainController::class, 'submitApplication']);
    Route::post('submit-inquiry', [MainController::class, 'submitInquiry']);
    Route::post('submit-property', [MainController::class, 'submitProperty']);
    Route::post('submit-schedule', [MainController::class, 'submitSchedule']);

    Route::post('old/submit-property', [MainController::class, 'oldSubmitProperty']);
});
