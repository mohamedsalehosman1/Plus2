<?php

use App\Http\Controllers\Vendor\AuthVendorController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

// مسارات البائعين (Vendor Routes)
Route::name("vendors.")->prefix('vendor')->group(function () {
    // مسارات تسجيل الدخول والخروج للبائعين
    Route::get('/login', [AuthVendorController::class, 'index'])->name('login.show')->middleware(RedirectIfAuthenticated::class);
    Route::post('/login', [AuthVendorController::class, 'login'])->name('login');
    Route::post('/logout', [AuthVendorController::class, 'logout'])->name('logout');

    // حماية المسارات باستخدام Middleware للمصادقة للبائعين
    Route::middleware('auth:vendors')->group(function () {
        Route::get('/', function () {
            return view('layouts.home');
        })->name('home');
    });

});
