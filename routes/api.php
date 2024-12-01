<?php

use App\Http\Controllers\Api\AuthLoginController;
use App\Http\Controllers\Api\AuthRegisterController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/', function () {
    return 'api';
});
Route::post('register', [AuthRegisterController::class, 'register']);
Route::post('login', [AuthLoginController::class, 'login']);
Route::post('verify-email', [VerificationController::class, 'verifyEmail']);
Route::post('resendcode', [VerificationController::class, 'resendcode']);
Route::post('requestResetCode', [ResetPasswordController::class, 'requestResetCode']);
Route::post('resettoken', [ResetPasswordController::class, 'resettoken']);
