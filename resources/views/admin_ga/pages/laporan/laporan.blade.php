@extends('admin_ga.index')

@section('title', 'Laporan')

@section('content')
<style>
    @media print {
        .sidebar-wrapper, .navbar-custom, .no-print, .footer-custom, footer { display: none !important; }
        .main-wrapper { margin: 0 !important; padding: 0 !important; }
        .table-card-custom, .card { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
</style>

<div class="page-header">
    <div>
        <h1 class="page-title">Laporan Peminjaman</h1>
        <p class="page-subtitle">Rekap seluruh peminjaman aset. Gunakan filter untuk mempersempit data.</p>
    </div>
    <button type="button" onclick="window.print()" class="btn-custom btn-custom-primary no-print"><i class="bi bi-printer"></i> Cetak</button>
</div>

<div class="card p-4 border-light shadow-sm mb-4 no-print">
    <form action="{{ route('admin.laporan') }}" method="get" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label for="dari" class="form-label-custom">Dari Tanggal</label>
            <input type="date" class="form-control-custom" name="dari" id="dari" value="{{ request('dari') }}">
        </div>
        <div class="col-md-3">
            <label for="sampai" class="form-label-custom">Sampai Tanggal</label>
            <input type="date" class="form-control-custom" name="sampai" id="sampai" value="{{ request('sampai') }}">
        </div>
        <div class="col-md-3">
            <label for="status" class="form-label-custom">Status</label>
            <select class="form-select-custom" name="status" id="status">
                <option value="">Semua status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn-custom btn-custom-primary"><i class="bi bi-funnel"></i> Terapkan</button>
            <a href="{{ route('admin.laporan') }}" class="btn-custom btn-custom-light">Reset</a>
        </div>
    </form>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Total Peminjaman</div>
            <div class="stat-value">{{ $total }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Sedang Dipinjam</div>
            <div class="stat-value">{{ $dipinjam }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Dikembalikan</div>
            <div class="stat-value">{{ $dikembalikan }}</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Ditolak</div>
            <div class="stat-value">{{ $ditolak }}</div>
        </div>
    </div>
</div>

<div class="table-card-custom">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Divisi</th>
                    <th>Aset</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Kondisi Kembali</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->karyawan->nama }}</td>
                    <td>{{ $item->karyawan->divisi }}</td>
                    <td>
                        @foreach ($item->details as $detail)
                        <div>{{ $detail->asset->nama }} <span class="text-muted">({{ $detail->jumlah }})</span></div>
                        @endforeach
                    </td>
                    <td>{{ $item->tanggal_pinjam->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->tanggal_kembali->locale('id')->translatedFormat('d F Y') }}</td>
                    <td>
                        @if ($item->status == 'pending')
                        <span class="badge-table pending">Menunggu</span>
                        @elseif ($item->status == 'ditolak')
                        <span class="badge-table failed">Ditolak</span>
                        @else
                        <span class="badge-table success">{{ ucfirst($item->status) }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->returnLog)
                            @if ($item->returnLog->kondisi_kembali == 'baik')
                            <span class="badge-table success">Baik</span>
                            @elseif ($item->returnLog->kondisi_kembali == 'rusak_ringan')
                            <span class="badge-table pending">Rusak Ringan</span>
                            @else
                            <span class="badge-table failed">Rusak Berat</span>
                            @endif
                        @else
                        -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data peminjaman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
