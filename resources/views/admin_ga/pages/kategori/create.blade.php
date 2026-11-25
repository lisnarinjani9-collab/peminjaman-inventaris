@extends('admin_ga.index')

@section('title', 'Tambah Kategori')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Kategori</h1>
        <p class="page-subtitle">Isi nama kategori yang baru.</p>
    </div>
    <a href="{{ route('admin.kategori') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <form action="{{ route('admin.kategori.store') }}" method="post">
        @csrf

        <div class="mb-4">
            <label for="nama" class="form-label-custom">Nama Kategori</label>
            <input type="text" class="form-control-custom" name="nama" id="nama" value="{{ old('nama') }}" maxlength="100" required>
        </div>

        <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-check-lg"></i> Simpan</button>
    </form>
</div>
@endsection
