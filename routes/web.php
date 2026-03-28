<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController; // Tambahkan ini

// ================= USER =================
Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN =================
Route::prefix('admin')->group(function () {

    // Halaman Login & Proses
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login-proses', [LoginController::class, 'prosesLogin'])->name('admin.login.proses');

    // Dashboard & Fitur Admin lainnya
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
