@extends('admin_ga.index')

@section('title', 'Ubah Aset')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Ubah Aset</h1>
        <p class="page-subtitle">Ubah data aset. Stok berubah otomatis saat serah terima dan pengembalian.</p>
    </div>
    <a href="{{ route('admin.aset') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <form action="{{ route('admin.aset.update', $aset->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kategori_id" class="form-label-custom">Kategori</label>
            <select class="form-select-custom" name="kategori_id" id="kategori_id" required>
                @foreach ($kategori as $item)
                <option value="{{ $item->id }}" {{ old('kategori_id', $aset->kategori_id) == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label-custom">Nama Aset</label>
            <input type="text" class="form-control-custom" name="nama" id="nama" value="{{ old('nama', $aset->nama) }}" maxlength="150" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label-custom">Gambar Aset</label>

            @if ($aset->gambar)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $aset->gambar) }}" alt="{{ $aset->nama }}"
                    style="width: 160px; height: 160px; object-fit: cover; border-radius: 12px;">
            </div>
            @endif

            <input type="file" class="form-control-custom" name="gambar" id="gambar" accept=".jpg,.jpeg,.png">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar. Format JPG atau PNG, maksimal 2 MB.</small>
        </div>

        <div class="mb-3">
            <label class="form-label-custom">Stok Awal</label>
            <input type="text" class="form-control-custom" value="{{ $aset->stok_awal }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label-custom">Stok Tersedia</label>
            <input type="text" class="form-control-custom" value="{{ $aset->stok_tersedia }}" disabled>
        </div>

        <div class="mb-3">
            <label for="kondisi" class="form-label-custom">Kondisi</label>
            <select class="form-select-custom" name="kondisi" id="kondisi" required>
                <option value="baik" {{ old('kondisi', $aset->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak_ringan" {{ old('kondisi', $aset->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="rusak_berat" {{ old('kondisi', $aset->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="bernilai_tinggi" class="form-label-custom">Aset Bernilai Tinggi</label>
            <select class="form-select-custom" name="bernilai_tinggi" id="bernilai_tinggi" required>
                <option value="0" {{ old('bernilai_tinggi', $aset->bernilai_tinggi) == 0 ? 'selected' : '' }}>Tidak</option>
                <option value="1" {{ old('bernilai_tinggi', $aset->bernilai_tinggi) == 1 ? 'selected' : '' }}>Ya</option>
            </select>
        </div>

        <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-check-lg"></i> Simpan Perubahan</button>
    </form>
</div>
@endsection
