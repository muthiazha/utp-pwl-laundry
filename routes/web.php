<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPelangganController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('pelanggan.dashboard');
    })->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('layanan', LayananController::class)->except(['show']);

        // Kelola Pesanan
        Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
        Route::patch('/pesanan/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

        // Kelola Pelanggan
        Route::get('/pelanggan', [AdminPelangganController::class, 'index'])->name('pelanggan.index');
        Route::get('/pelanggan/{pelanggan}/riwayat', [AdminPelangganController::class, 'riwayat'])->name('pelanggan.riwayat');
    });

    Route::middleware('role:pelanggan')->prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/dashboard', fn () => view('pelanggan.dashboard', ['title' => 'Dashboard Pelanggan']))->name('dashboard');

        Route::resource('pesanan', PesananController::class)->except(['show']);
        // route pelanggan dari anggota lain ditambah di sini
    });
});
