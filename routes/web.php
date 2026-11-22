<?php

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
});

// petugas gudang
Route::prefix('petugas')->as('petugas.')->group(function () {
    Route::get('/', [PetugasDashboardController::class, 'index'])->name('dashboard');
});

// karyawan
Route::prefix('karyawan')->as('karyawan.')->group(function () {
    Route::get('/', [KaryawanDashboardController::class, 'index'])->name('dashboard');
});
