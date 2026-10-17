<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;

Route::get('/', fn () => redirect()->route('admin.dashboard'));

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard', [
        'title' => 'Dashboard Admin',
    ]);
})->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('layanan', LayananController::class)
        ->except(['show']);
});

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

    Route::middleware('role:pelanggan')->prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/dashboard', fn () => view('pelanggan.dashboard', [
            'title' => 'Dashboard Pelanggan',
        ]))->name('dashboard');
    });
});