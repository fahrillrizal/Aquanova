<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('tes');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/regis', function () {
    return view('regis');
});