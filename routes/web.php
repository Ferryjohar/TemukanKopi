<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;

// ================= USER =================
Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN =================
Route::prefix('admin')->group(function () {

    // --- 1. HALAMAN GUEST ONLY (Hanya bisa diakses jika BELUM login) ---
    // Menggunakan middleware 'admin.guest' yang baru dibuat
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('/login-proses', [LoginController::class, 'prosesLogin'])->name('admin.login.proses');
    });

    // --- 2. HALAMAN PROTECTED (Hanya bisa diakses jika SUDAH login) ---
    Route::middleware('admin.auth')->group(function () {
        
    // --- 1. TRANSAKSI (Gunakan prefix agar unik) ---
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi');
    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail'])->name('admin.transaksi.detail');
    Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit'); // INI SEKARANG AMAN
    Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
    Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

    // --- 2. PRODUCT / MENU (Hapus salah satu duplikasi) ---
    Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('/menu/tambah', [MenuController::class, 'tambah'])->name('admin.menu.tambah');
    Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('admin.menu.hapus');

    // --- 3. DASHBOARD ---
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // --- 4. CRUD DATA ADMIN (Nama rute harus spesifik agar tidak menimpa transaksi) ---
    Route::get('/tambah-admin', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/simpan-admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/edit-admin/{id}', [AdminController::class, 'edit'])->name('admin.edit'); // Berbeda dengan admin.transaksi.edit
    Route::post('/update-admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/hapus-admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // --- 5. LOGOUT ---
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

}); // Penutup middleware 'admin.auth'
}); // Penutup prefix 'admin'