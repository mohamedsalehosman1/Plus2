<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Dashboard\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.master');
});
Route::resource('admin', AdminController::class);
// Route::get('/login', [AdminController::class, ])->name('login.show');

Route::post('/index', [AdminController::class, 'login'])->name('login');
