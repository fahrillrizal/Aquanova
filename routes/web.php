<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;

Route::get('/regis', [AuthController::class, 'showRegisterForm'])->name('regis');
Route::post('/regis', [AuthController::class, 'regis']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('auth/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo/change', [ProfileController::class, 'updatePP'])->name('profile.photo.change');
    Route::post('/profile/photo/delete', [ProfileController::class, 'hapusPP'])->name('profile.photo.delete');
    Route::post('/profile/password/change', [ProfileController::class, 'updatePassword'])->name('password.update');
});