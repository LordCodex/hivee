<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HostelsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// auth

Route::group(['middleware' => ['json.response']], function () {

    Route::prefix('v1')->group(function () {
        Route::post('auth/register', [UserController::class, 'register']);
        Route::post('auth/login', [UserController::class, 'login']);
        Route::post('auth/reset', [UserController::class, 'reset']);
        Route::post('auth/confirm-otp', [UserController::class, 'confirmOtp']);
        Route::put('auth/reset-pass/{token}', [UserController::class, 'resetPass']);
    });

    // hostels
    Route::prefix('v1')->group(function () {
        // Route::apiResource('/hostels',HostelsController::class);
        Route::get('/hostels', [HostelsController::class, 'index']);
        Route::get('/hostel/{hostel}', [HostelsController::class, 'show']);
        Route::get('/hostel/search/{name}', [HostelsController::class, 'search']);
    });
    //loginn middleware //agents 

    Route::middleware('auth:api')->prefix('v1')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::put('user/update', [UserController::class, 'update']);
        Route::post('user/verify', [UserController::class, 'verify']);
        Route::put('user/update-pass', [UserController::class, 'updatePass']);
        Route::delete('auth/logout', [UserController::class, 'logout']);
        Route::post('/hostel/create', [HostelsController::class, 'store']);
        Route::put('/hostel/update/{hostel_id}', [HostelsController::class, 'update']);
        Route::delete('/hostel/delete/{hostel}', [HostelsController::class, 'destroy']);
    });
});
