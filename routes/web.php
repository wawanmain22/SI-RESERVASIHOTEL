<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisKamarController;
use App\Http\Controllers\Admin\ResepsionisController;
use App\Http\Controllers\Resepsionis\ResepsionisKamarController;
use App\Http\Controllers\Resepsionis\ResepsionisDashboardController;
use App\Http\Controllers\Resepsionis\ResepsionisProfileController;
use App\Http\Controllers\Resepsionis\ResepsionisPelangganController;
use App\Http\Controllers\Resepsionis\ResepsionisReservasiController;
use App\Http\Controllers\Resepsionis\ResepsionisTransaksiController;

// Route default untuk mengarahkan ke halaman login
Route::get('/', [LoginController::class, 'showLoginForm']);

// Route untuk login dan register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route dengan middleware checkrole
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
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

Route::middleware(['auth', 'checkrole:resepsionis'])->group(function () {
    Route::get('/dashboard-resepsionis', [ResepsionisDashboardController::class, 'index'])->name('resepsionis.dashboard.index');

    // Profile Routes
    Route::get('/profile-resepsionis', [ResepsionisProfileController::class, 'index'])->name('resepsionis.profile.index');

    // Reservasi Routes
    Route::get('/reservasi-resepsionis', [ResepsionisReservasiController::class, 'index'])->name('resepsionis.reservasi-resepsionis.index');
    Route::post('/reservasi-resepsionis', [ResepsionisReservasiController::class, 'store'])->name('resepsionis.reservasi-resepsionis.store');
    Route::get('/reservasi-resepsionis/{kode_reservasi}', [ResepsionisReservasiController::class, 'show'])->name('resepsionis.reservasi-resepsionis.show');
    Route::post('/reservasi-resepsionis/{kode_reservasi}/update', [ResepsionisReservasiController::class, 'update'])->name('resepsionis.reservasi-resepsionis.update');
    Route::post('/reservasi-resepsionis/{kode_reservasi}/destroy', [ResepsionisReservasiController::class, 'destroy'])->name('resepsionis.reservasi-resepsionis.destroy');

    // Kamar Routes
    Route::get('/kamar-resepsionis', [ResepsionisKamarController::class, 'index'])->name('resepsionis.kamar-resepsionis.index');
    Route::get('/kamar-resepsionis/{nomor_kamar}', [ResepsionisKamarController::class, 'show'])->name('resepsionis.kamar-resepsionis.show');

    // Pelanggan Routes
    Route::get('/pelanggan-resepsionis', [ResepsionisPelangganController::class, 'index'])->name('resepsionis.pelanggan-resepsionis.index');

    // Transaksi Routes
    Route::get('/transaksi-resepsionis', [ResepsionisTransaksiController::class, 'index'])->name('resepsionis.transaksi-resepsionis.index');
});
