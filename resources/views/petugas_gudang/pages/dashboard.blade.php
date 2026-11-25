@extends('petugas_gudang.index')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Ringkasan tugas petugas gudang.</p>
    </div>
</div>

<div class="card p-4 border-light shadow-sm mb-4">
    <h5 class="mb-1">Selamat datang, {{ auth()->user()->nama }}</h5>
    <p class="text-muted mb-0">Gunakan menu di samping untuk memverifikasi pengajuan, serah terima, dan pengembalian aset.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Pengajuan Menunggu</div>
            <div class="stat-value">{{ $totalPengajuan }}</div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Menunggu Serah Terima</div>
            <div class="stat-value">{{ $totalSerahTerima }}</div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Sedang Dipinjam</div>
            <div class="stat-value">{{ $totalDipinjam }}</div>
        </div>
    </div>
</div>

<div class="page-header">
    <div>
        <h5 class="page-title" style="font-size: 1.25rem;">Perlu Diserahkan</h5>
        <p class="page-subtitle">Pengajuan yang sudah disetujui dan menunggu serah terima aset.</p>
    </div>
    <a href="{{ route('petugas.serah_terima') }}" class="btn-custom btn-custom-light">Lihat Semua</a>
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
                </tr>
            </thead>
            <tbody>
                @forelse ($perluDiserahkan as $item)
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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada aset yang menunggu serah terima</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="page-header">
    <div>
        <h5 class="page-title" style="font-size: 1.25rem;">Harus Dikembalikan</h5>
        <p class="page-subtitle">Aset yang sedang dipinjam, diurutkan dari tanggal kembali terdekat.</p>
    </div>
    <a href="{{ route('petugas.pengembalian') }}" class="btn-custom btn-custom-light">Lihat Semua</a>
</div>

<div class="table-card-custom">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Aset</th>
                    <th>Tanggal Kembali</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($harusDikembalikan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->karyawan->nama }}</td>
                    <td>
                        @foreach ($item->details as $detail)
                        <div>{{ $detail->asset->nama }} <span class="text-muted">({{ $detail->jumlah }})</span></div>
                        @endforeach
                    </td>
                    <td>{{ $item->tanggal_kembali->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('petugas.pengembalian.verifikasi', $item->id) }}" class="table-btn-action" title="Verifikasi Pengembalian"><i class="bi bi-check-circle"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada aset yang sedang dipinjam</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
