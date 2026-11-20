<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\AccountController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Public product routes
Route::get('/', [ProductController::class, 'index']);
Route::get('/category/{slug}', [ProductController::class, 'category']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Guest-only authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated customer routes
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
