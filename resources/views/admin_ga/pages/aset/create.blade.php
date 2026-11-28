@extends('admin_ga.index')

@section('title', 'Tambah Aset')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Aset</h1>
        <p class="page-subtitle">Isi data aset yang baru.</p>
    </div>
    <a href="{{ route('admin.aset') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <form action="{{ route('admin.aset.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kategori_id" class="form-label-custom">Kategori</label>
            <select class="form-select-custom" name="kategori_id" id="kategori_id" required>
                <option value="">Pilih kategori</option>
                @foreach ($kategori as $item)
                <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label-custom">Nama Aset</label>
            <input type="text" class="form-control-custom" name="nama" id="nama" value="{{ old('nama') }}" maxlength="150" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label-custom">Gambar Aset</label>
            <input type="file" class="form-control-custom" name="gambar" id="gambar" accept=".jpg,.jpeg,.png" required>
            <small class="text-muted">Format JPG atau PNG</small>
        </div>

        <div class="mb-3">
            <label for="stok_awal" class="form-label-custom">Stok Awal</label>
            <input type="number" class="form-control-custom" name="stok_awal" id="stok_awal" value="{{ old('stok_awal') }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="kondisi" class="form-label-custom">Kondisi</label>
            <select class="form-select-custom" name="kondisi" id="kondisi" required>
                <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="bernilai_tinggi" class="form-label-custom">Aset Bernilai Tinggi</label>
            <select class="form-select-custom" name="bernilai_tinggi" id="bernilai_tinggi" required>
                <option value="0" {{ old('bernilai_tinggi') === '0' ? 'selected' : '' }}>Tidak</option>
                <option value="1" {{ old('bernilai_tinggi') === '1' ? 'selected' : '' }}>Ya</option>
            </select>
        </div>

        <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-check-lg"></i> Simpan</button>
    </form>
</div>
@endsection
