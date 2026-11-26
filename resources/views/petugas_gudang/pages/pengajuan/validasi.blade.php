@extends('petugas_gudang.index')

@section('title', 'Validasi Pengajuan')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Validasi Pengajuan</h1>
        <p class="page-subtitle">Periksa detail pengajuan, lalu setujui atau tolak.</p>
    </div>
    <a href="{{ route('petugas.pengajuan') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <form action="{{ route('petugas.pengajuan.update', $peminjaman->id) }}" method="post">
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

        <label class="form-label-custom">Aset yang Dipinjam</label>
        <div class="table-card-custom mb-3">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Aset</th>
                            <th>Jumlah</th>
                            <th>Stok Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman->details as $detail)
                        <tr>
                            <td class="table-product-name">{{ $detail->asset->nama }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>{{ $detail->asset->stok_tersedia }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label-custom" for="keputusan">Keputusan</label>
            <select class="form-select-custom" name="keputusan" id="keputusan" required>
                <option value="" disabled selected>Pilih keputusan</option>
                <option value="setuju">Disetujui</option>
                <option value="tolak">Ditolak</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label-custom" for="divalidasi_oleh">Divalidasi Oleh</label>
            <input type="text" class="form-control-custom" id="divalidasi_oleh" value="{{ auth()->user()->nama }}" readonly>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-check-lg"></i> Konfirmasi</button>
        </div>
    </form>
</div>
@endsection
