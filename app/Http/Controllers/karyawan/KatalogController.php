<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class KatalogController extends Controller
{
    public function index()
    {
        $aset = Asset::with('category')->where('stok_tersedia', '>', 0)->get();
        return view('karyawan.pages.katalog', compact('aset'));
    }
}
