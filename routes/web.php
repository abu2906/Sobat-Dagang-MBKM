<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/forgotpass', function () {
    return view('forgotpass');
})->name('forgotpass');

Route::get('/resetpass', function () {
    return view('resetpass');
})->name('resetpass');

Route::get('/halal', function () {
    return view('halal');
})->name('halal');