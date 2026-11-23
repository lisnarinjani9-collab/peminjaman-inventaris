<?php

use App\Http\Controllers\admin_ga\AkunController as AdminAkunController;
use App\Http\Controllers\admin_ga\AsetController as AdminAsetController;
use App\Http\Controllers\admin_ga\KategoriController as AdminKategoriController;
use App\Http\Controllers\karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\petugas_gudang\DashboardController as PetugasDashboardController;
use App\Http\Controllers\admin_ga\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController as LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

// login
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate'])->name('authenticate');
});

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin GA
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    //kategori
    Route::prefix('kategori')->group(function () {
        Route::get('/', [AdminKategoriController::class, 'index'])->name('kategori');
        Route::get('/create', [AdminKategoriController::class, 'create'])->name('kategori.create');
        Route::post('/create', [AdminKategoriController::class, 'store'])->name('kategori.store');
        Route::get('/update{id}', [AdminKategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/update/{kategori}', [AdminKategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/delete/{kategori}', [AdminKategoriController::class, 'destroy'])->name('kategori.destroy');
    });
    //aset
    Route::prefix('aset')->group(function () {
        Route::get('/', [AdminAsetController::class, 'index'])->name('aset');
        Route::get('/create', [AdminAsetController::class, 'create'])->name('aset.create');
        Route::post('/create', [AdminAsetController::class, 'store'])->name('aset.store');
        Route::get('/update/{id}', [AdminAsetController::class, 'edit'])->name('aset.edit');
        Route::put('/update/{aset}', [AdminAsetController::class, 'update'])->name('aset.update');
        Route::delete('/delete/{aset}', [AdminAsetController::class, 'destroy'])->name('aset.destroy');
    });
    // Akun
    Route::prefix('akun')->group(function () {
        Route::get('/', [AdminAkunController::class, 'index'])->name('akun');
        Route::get('/create', [AdminAkunController::class, 'create'])->name('akun.create');
        Route::post('/create', [AdminAkunController::class, 'store'])->name('akun.store');
        Route::get('/update/{id}', [AdminAkunController::class, 'edit'])->name('akun.edit');
        Route::put('/update/{akun}', [AdminAkunController::class, 'update'])->name('akun.update');
        Route::delete('/delete/{akun}', [AdminAkunController::class, 'destroy'])->name('akun.destroy');
    });
});

// petugas gudang
Route::prefix('petugas')->as('petugas.')->group(function () {
    Route::get('/', [PetugasDashboardController::class, 'index'])->name('dashboard');
});

// karyawan
Route::prefix('karyawan')->as('karyawan.')->group(function () {
    Route::get('/', [KaryawanDashboardController::class, 'index'])->name('dashboard');
});
