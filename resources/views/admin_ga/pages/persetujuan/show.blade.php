@extends('admin_ga.index')

@section('title', 'Detail Pengajuan')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Detail Pengajuan</h1>
        <p class="page-subtitle">Rincian pengajuan peminjaman aset.</p>
    </div>
    <a href="{{ route('admin.persetujuan') }}" class="btn-custom btn-custom-light"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card p-4 border-light shadow-sm col-lg-8">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label-custom">Nama Karyawan</label>
            <input type="text" class="form-control-custom" value="{{ $peminjaman->karyawan->nama }}" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label-custom">Divisi</label>
            <input type="text" class="form-control-custom" value="{{ $peminjaman->karyawan->divisi }}" readonly>
        </div>
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

    <div>
        <label class="form-label-custom d-block">Status</label>
        @if ($peminjaman->status == 'pending')
        <span class="badge-table pending">Menunggu</span>
        @elseif ($peminjaman->status == 'ditolak')
        <span class="badge-table failed">Ditolak</span>
        @else
        <span class="badge-table success">{{ ucfirst($peminjaman->status) }}</span>
        @endif
    </div>
</div>
@endsection
