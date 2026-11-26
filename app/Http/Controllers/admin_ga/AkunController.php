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

        $akun = User::whereIn('role', ['petugas_gudang', 'karyawan'])->orderBy('role')->get();
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
            'divisi' => 'required|string|max:100',
            'role' => 'required|in:petugas_gudang,karyawan',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'divisi' => $request->divisi,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.akun')->with('success', 'Akun berhasil dibuat');
    }
    
    public function destroy(User $akun)
    {
        if ($akun->role == 'admin_ga') {
            abort(404);
        }

        $akun->delete();
        return redirect()->route('admin.akun')->with('success', 'Akun berhasil dihapus');
    }
}
