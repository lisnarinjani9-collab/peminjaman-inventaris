<?php

namespace App\Http\Controllers\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Borrowing::with('details.asset')->where('karyawan_id', auth()->user()->id)->latest()->get();
        return view('karyawan.pages.peminjaman.peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        $aset = Asset::where('stok_tersedia', '>', 0)->get();
        return view('karyawan.pages.peminjaman.create', compact('aset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'aset_id' => 'required|array|min:1',
            'aset_id.*' => 'required|exists:assets,id|distinct',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        // cek jumlah yang diminta tidak melebihi stok tersedia
        foreach ($request->aset_id as $i => $id) {
            $aset = Asset::findOrFail($id);
            if ($request->jumlah[$i] > $aset->stok_tersedia) {
                return back()->withInput()->with('error', 'Jumlah ' . $aset->nama . ' melebihi stok yang tersedia');
            }
        }

        $peminjaman = Borrowing::create([
            'karyawan_id' => auth()->user()->id,
            'status' => 'pending',
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        foreach ($request->aset_id as $i => $id) {
            BorrowingDetail::create([
                'peminjaman_id' => $peminjaman->id,
                'aset_id' => $id,
                'jumlah' => $request->jumlah[$i],
            ]);
        }

        return redirect()->route('karyawan.peminjaman')->with('success', 'Pengajuan peminjaman anda berhasil dikirim');
    }

    public function show(Borrowing $peminjaman)
    {
        if ($peminjaman->karyawan_id != auth()->user()->id) {
            abort(403);
        }
        $peminjaman->load('details.asset');
        return view('karyawan.pages.peminjaman.show', compact('peminjaman'));
    }
}
