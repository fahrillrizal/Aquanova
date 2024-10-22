<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\RecapController;

Route::get('/', fn() => view('home'));

Route::get('/recom', fn() => view('recom'))->name('recom');

// Rute Google Login
Route::get('auth/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/callback', [GoogleController::class, 'handleGoogleCallback']);

// Rute Forgot Password
Route::middleware('guest')->group(function () {
    Route::get('/regis', [AuthController::class, 'showRegisterForm'])->name('regis');
    Route::post('/regis', [AuthController::class, 'regis']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/forgot-password', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo/change', [ProfileController::class, 'updatePP'])->name('profile.photo.change');
    Route::post('/profile/photo/delete', [ProfileController::class, 'hapusPP'])->name('profile.photo.delete');
    Route::post('/profile/password/change', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('/monitoring', [DataController::class, 'index'])->name('monitoring');
    Route::get('/fetch-data', [DataController::class, 'fetchData'])->name('fetch.data');
    Route::post('/data', [DataController::class, 'store'])->name('data.store');
    Route::get('/data/{id}', [DataController::class, 'show'])->name('data.show');
    Route::put('/data/{id}', [DataController::class, 'update'])->name('data.update');
    Route::delete('/data/{id}', [DataController::class, 'destroy'])->name('data.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/recap', [RecapController::class, 'recap'])->name('recap');
