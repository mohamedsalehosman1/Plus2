<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\Vendor\AuthVendorController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::name("vendors.")->prefix('vendor')->group(function () {
    Route::get('/login', [AuthVendorController::class, 'index'])->name('login.show')->middleware(RedirectIfAuthenticated::class);
    Route::post('/login', [AuthVendorController::class, 'login'])->name('login');
    Route::post('/logout', [AuthVendorController::class, 'logout'])->name('logout');
    Route::get('profile', [VendorController::class, 'showProfile'])->name('profile');
    Route::post('update-profile', [VendorController::class, 'updateProfile'])->name('updateProfile');
    // Route::get('/login', [AuthVendorController::class, 'login'])->name('loginAsvendor');

    Route::middleware('auth:vendors')->group(function () {
        Route::get('/', function () {
            return view('layouts.home');
        })->name('home');
    });
});
