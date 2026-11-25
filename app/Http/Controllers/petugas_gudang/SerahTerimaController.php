<?php

namespace App\Http\Controllers\petugas_gudang;

use App\Models\Borrowing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SerahTerimaController extends Controller
{
    public function index()
    {
        $serahTerima = Borrowing::with('karyawan', 'details.asset')
            ->whereIn('status', ['disetujui', 'dipinjam'])
            ->latest()
            ->get();

        return view('petugas_gudang.pages.serah_terima.serah_terima', compact('serahTerima'));
    }

    public function update(Borrowing $peminjaman)
    {
        if ($peminjaman->status != 'disetujui') {
            return redirect()->route('petugas.serah_terima')->with('error', 'Pengajuan ini tidak bisa diserahkan');
        }

        $peminjaman->load('details.asset');

        foreach ($peminjaman->details as $detail) {
            if ($detail->jumlah > $detail->asset->stok_tersedia) {
                return back()->with('error', 'Stok ' . $detail->asset->nama . ' tidak cukup');
            }
        }

        foreach ($peminjaman->details as $detail) {
            $detail->asset->update([
                'stok_tersedia' => $detail->asset->stok_tersedia - $detail->jumlah,
            ]);
        }

        $peminjaman->update([
            'status' => 'dipinjam',
        ]);

        return redirect()->route('petugas.serah_terima')->with('success', 'Aset berhasil diserahkan');
    }
}
