<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:8',
        ], [
            'required' => ':attribute harus diisi.',
            'email' => 'Format :attribute tidak valid.',
            'min' => ':attribute minimal :min karakter.',
            'max' => ':attribute maksimal :max karakter.',
        ], [
            'email' => 'Email',
            'password' => 'Password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->only('email'))->withErrors($validator->errors());
        }

        if (Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin_ga') {
                return redirect()->route('admin.dashboard')->with(['success' => 'Login berhasil. Selamat datang, ' . Auth::user()->nama]);
            }

            if (Auth::user()->role === 'petugas_gudang') {
                return redirect()->route('petugas.dashboard')->with(['success' => 'Login berhasil. Selamat datang, ' . Auth::user()->nama]);
            }

            if (Auth::user()->role === 'karyawan') {
                return redirect()->route('karyawan.dashboard')->with(['success' => 'Login berhasil. Selamat datang, ' . Auth::user()->nama]);
            }

            // role tidak dikenali, keluarkan lagi supaya tidak bisa masuk
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Role akun tidak dikenali.');
        }

        return redirect()->back()->withInput($request->only('email'))->with('error', 'Email atau password yang anda masukkan salah. Silahkan coba lagi!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
