<?php

namespace App\Http\Controllers\admin_ga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $akun = User::whereIn('role', ['petugas_gudang', 'karyawan'])->get();
        return view('admin_ga.pages.akun.akun', compact('akun'));
    }

    public function create()
    {
        return view('admin_ga.pages.akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:8|max:255|confirmed',
            'role' => 'required|in:petugas_gudang,karyawan',
            'divisi' => 'required|string|max:100',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'divisi' => $request->divisi,
        ]);

        return redirect()->route('admin.akun')->with('success', 'Akun baru berhasil dibuat');
    }

    public function edit($id)
    {
        $akun = User::findOrFail($id);
        return view('admin_ga.pages.akun.update', compact('akun'));
    }

    public function update(Request $request, User $akun)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $akun->id,
            'password' => 'nullable|min:8|max:255|confirmed',
            'role' => 'required|in:petugas_gudang,karyawan',
            'divisi' => 'required|string|max:100',
        ]);

        $akun->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'divisi' => $request->divisi,
        ]);

        // password hanya diganti kalau kolomnya diisi
        if ($request->password) {
            $akun->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.akun')->with('success', 'Akun berhasil diubah');
    }

    public function destroy(User $akun)
    {
        $akun->delete();
        return redirect()->route('admin.akun')->with('success', 'Akun berhasil dihapus');
    }
}
