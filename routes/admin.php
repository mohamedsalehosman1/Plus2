<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthAdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// مسارات المسؤولين (Admin Routes)
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admins']
    ],
    function () {
        // الصفحة الرئيسية للمسؤولين
        Route::get('/', function () {
            return view('layouts.home');
        })->name('home');

        // إدارة المسؤولين
        Route::get('admins/trash', [AdminController::class, 'trash'])->name('admins.trash');
        Route::resource('admins', AdminController::class);
        Route::delete('admins/{id}', [AdminController::class, 'delete'])->name('admins.delete');
        Route::get('admins/{id}/restore', [AdminController::class, 'restore'])->name('admins.restore');

        // إدارة الأدوار
        Route::resource('roles', RoleController::class);

        // إدارة البائعين
        Route::resource('vendors', VendorController::class);
        Route::get('vendors/trash', [VendorController::class, 'trash'])->name('vendors.trash');
        Route::delete('vendors/{id}', [VendorController::class, 'delete'])->name('vendors.delete');
        Route::get('vendors/{id}/restore', [VendorController::class, 'restore'])->name('vendors.restore');
    }
);

// مسارات تسجيل الدخول والخروج للمسؤولين
Route::get('/login', [AuthAdminController::class, 'index'])->name('login.show')->middleware(RedirectIfAuthenticated::class);
Route::post('/login', [AuthAdminController::class, 'login'])->name('login');
Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');
