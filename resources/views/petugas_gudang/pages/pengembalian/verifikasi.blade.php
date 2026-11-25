@extends('petugas_gudang.index')

@section('title', 'Verifikasi Pengembalian')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Verifikasi Pengembalian</h1>
        <p class="page-subtitle">Periksa kondisi aset yang dikembalikan, lalu catat hasilnya.</p>
    </div>
    <a href="{{ route('petugas.pengembalian') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <form action="{{ route('petugas.pengembalian.update', $peminjaman->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label-custom">Nama Karyawan</label>
            <input type="text" class="form-control-custom" value="{{ $peminjaman->karyawan->nama }}" readonly>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">Tanggal Pinjam</label>
                <input type="text" class="form-control-custom" value="{{ $peminjaman->tanggal_pinjam->locale('id')->translatedFormat('d F Y') }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label-custom">Tanggal Kembali</label>
                <input type="text" class="form-control-custom" value="{{ $peminjaman->tanggal_kembali->locale('id')->translatedFormat('d F Y') }}" readonly>
            </div>
        </div>

        <label class="form-label-custom">Aset yang Dikembalikan</label>
        <div class="table-card-custom mb-3">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Aset</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman->details as $detail)
                        <tr>
                            <td class="table-product-name">{{ $detail->asset->nama }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label-custom" for="kondisi_kembali">Kondisi Saat Dikembalikan</label>
            <select class="form-select-custom" name="kondisi_kembali" id="kondisi_kembali" required>
                <option value="" disabled selected>Pilih kondisi</option>
                <option value="baik">Baik</option>
                <option value="rusak_ringan">Rusak Ringan</option>
                <option value="rusak_berat">Rusak Berat</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label-custom" for="catatan">Catatan (opsional)</label>
            <textarea class="form-control-custom" name="catatan" id="catatan" rows="3" placeholder="Contoh: lensa tergores, kabel hilang"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label-custom" for="diverifikasi_oleh">Diverifikasi Oleh</label>
            <input type="text" class="form-control-custom" id="diverifikasi_oleh" value="{{ auth()->user()->nama }}" readonly>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-check-lg"></i> Konfirmasi</button>
        </div>
    </form>
</div>
@endsection
