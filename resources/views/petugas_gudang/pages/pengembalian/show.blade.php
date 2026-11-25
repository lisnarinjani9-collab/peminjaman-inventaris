@extends('petugas_gudang.index')

@section('title', 'Detail Pengembalian')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Detail Pengembalian</h1>
        <p class="page-subtitle">Rincian aset yang sudah dikembalikan.</p>
    </div>
    <a href="{{ route('petugas.pengembalian') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
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

    @if ($peminjaman->returnLog)
    <div class="mb-3">
        <label class="form-label-custom d-block">Kondisi Saat Dikembalikan</label>
        @if ($peminjaman->returnLog->kondisi_kembali == 'baik')
        <span class="badge-table success">Baik</span>
        @elseif ($peminjaman->returnLog->kondisi_kembali == 'rusak_ringan')
        <span class="badge-table pending">Rusak Ringan</span>
        @else
        <span class="badge-table failed">Rusak Berat</span>
        @endif
    </div>

    <div class="mb-3">
        <label class="form-label-custom">Catatan</label>
        <textarea class="form-control-custom" rows="3" readonly>{{ $peminjaman->returnLog->catatan }}</textarea>
    </div>

    <div>
        <label class="form-label-custom">Diverifikasi Oleh</label>
        <input type="text" class="form-control-custom" value="{{ $peminjaman->returnLog->petugas->nama }}" readonly>
    </div>
    @else
    <p class="text-muted mb-0">Belum ada catatan pengembalian untuk pengajuan ini.</p>
    @endif
</div>
@endsection
