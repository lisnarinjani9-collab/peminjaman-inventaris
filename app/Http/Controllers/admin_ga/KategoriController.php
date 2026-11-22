<?php

namespace App\Http\Controllers\admin_ga;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Category::withCount('assets')->get();
        return view('admin_ga.pages.kategori.kategori', compact('kategori'));
    }

    public function create()
    {
        return view('admin_ga.pages.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:categories,nama',
        ], [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah ada.',
        ], [
            'nama' => 'Nama kategori',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Category::findOrFail($id);
        return view('admin_ga.pages.kategori.update', compact('kategori'));
    }

    public function update(Request $request, Category $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:categories,nama,' . $kategori->id,
        ], [
            'required' => ':attribute harus diisi.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah ada.',
        ], [
            'nama' => 'Nama kategori',
        ]);

        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy(Category $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
