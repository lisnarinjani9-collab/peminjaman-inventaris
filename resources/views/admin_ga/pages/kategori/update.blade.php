@extends('admin_ga.index')

@section('title', 'Ubah Kategori')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Ubah Kategori</h1>
        <p class="page-subtitle">Ubah nama kategori.</p>
    </div>
    <a href="{{ route('admin.kategori') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="form-label-custom">Nama Kategori</label>
            <input type="text" class="form-control-custom" name="nama" id="nama" value="{{ old('nama', $kategori->nama) }}" maxlength="100" required>
        </div>

        <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-check-lg"></i> Simpan Perubahan</button>
    </form>
</div>
@endsection
