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
    
    // Profile management
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::put('/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [AccountController::class, 'updatePassword'])->name('password.update');
    
    // Address management
    Route::get('/addresses', [AccountController::class, 'addresses'])->name('addresses');
    Route::get('/addresses/create', [AccountController::class, 'createAddress'])->name('addresses.create');
    Route::post('/addresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [AccountController::class, 'editAddress'])->name('addresses.edit');
    Route::put('/addresses/{address}', [AccountController::class, 'updateAddress'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AccountController::class, 'destroyAddress'])->name('addresses.destroy');
    Route::post('/addresses/{address}/default', [AccountController::class, 'setDefaultAddress'])->name('addresses.default');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
