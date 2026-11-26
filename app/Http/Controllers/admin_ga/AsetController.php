<?php

namespace App\Http\Controllers\admin_ga;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AsetController extends Controller
{
    public function index()
    {
        $aset = Asset::with('category')->get();
        return view('admin_ga.pages.aset.aset', compact('aset'));
    }

    public function create()
    {
        $kategori = Category::all();
        return view('admin_ga.pages.aset.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|string|max:150',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'stok_awal' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'bernilai_tinggi' => 'required|in:0,1',
        ]);

        // nama file: slug dari nama aset + waktu, supaya tidak menimpa file lain
        $slug = Str::slug($request->nama, '-');
        $filename = $slug . '-' . time() . '.' . $request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('folder-aset', $filename, 'public');

        Asset::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'gambar' => $path,
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'bernilai_tinggi' => 'required|in:0,1',
        ]);

        $path = $aset->gambar;
        if ($request->hasFile('gambar')) {
            if ($aset->gambar && Storage::disk('public')->exists($aset->gambar)) {
                Storage::disk('public')->delete($aset->gambar);
            }

            $slug = Str::slug($request->nama, '-');
            $filename = $slug . '-' . time() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('folder-aset', $filename, 'public');
        }

        $aset->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'gambar' => $path,
            'kondisi' => $request->kondisi,
            'bernilai_tinggi' => $request->bernilai_tinggi,
        ]);

        return redirect()->route('admin.aset')->with('success', 'Aset berhasil diubah');
    }

    public function destroy(Asset $aset)
    {
        if ($aset->gambar && Storage::disk('public')->exists($aset->gambar)) {
            Storage::disk('public')->delete($aset->gambar);
        }

        $aset->delete();
        return redirect()->route('admin.aset')->with('success', 'Aset berhasil dihapus');
    }
}
