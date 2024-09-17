<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;


Route::get('/', function () {
    return view('tes');
});
Route::get('/regis', [AuthController::class, 'showRegisterForm'])->name('regis');
Route::post('/regis', [AuthController::class, 'regis']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('auth/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/profile', function () {
    return view('profile');
});
