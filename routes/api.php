<?php

use App\Http\Controllers\Api\UserController;
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
    Route::post('reset', [UserController::class, 'reset']);
    Route::post('confirm-otp', [UserController::class, 'confirmOtp']);
    Route::put('reset-pass/{token}', [UserController::class, 'resetPass']);
});

//loginn middleware

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });Route::post('user/update', [UserController::class, 'update']);
    Route::post('logout', [UserController::class, 'logout']);
});

});
// hostels

//agents 