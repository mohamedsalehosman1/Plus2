<?php

use App\Http\Controllers\Api\AuthLoginController;
use App\Http\Controllers\Api\AuthRegisterController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\UpdateEmailController;
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
Route::post('verify_email', [VerificationController::class, 'verifyEmail']);
Route::post('resend_code', [VerificationController::class, 'resendcode']);
Route::post('request_reset_code', [ResetPasswordController::class, 'requestResetCode']);
Route::post('reset_token', [ResetPasswordController::class, 'resetToken']);
Route::post('update_password', [ResetPasswordController::class, 'updatePassword']);
Route::post('send_email', [UpdateEmailController::class, 'sendEmail'])->middleware('auth:sanctum');
Route::post('update_email', [UpdateEmailController::class, 'updateemail'])->middleware('auth:sanctum');
