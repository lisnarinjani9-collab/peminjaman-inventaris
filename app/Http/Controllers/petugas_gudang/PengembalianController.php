<?php

namespace App\Http\Controllers\petugas_gudang;

use Illuminate\Support\Facades\Auth;
use App\Models\ReturnLog;
use App\Models\Borrowing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Borrowing::with('karyawan', 'details.asset')
            ->whereIn('status', ['dipinjam', 'dikembalikan'])
            ->latest()
            ->get();

        return view('petugas_gudang.pages.pengembalian.pengembalian', compact('pengembalian'));
    }

    public function edit($id)
    {
        $peminjaman = Borrowing::with('karyawan', 'details.asset')->findOrFail($id);
        return view('petugas_gudang.pages.pengembalian.verifikasi', compact('peminjaman'));
    }

    public function update(Request $request, Borrowing $peminjaman)
    {
        $request->validate([
            'kondisi_kembali' => 'required|in:baik,rusak_ringan,rusak_berat',
            'catatan' => 'nullable|string|max:255',
        ]);

        if ($peminjaman->status != 'dipinjam') {
            return redirect()->route('petugas.pengembalian')->with('error', 'Aset ini tidak sedang dipinjam');
        }

        $peminjaman->load('details.asset');

        ReturnLog::create([
            'peminjaman_id' => $peminjaman->id,
            'diverifikasi_oleh' => Auth::id(),
            'kondisi_kembali' => $request->kondisi_kembali,
            'catatan' => $request->catatan,
        ]);

        foreach ($peminjaman->details as $detail) {
            $detail->asset->update([
                'stok_tersedia' => $detail->asset->stok_tersedia + $detail->jumlah,
            ]);
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);

        return redirect()->route('petugas.pengembalian')->with('success', 'Pengembalian berhasil diverifikasi');
    }

    public function show($id)
    {
        $peminjaman = Borrowing::with('karyawan', 'details.asset', 'returnLog.petugas')->findOrFail($id);
        return view('petugas_gudang.pages.pengembalian.show', compact('peminjaman'));
    }
}
