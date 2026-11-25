<?php

namespace App\Http\Controllers\admin_ga;

use App\Models\Borrowing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function index()
    {
        $persetujuan = Borrowing::with('karyawan', 'details.asset')
            ->whereHas('details.asset', function ($query) {
                $query->where('bernilai_tinggi', 1);
            })
            ->latest()
            ->get();

        return view('admin_ga.pages.persetujuan.persetujuan', compact('persetujuan'));
    }

    public function edit($id)
    {
        $peminjaman = Borrowing::with('karyawan', 'details.asset')->findOrFail($id);
        return view('admin_ga.pages.persetujuan.validasi', compact('peminjaman'));
    }

    public function update(Request $request, Borrowing $peminjaman)
    {
        $request->validate([
            'keputusan' => 'required|in:setuju,tolak',
        ]);

        if ($peminjaman->status != 'pending') {
            return redirect()->route('admin.persetujuan')->with('error', 'Pengajuan ini sudah diproses');
        }

        $peminjaman->load('details.asset');

        if (!$peminjaman->details->contains(fn ($detail) => $detail->asset->bernilai_tinggi)) {
            return redirect()->route('admin.persetujuan')->with('error', 'Pengajuan ini tidak berisi aset bernilai tinggi, persetujuannya oleh Petugas Gudang');
        }

        if ($request->keputusan == 'tolak') {
            $peminjaman->update(['status' => 'ditolak']);
            return redirect()->route('admin.persetujuan')->with('success', 'Pengajuan berhasil ditolak');
        }

        foreach ($peminjaman->details as $detail) {
            if ($detail->jumlah > $detail->asset->stok_tersedia) {
                return back()->with('error', 'Stok ' . $detail->asset->nama . ' tidak cukup');
            }
        }

        $peminjaman->update(['status' => 'disetujui']);

        return redirect()->route('admin.persetujuan')->with('success', 'Pengajuan berhasil disetujui');
    }

        public function show($id)
    {
        $peminjaman = Borrowing::with('karyawan', 'details.asset')->findOrFail($id);
        return view('admin_ga.pages.persetujuan.show', compact('peminjaman'));
    }

}
