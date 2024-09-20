<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;

// Rute utama
Route::get('/', fn() => view('home'));

// Rute Registrasi
Route::get('/regis', [AuthController::class, 'showRegisterForm'])->name('regis');
Route::post('/regis', [AuthController::class, 'regis']);

// Rute Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Google Login
Route::get('auth/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/callback', [GoogleController::class, 'handleGoogleCallback']);

// Rute Forgot Password
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordController::class, 'reset'])->name('password.update');
});

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo/change', [ProfileController::class, 'updatePP'])->name('profile.photo.change');
    Route::post('/profile/photo/delete', [ProfileController::class, 'hapusPP'])->name('profile.photo.delete');
    Route::post('/profile/password/change', [ProfileController::class, 'updatePassword'])->name('password.change');
});
