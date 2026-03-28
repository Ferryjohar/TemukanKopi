<?php

use Illuminate\Support\Facades\Route; // 🔥 INI WAJIB ADA
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;

// ================= USER =================
Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN =================
Route::prefix('admin')->group(function () {

    // LOGIN
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login-proses', [LoginController::class, 'prosesLogin'])->name('admin.login.proses');

    // DASHBOARD SUPERADMIN
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // MENU (ADMIN)
    Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('/menu/tambah', [MenuController::class, 'tambah'])->name('admin.menu.tambah');
    Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('admin.menu.hapus');

    // LOGOUT
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});