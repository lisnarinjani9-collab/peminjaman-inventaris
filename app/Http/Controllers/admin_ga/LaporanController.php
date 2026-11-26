<?php

namespace App\Http\Controllers\admin_ga;

use App\Models\Borrowing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Borrowing::with('karyawan', 'details.asset', 'returnLog')->latest()->get();

        $total = $laporan->count();
        $dipinjam = $laporan->where('status', 'dipinjam')->count();
        $dikembalikan = $laporan->where('status', 'dikembalikan')->count();
        $ditolak = $laporan->where('status', 'ditolak')->count();

        return view('admin_ga.pages.laporan.laporan', compact('laporan', 'total', 'dipinjam', 'dikembalikan', 'ditolak'));
    }

    public function cetak()
    {
        $laporan = Borrowing::with('karyawan', 'details.asset', 'returnLog')->latest()->get();

        $total = $laporan->count();
        $dipinjam = $laporan->where('status', 'dipinjam')->count();
        $dikembalikan = $laporan->where('status', 'dikembalikan')->count();
        $ditolak = $laporan->where('status', 'ditolak')->count();

        $tanggalCetak = now()->locale('id')->translatedFormat('d F Y, H:i') . ' WIB';

        return view('admin_ga.pages.laporan.cetak', compact('laporan', 'total', 'dipinjam', 'dikembalikan', 'ditolak', 'tanggalCetak'));
    }
}
