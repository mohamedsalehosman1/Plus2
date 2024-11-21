<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthAdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admins']
    ],
    function () {
        Route::get('/', function () {
            return view('layouts.home');
        })->name('home');

        Route::delete('admins/{admin}/forcedelete', [AdminController::class, 'forcedelete'])->name('admins.forcedelete');
        Route::get('admins/trash', [AdminController::class, 'trash'])->name('admins.trash');
        Route::get('admins/{id}/restore', [AdminController::class, 'restore'])->name('admins.restore');
        Route::resource('admins', AdminController::class);
        Route::get('profile', [AdminController::class, 'showProfile'])->name('admin.profile');
        Route::post('update-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::resource('roles', RoleController::class);


        Route::get('vendors/{id}/restore', [VendorController::class, 'restore'])->name('vendors.restore');
        Route::get('vendors/trash', [VendorController::class, 'trash'])->name('vendors.trash');
        Route::resource('vendors', VendorController::class);
        Route::delete('vendors/{vendor}/forcedelete', [VendorController::class, 'forcedelete'])->name('vendors.forcedelete');
        Route::resource('coupons', CouponController::class);
    }
);
Route::put('coupons/update-status/{coupon}', [CouponController::class, 'updateStatus'])->name('coupons.updateStatus');

Route::get('/login', [AuthAdminController::class, 'index'])->name('login.show')->middleware(RedirectIfAuthenticated::class);
Route::post('/login', [AuthAdminController::class, 'login'])->name('login');
Route::post('/logout', [AuthAdminController::class, 'logout'])->name('logout');
