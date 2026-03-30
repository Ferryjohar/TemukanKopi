<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;

// ================= USER =================
Route::get('/', function () {
    return view('welcome');
});

// OPTIONAL (biar tidak 404 kalau akses /login biasa)
Route::get('/login', function () {
    return redirect()->route('admin.login');
});


// ================= ADMIN =================
Route::prefix('admin')->group(function () {

    // ================= GUEST (BELUM LOGIN) =================
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('/login-proses', [LoginController::class, 'prosesLogin'])->name('admin.login.proses');
    });

    // ================= AUTH (SUDAH LOGIN) =================
    Route::middleware('admin.auth')->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // ================= CRUD ADMIN =================
        Route::get('/tambah', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/simpan', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');

        // 🔥 TAMBAHAN (biar lebih aman pakai POST/DELETE)
        Route::get('/hapus/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

        // ================= MENU =================
        Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
        Route::post('/menu/tambah', [MenuController::class, 'tambah'])->name('admin.menu.tambah');
        Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('admin.menu.hapus');

        // ================= LOGOUT =================
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    });

});