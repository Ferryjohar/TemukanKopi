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

    // CRUD ADMIN
    Route::get('/tambah', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/simpan', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/hapus/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

    // MENU (ADMIN)
    Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('/menu/tambah', [MenuController::class, 'tambah'])->name('admin.menu.tambah');
    Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('admin.menu.hapus');

    // LOGOUT
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
