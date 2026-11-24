<?php

namespace App\Http\Controllers\admin_ga;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
    {
        $aset = Asset::with('category')->get();
        return view('admin_ga.pages.aset.aset', compact('aset'));
    }

    public function create()
    {
        return view('admin_ga.pages.aset.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|string|max:150',
            'stok_awal' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'bernilai_tinggi' => 'required|in:0,1',
        ]);

        Asset::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'stok_awal' => $request->stok_awal,
            'stok_tersedia' => $request->stok_awal,
            'kondisi' => $request->kondisi,
            'bernilai_tinggi' => $request->bernilai_tinggi,
        ]);

        return redirect()->route('admin.aset')->with('success', 'Aset baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $aset = Asset::findOrFail($id);
        $kategori = Category::all();
        return view('admin_ga.pages.aset.update', compact('aset', 'kategori'));
    }

    public function update(Request $request, Asset $aset)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|string|max:150',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'bernilai_tinggi' => 'required|in:0,1',
        ]);

        $aset->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi,
            'bernilai_tinggi' => $request->bernilai_tinggi,
        ]);

        return redirect()->route('admin.aset')->with('succes', 'Aset berhasil diubah');
    }

    public function destroy(Asset $aset)
    {
        $aset->delete();
        return redirect()->route('admin.aset')->with('success', 'Aset berhasil dihapus');
    }
}
