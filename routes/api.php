<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthLoginController;
use App\Http\Controllers\Api\AuthRegisterController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UpdateEmailController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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
Route::post('send_email', [UpdateEmailController::class, 'sendemail'])->middleware('auth:sanctum');
Route::post('update_email', [UpdateEmailController::class, 'updateemail'])->middleware('auth:sanctum');
Route::post('change_password', [ChangePasswordController::class, 'changepassword'])->middleware('auth:sanctum');
Route::apiResource('ads', AdController::class)->only('index','show');
Route::apiResource('services', ServiceController::class);
