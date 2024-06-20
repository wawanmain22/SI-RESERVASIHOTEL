<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisKamarController;
use App\Http\Controllers\ResepsionisController;

// Route default untuk mengarahkan ke halaman login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk login dan register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk bagian admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/resepsionis', [ResepsionisController::class, 'index'])->name('resepsionis.index');
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::get('/jenis-kamar', [JenisKamarController::class, 'index'])->name('jenis-kamar.index');
});

// Route untuk bagian resepsionis (dikosongkan sementara)
Route::middleware(['auth:resepsionis'])->group(function () {
    // Tambahkan route khusus resepsionis di sini
});
