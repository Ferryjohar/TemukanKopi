<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// ================= USER =================
Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN =================
Route::prefix('admin')->group(function () {

    // Login
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('/login-proses', [LoginController::class, 'prosesLogin'])
        ->name('admin.login.proses');

    // Dashboard (HARUS LOGIN)
    Route::get('/dashboard', function () {

        // CEK SESSION LOGIN
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');

    })->name('admin.dashboard');

});