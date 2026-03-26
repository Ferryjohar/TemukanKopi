<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
use App\Http\Controllers\LoginController;

Route::get('/login', function () {
    return view('login'); // pastikan file Anda bernama login.blade.php
})->name('login');

Route::post('/login-proses', [LoginController::class, 'prosesLogin'])->name('login.proses');