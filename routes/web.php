<?php

use App\Http\Controllers\karyawan\KatalogController as KaryawanKatalogController;
use App\Http\Controllers\karyawan\PeminjamanController as KaryawanPeminjamanController;
use App\Http\Controllers\karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\petugas_gudang\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\petugas_gudang\SerahTerimaController as PetugasSerahTerimaController;
use App\Http\Controllers\petugas_gudang\PengajuanController as PetugasPengajuanController;
use App\Http\Controllers\petugas_gudang\DashboardController as PetugasDashboardController;
use App\Http\Controllers\admin_ga\LaporanController as AdminLaporanController;
use App\Http\Controllers\admin_ga\PersetujuanController as AdminPersetujuanController;
use App\Http\Controllers\admin_ga\AkunController as AdminAkunController;
use App\Http\Controllers\admin_ga\AsetController as AdminAsetController;
use App\Http\Controllers\admin_ga\KategoriController as AdminKategoriController;
use App\Http\Controllers\admin_ga\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController as LoginController;
use App\Http\middleware\CekAdminGA;
use App\Http\middleware\CekPetugasGudang;
use App\Http\middleware\CekKaryawan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

// login
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate'])->name('authenticate');
});

// daftar akun karyawan
Route::prefix('register')->group(function () {
    Route::get('/', [LoginController::class, 'register'])->name('register');
    Route::post('/', [LoginController::class, 'registerStore'])->name('register.store');
});

// logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin GA
Route::prefix('admin')->as('admin.')->middleware('admin_ga')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    //kategori
    Route::prefix('kategori')->group(function () {
        Route::get('/', [AdminKategoriController::class, 'index'])->name('kategori');
        Route::get('/create', [AdminKategoriController::class, 'create'])->name('kategori.create');
        Route::post('/create', [AdminKategoriController::class, 'store'])->name('kategori.store');
        Route::get('/update/{id}', [AdminKategoriController::class, 'edit'])->name('kategori.edit');
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
    //akunn
    Route::prefix('akun')->group(function () {
        Route::get('/', [AdminAkunController::class, 'index'])->name('akun');
        Route::get('/create', [AdminAkunController::class, 'create'])->name('akun.create');
        Route::post('/create', [AdminAkunController::class, 'store'])->name('akun.store');
        Route::delete('/delete/{akun}', [AdminAkunController::class, 'destroy'])->name('akun.destroy');
    });
    //persetujuan (aset yg nilainyq tinggi)
    Route::prefix('persetujuan')->group(function () {
        Route::get('/', [AdminPersetujuanController::class, 'index'])->name('persetujuan');
        Route::get('/update/{id}', [AdminPersetujuanController::class, 'edit'])->name('persetujuan.validasi');
        Route::put('/update/{peminjaman}', [AdminPersetujuanController::class, 'update'])->name('persetujuan.update');
        Route::get('/show/{id}', [AdminPersetujuanController::class, 'show'])->name('persetujuan.show');
    });
    //laporan
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan');
});

// petugas gudang
Route::prefix('petugas')->as('petugas.')->middleware('petugas_gudang')->group(function () {
    Route::get('/', [PetugasDashboardController::class, 'index'])->name('dashboard');
    //pengajuan
    Route::prefix('pengajuan')->group(function () {
        Route::get('/', [PetugasPengajuanController::class, 'index'])->name('pengajuan');
        Route::get('/update/{id}', [PetugasPengajuanController::class, 'edit'])->name('pengajuan.validasi');
        Route::put('/update/{peminjaman}', [PetugasPengajuanController::class, 'update'])->name('pengajuan.update');
        Route::get('/show/{id}', [PetugasPengajuanController::class, 'show'])->name('pengajuan.show');
    });
    //serah terima
    Route::prefix('serah-terima')->group(function () {
        Route::get('/', [PetugasSerahTerimaController::class, 'index'])->name('serah_terima');
        Route::put('/update/{peminjaman}', [PetugasSerahTerimaController::class, 'update'])->name('serah_terima.update');
    });
     //pengembalian
    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [PetugasPengembalianController::class, 'index'])->name('pengembalian');
        Route::get('/update/{id}', [PetugasPengembalianController::class, 'edit'])->name('pengembalian.verifikasi');
        Route::put('/update/{peminjaman}', [PetugasPengembalianController::class, 'update'])->name('pengembalian.update');
        Route::get('/show/{id}', [PetugasPengembalianController::class, 'show'])->name('pengembalian.show');
    });
});

// karyawan
Route::prefix('karyawan')->as('karyawan.')->middleware('karyawan')->group(function () {
    Route::get('/', [KaryawanDashboardController::class, 'index'])->name('dashboard');
    //katalog
    Route::prefix('katalog')->group(function () {
        Route::get('/', [KaryawanKatalogController::class, 'index'])->name('katalog');
    });
    //peminjaman
    Route::prefix('peminjaman')->group(function () {
        Route::get('/', [KaryawanPeminjamanController::class, 'index'])->name('peminjaman');
        Route::get('/create', [KaryawanPeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/create', [KaryawanPeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/show/{peminjaman}', [KaryawanPeminjamanController::class, 'show'])->name('peminjaman.show');
    });
});