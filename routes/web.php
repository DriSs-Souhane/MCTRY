<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth');
});

Route::post('/login', function () {
    return back()->with('status', 'Login would be processed here');
})->name('login');

Route::post('/register', function () {
    return back()->with('status', 'Registration would be processed here');
})->name('register');