<?php

namespace App\Http\Controllers\admin_ga;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Category::withCount('assets')->get();
        return view('admin_ga.pages.kategori.kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:categories,nama',
        ],[
            'required' => ':attribute harus diisi.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah ada.',
        ],[
            'nama' =>  'Nama kategori',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with('success', 'Kategori baru berhasil ditambahkan');
    }
}
