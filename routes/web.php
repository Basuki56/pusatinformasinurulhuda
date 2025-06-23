<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/form', function () {
    return view('form'); // file: resources/views/form.blade.php
})->name('form');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});


// ✅ Route GET untuk tampilkan halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// ✅ Route POST untuk proses login
Route::post('/login', [AuthController::class, 'login'])->name('login');
