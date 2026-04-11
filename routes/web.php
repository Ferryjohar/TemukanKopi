<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;

// ================= USER =================
Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');


// redirect ke login admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
});

// 🔥 ROUTE PENENTU ROLE (WAJIB)
Route::get('/home', function () {
    if (strtolower(session('role')) === 'superadmin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('admin.dashboard_khusus');
    }
})->name('admin.home');


// ================= ADMIN =================
Route::prefix('admin')->group(function () {

    // ---------- BELUM LOGIN ----------
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('/login-proses', [LoginController::class, 'prosesLogin'])->name('admin.login.proses');
    });

    // ---------- SUDAH LOGIN ----------
    Route::middleware('admin.auth')->group(function () {

        // ================= DASHBOARD =================
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard'); // SUPERADMIN
        Route::get('/dashboard-admin', [AdminController::class, 'dashboardKhusus'])->name('admin.dashboard_khusus'); // ADMIN

        // ================= DATA ADMIN =================
        Route::get('/tambah-admin', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/simpan-admin', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit-admin/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/update-admin/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::get('/hapus-admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

        // ================= TRANSAKSI =================
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi');
        Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'detail'])->name('admin.transaksi.detail');
        Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
        Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
        Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

        // ================= PRODUK =================
        Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
        Route::get('/menu/tambah', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::post('/menu/simpan', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('/menu/edit/{id_produk}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/menu/update/{id_produk}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::get('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('admin.menu.hapus');
        
        // ================= KATEGORI & JENIS =================
        Route::get('/kategori', [MenuController::class, 'kategoriIndex'])->name('admin.kategori');
        Route::post('/kategori/simpan', [MenuController::class, 'kategoriStore'])->name('admin.kategori.store');
        Route::get('/kategori/hapus/{id}', [MenuController::class, 'kategoriDestroy'])->name('admin.kategori.destroy');

        Route::get('/jeniskopi', [MenuController::class, 'jenisIndex'])->name('admin.jenis');
        Route::post('/jeniskopi/simpan', [MenuController::class, 'jenisStore'])->name('admin.jenis.store');
        Route::get('/jeniskopi/hapus/{id}', [MenuController::class, 'jenisDestroy'])->name('admin.jenis.destroy');

        // ================= LOGOUT =================
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});