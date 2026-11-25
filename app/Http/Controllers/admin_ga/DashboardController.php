<?php

namespace App\Http\Controllers\admin_ga;

use App\Models\Borrowing;
use App\Models\Category;
use App\Models\User;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // kartu ringkasan
        $totalAset = Asset::count();
        $totalKategori = Category::count();
        $totalPetugas = User::where('role', 'petugas_gudang')->count();

        // pengajuan aset bernilai tinggi yang masih menunggu persetujuan admin
        $perluPersetujuan = Borrowing::with('karyawan', 'details.asset')
            ->whereHas('details.asset', function ($query) {
                $query->where('bernilai_tinggi', 1);
            })
            ->where('status', 'pending')
            ->latest()
            ->get();

        $totalPerluPersetujuan = $perluPersetujuan->count();

        // tabel hanya menampilkan 5 pengajuan terbaru
        $perluPersetujuan = $perluPersetujuan->take(5);

        // aset dengan stok tersedia 2 atau kurang
        $stokMenipis = Asset::with('category')
            ->where('stok_tersedia', '<=', 2)
            ->orderBy('stok_tersedia')
            ->get();

        return view('admin_ga.pages.dashboard', compact(
            'totalAset',
            'totalKategori',
            'totalPetugas',
            'totalPerluPersetujuan',
            'perluPersetujuan',
            'stokMenipis'
        ));
    }
}
