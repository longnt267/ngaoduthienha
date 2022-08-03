<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\TypeTourController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\TourController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route auth 
Route::group(['prefix' => 'auth'], function() {
    Route::post('/register', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify', [AuthController::class, 'verify']);
    Route::post('/resend', [AuthController::class, 'resendVerifyCode']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

Route::group(['middleware' => 'auth:api'], function() {
    // user
    Route::group(['prefix' => 'users'], function() {
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/profile', [AuthController::class, 'updateProfile']);
    });

    // destination
    Route::group(['prefix' => 'destinations'], function() {
        Route::get('/', [DestinationController::class, 'index']);
    });

    // type of tour
    Route::group(['prefix' => 'type-tours'], function() {
        Route::get('/', [TypeTourController::class, 'index']);
    });

    Route::get('/home', [HomeController::class, 'index']);

    // tours
    Route::group(['prefix' => 'tours'], function() {
        Route::get('/filter', [TourController::class, 'filter']);
    });
});
