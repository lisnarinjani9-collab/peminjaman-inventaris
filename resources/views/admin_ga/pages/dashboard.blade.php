@extends('admin_ga.index')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Ringkasan data peminjaman inventaris.</p>
    </div>
</div>

<div class="card p-4 border-light shadow-sm mb-4">
    <h5 class="mb-1">Selamat datang, {{ auth()->user()->nama }}</h5>
    <p class="text-muted mb-0">Pantau aset, akun petugas, dan pengajuan yang perlu persetujuan kamu.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Total Aset</div>
            <div class="stat-value">{{ $totalAset }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Total Kategori</div>
            <div class="stat-value">{{ $totalKategori }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Akun Petugas</div>
            <div class="stat-value">{{ $totalPetugas }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Perlu Persetujuan</div>
            <div class="stat-value">{{ $totalPerluPersetujuan }}</div>
        </div>
    </div>
</div>

<div class="page-header">
    <div>
        <h5 class="page-title" style="font-size: 1.25rem;">Perlu Persetujuan</h5>
        <p class="page-subtitle">Pengajuan aset bernilai tinggi yang menunggu keputusan kamu.</p>
    </div>
    <a href="{{ route('admin.persetujuan') }}" class="btn-custom btn-custom-light">Lihat Semua</a>
</div>

<div class="table-card-custom mb-4">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Aset</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perluPersetujuan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->karyawan->nama }}</td>
                    <td>
                        @foreach ($item->details as $detail)
                        <div>{{ $detail->asset->nama }} <span class="text-muted">({{ $detail->jumlah }})</span></div>
                        @endforeach
                    </td>
                    <td>{{ $item->tanggal_pinjam->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->tanggal_kembali->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.persetujuan.validasi', $item->id) }}" class="table-btn-action" title="Proses Pengajuan"><i class="bi bi-check-circle"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada pengajuan yang menunggu persetujuan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="page-header">
    <div>
        <h5 class="page-title" style="font-size: 1.25rem;">Stok Menipis</h5>
        <p class="page-subtitle">Aset dengan stok tersedia 2 atau kurang.</p>
    </div>
    <a href="{{ route('admin.aset') }}" class="btn-custom btn-custom-light">Lihat Semua Aset</a>
</div>

<div class="table-card-custom">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Stok Awal</th>
                    <th>Stok Tersedia</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stokMenipis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->nama }}</td>
                    <td>{{ $item->category->nama }}</td>
                    <td>{{ $item->stok_awal }}</td>
                    <td>
                        @if ($item->stok_tersedia == 0)
                        <span class="badge-table failed">Habis</span>
                        @else
                        <span class="badge-table pending">{{ $item->stok_tersedia }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Semua stok aset masih aman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
