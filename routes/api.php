<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\PropertyController;
use App\Http\Controllers\API\Admin\CertificateController;
use App\Http\Controllers\API\Admin\ScheduleController;
use App\Http\Controllers\API\Admin\SubmissionController;
use App\Http\Controllers\API\Admin\TestimonialController;
use App\Http\Controllers\API\Admin\PartnerController;
use App\Http\Controllers\API\Admin\ItemController;
use App\Http\Controllers\API\Admin\SeminarController;
use App\Http\Controllers\API\Admin\MeetingController;
use App\Http\Controllers\API\Admin\EventController;
use App\Http\Controllers\API\Admin\ClosedDealController;
use App\Http\Controllers\API\Admin\NewsController;
use App\Http\Controllers\API\Admin\AmenityController;
use App\Http\Controllers\API\Admin\CareerController;
use App\Http\Controllers\API\Admin\ApplicationController;

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
});

// Route::middleware('auth.admin')->group(function () {
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

    Route::prefix('testimonials')->group(function () {
        Route::get('', [TestimonialController::class, 'getAll']);
        Route::get('{id}', [TestimonialController::class, 'get']);
        Route::post('', [TestimonialController::class, 'create']);
        Route::put('', [TestimonialController::class, 'update']);
        Route::delete('{id}', [TestimonialController::class, 'delete']);
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

    Route::prefix('seminars')->group(function () {
        Route::get('', [SeminarController::class, 'getAll']);
        Route::get('{id}', [SeminarController::class, 'get']);
        Route::post('', [SeminarController::class, 'create']);
        Route::put('', [SeminarController::class, 'update']);
        Route::delete('{id}', [SeminarController::class, 'delete']);
    });

    Route::prefix('meetings')->group(function () {
        Route::get('', [MeetingController::class, 'getAll']);
        Route::get('{id}', [MeetingController::class, 'get']);
        Route::post('', [MeetingController::class, 'create']);
        Route::put('', [MeetingController::class, 'update']);
        Route::delete('{id}', [MeetingController::class, 'delete']);
    });

    Route::prefix('events')->group(function () {
        Route::get('', [EventController::class, 'getAll']);
        Route::get('{id}', [EventController::class, 'get']);
        Route::post('', [EventController::class, 'create']);
        Route::put('', [EventController::class, 'update']);
        Route::delete('{id}', [EventController::class, 'delete']);
    });

    Route::prefix('closed-deals')->group(function () {
        Route::get('', [ClosedDealController::class, 'getAll']);
        Route::get('{id}', [ClosedDealController::class, 'get']);
        Route::post('', [ClosedDealController::class, 'create']);
        Route::put('', [ClosedDealController::class, 'update']);
        Route::delete('{id}', [ClosedDealController::class, 'delete']);
    });

    Route::prefix('news')->group(function () {
        Route::get('', [NewsController::class, 'getAll']);
        Route::get('{id}', [NewsController::class, 'get']);
        Route::post('', [NewsController::class, 'create']);
        Route::put('', [NewsController::class, 'update']);
        Route::delete('{id}', [NewsController::class, 'delete']);
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
// });

Route::prefix('agent')->middleware('auth.agent')->group(function () {
    Route::post('submit-inquiry', [AgentController::class, 'submitInquiry']);
});

Route::prefix('main')->group(function () {
    Route::get('partners', [MainController::class, 'partnersGetAll']);
    Route::get('careers', [MainController::class, 'careersGetAll']);

    Route::post('submit-application', [MainController::class, 'submitApplication']);
    Route::post('submit-inquiry', [MainController::class, 'submitInquiry']);
    Route::post('submit-property', [MainController::class, 'submitProperty']);

    Route::post('old/submit-property', [MainController::class, 'oldSubmitProperty']);
});

Route::get('global/properties', [MainController::class, 'propertiesGetAll']);