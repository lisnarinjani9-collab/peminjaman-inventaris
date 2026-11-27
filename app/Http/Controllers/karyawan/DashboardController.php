<?php

namespace App\Http\Controllers\karyawan;

use App\Models\Category;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // aset yang punya foto dan stoknya masih ada, untuk galeri
        $aset = Asset::with('category')
            ->whereNotNull('gambar')
            ->where('stok_tersedia', '>', 0)
            ->latest()
            ->get();

        // hanya kategori yang punya aset berfoto, untuk tombol filter
        $kategori = Category::whereHas('assets', function ($query) {
            $query->whereNotNull('gambar')->where('stok_tersedia', '>', 0);
        })->get();

        return view('karyawan.pages.dashboard', compact('aset', 'kategori'));
    }
}
