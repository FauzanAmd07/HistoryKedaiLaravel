<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// CUSTOMER (PUBLIC) ROUTES
Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::get('/keranjang', [CustomerController::class, 'keranjang'])->name('keranjang');
Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
Route::post('/pesan', [CustomerController::class, 'prosesPesanan'])->name('pesan.proses');

// AUTH ROUTES (Breeze)
require __DIR__.'/auth.php';

// DASHBOARD (AUTHENTICATED) ROUTES
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::middleware(['jabatan:Kasir,Admin,Pemilik'])->group(function () {
        Route::get('/pesanan', [TransaksiController::class, 'daftarPesanan'])->name('dashboard.pesanan');
        Route::patch('/pesanan/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('dashboard.pesanan.status');
        Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('dashboard.riwayat');
        Route::get('/riwayat/{transaksi}', [TransaksiController::class, 'detail'])->name('dashboard.riwayat.detail');
    });

    Route::middleware(['jabatan:Admin,Pemilik'])->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('dashboard.laporan');
        Route::get('/laporan/export', [LaporanController::class, 'exportCsv'])->name('dashboard.laporan.export');
    });

    Route::middleware(['jabatan:Pemilik'])->group(function () {
        Route::resource('menu', MenuController::class)->names('menu')->except(['show']);
        Route::resource('kategori', KategoriController::class)->names('kategori')->except(['show']);
        Route::resource('karyawan', KaryawanController::class)->names('karyawan')->except(['show']);
    });
});