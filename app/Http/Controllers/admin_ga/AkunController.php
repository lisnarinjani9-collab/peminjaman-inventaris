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
        $akun = User::where('role', 'petugas_gudang')->get();
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
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas_gudang',
            'divisi' => 'Gudang',
        ]);

        return redirect()->route('admin.akun')->with('success', 'Akun petugas gudang berhasil dibuat');
    }

    public function destroy(User $akun)
    {
        $akun->delete();
        return redirect()->route('admin.akun')->with('success', 'Akun berhasil dihapus');
    }
}
