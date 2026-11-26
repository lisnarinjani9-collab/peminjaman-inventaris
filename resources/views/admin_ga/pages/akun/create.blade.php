@extends('admin_ga.index')

@section('title', 'Tambah Akun')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Akun</h1>
        <p class="page-subtitle">Buat akun baru untuk petugas gudang atau karyawan.</p>
    </div>
    <a href="{{ route('admin.akun') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <form action="{{ route('admin.akun.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label-custom">Nama</label>
            <input type="text" class="form-control-custom" name="nama" id="nama" value="{{ old('nama') }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label-custom">Email</label>
            <input type="email" class="form-control-custom" name="email" id="email" value="{{ old('email') }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label-custom">Role</label>
            <select class="form-select-custom" name="role" id="role" required>
                <option value="">Pilih role</option>
                <option value="petugas_gudang" {{ old('role') == 'petugas_gudang' ? 'selected' : '' }}>Petugas Gudang</option>
                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="divisi" class="form-label-custom">Divisi</label>
            <input type="text" class="form-control-custom" name="divisi" id="divisi" value="{{ old('divisi') }}" maxlength="100" placeholder="Contoh: Keuangan, atau Gudang untuk petugas" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label-custom">Password</label>
            <input type="password" class="form-control-custom" name="password" id="password" minlength="8" maxlength="255" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label-custom">Ulangi Password</label>
            <input type="password" class="form-control-custom" name="password_confirmation" id="password_confirmation" minlength="8" maxlength="255" required>
        </div>

        <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-check-lg"></i> Simpan</button>
    </form>
</div>
@endsection
