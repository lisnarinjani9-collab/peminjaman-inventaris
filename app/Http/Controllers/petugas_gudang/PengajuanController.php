<?php

namespace App\Http\Controllers\petugas_gudang;

use App\Models\Borrowing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = Borrowing::with('karyawan', 'details.asset')
        ->whereDoesntHave('details.asset', function ($query) {
            $query->where('bernilai_tinggi', 1);
        })
        ->latest()
        ->get();

        return view('petugas_gudang.pages.pengajuan.pengajuan', compact('pengajuan'));
    }
    public function edit($id)
    {
        $peminjaman = Borrowing::with('karyawan', 'details.asset')->findOrFail($id);
        return view('petugas_gudang.pages.pengajuan.validasi', compact('peminjaman'));
    }

    public function update(Request $request, Borrowing $peminjaman)
    {
        $request->validate([
            'keputusan' => 'required|in:setuju,tolak',
        ]);

        if ($peminjaman->status != 'pending') {
            return redirect()->route('petugas.pengajuan')->with('error', 'Pengajuan ini sudah diproses');
        }

        $peminjaman->load('details.asset');

        foreach ($peminjaman->details as $detail) {
            if ($detail->asset->bernilai_tinggi) {
                return redirect()->route('petugas.pengajuan')->with('error', 'Pengajuan ini berisi aset bernilai tinggi, persetujuannya oleh Admin GA');
            }
        }

        if ($request->keputusan == 'tolak') {
            $peminjaman->update([
                'status' => 'ditolak',
            ]);
            return redirect()->route('petugas.pengajuan')->with('success', 'Pengajuan berhasil ditolak');
        }

        foreach ($peminjaman->details as $detail) {
            if ($detail->jumlah > $detail->asset->stok_tersedia) {
                return back()->with('error', 'Stok ' . $detail->asset->nama . ' tidak cukup');
            }
        }

        $peminjaman->update([
            'status' => 'disetujui',
        ]);

        return redirect()->route('petugas.pengajuan')->with('success', 'Pengajuan berhasil disetujui');
    }

    public function show($id)
{
    $peminjaman = Borrowing::with('karyawan', 'details.asset')->findOrFail($id);
    return view('petugas_gudang.pages.pengajuan.show', compact('peminjaman'));
}
}
