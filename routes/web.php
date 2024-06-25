<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisKamarController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Route default untuk mengarahkan ke halaman login
Route::get('/', [LoginController::class, 'showLoginForm']);

// Route untuk login dan register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk bagian admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Resepsionis Routes
    Route::get('/resepsionis', [ResepsionisController::class, 'index'])->name('admin.resepsionis.index');
    Route::post('/resepsionis', [ResepsionisController::class, 'store'])->name('admin.resepsionis.store');
    Route::get('/resepsionis/{username}', [ResepsionisController::class, 'show'])->name('admin.resepsionis.show');
    Route::get('/resepsionis/{username}/edit', [ResepsionisController::class, 'edit'])->name('admin.resepsionis.edit');
    Route::put('/resepsionis/{username}', [ResepsionisController::class, 'update'])->name('admin.resepsionis.update');
    Route::delete('/resepsionis/{username}', [ResepsionisController::class, 'destroy'])->name('admin.resepsionis.destroy');

    // Jenis Kamar Routes
    Route::get('/jenis-kamar', [JenisKamarController::class, 'index'])->name('admin.jenis-kamar.index');
    Route::post('/jenis-kamar', [JenisKamarController::class, 'store'])->name('admin.jenis-kamar.store');
    Route::get('/jenis-kamar/{nama}', [JenisKamarController::class, 'show'])->name('admin.jenis-kamar.show');
    Route::put('/jenis-kamar/{nama}', [JenisKamarController::class, 'update'])->name('admin.jenis-kamar.update');
    Route::delete('/jenis-kamar/{nama}', [JenisKamarController::class, 'destroy'])->name('admin.jenis-kamar.destroy');

    // Kamar Routes
    Route::get('/kamar', [KamarController::class, 'index'])->name('admin.kamar.index');
    Route::post('/kamar', [KamarController::class, 'store'])->name('admin.kamar.store');
    Route::get('/kamar/{nomor_kamar}', [KamarController::class, 'show'])->name('admin.kamar.show');
    Route::put('/kamar/{nomor_kamar}', [KamarController::class, 'update'])->name('admin.kamar.update');
    Route::delete('/kamar/{nomor_kamar}', [KamarController::class, 'destroy'])->name('admin.kamar.destroy');


    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});

// Route untuk bagian resepsionis (dikosongkan sementara)
Route::middleware(['auth:resepsionis'])->group(function () {
    // Tambahkan route khusus resepsionis di sini
});
