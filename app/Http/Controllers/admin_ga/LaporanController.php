<?php

namespace App\Http\Controllers\admin_ga;

use App\Models\Borrowing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'dari' => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
            'status' => 'nullable|in:pending,disetujui,dipinjam,dikembalikan,ditolak',
        ]);

        $query = Borrowing::with('karyawan', 'details.asset', 'returnLog');

        if ($request->dari) {
            $query->whereDate('tanggal_pinjam', '>=', $request->dari);
        }

        if ($request->sampai) {
            $query->whereDate('tanggal_pinjam', '<=', $request->sampai);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $laporan = $query->latest()->get();

        $total = $laporan->count();
        $dipinjam = $laporan->where('status', 'dipinjam')->count();
        $dikembalikan = $laporan->where('status', 'dikembalikan')->count();
        $ditolak = $laporan->where('status', 'ditolak')->count();

        return view('admin_ga.pages.laporan.laporan', compact('laporan', 'total', 'dipinjam', 'dikembalikan', 'ditolak'));
    }
}
