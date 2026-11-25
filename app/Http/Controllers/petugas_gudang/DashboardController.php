<?php

namespace App\Http\Controllers\petugas_gudang;

use App\Models\Borrowing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = Borrowing::where('status', 'pending')
            ->whereDoesntHave('details.asset', function ($query) {
                $query->where('bernilai_tinggi', 1);
            })
            ->count();

        $totalSerahTerima = Borrowing::where('status', 'disetujui')->count();
        $totalDipinjam = Borrowing::where('status', 'dipinjam')->count();

        //mengambil 5 pengajuan ( take(5) )
        $perluDiserahkan = Borrowing::with('karyawan', 'details.asset')
            ->where('status', 'disetujui')
            ->latest()
            ->take(5)
            ->get();

        $harusDikembalikan = Borrowing::with('karyawan', 'details.asset')
            ->where('status', 'dipinjam')
            ->orderBy('tanggal_kembali')
            ->take(5)
            ->get();

        return view('petugas_gudang.pages.dashboard', compact(
            'totalPengajuan',
            'totalSerahTerima',
            'totalDipinjam',
            'perluDiserahkan',
            'harusDikembalikan'
        ));
    }
}
