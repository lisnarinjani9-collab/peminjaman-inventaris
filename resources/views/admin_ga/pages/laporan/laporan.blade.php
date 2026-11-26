@extends('admin_ga.index')

@section('title', 'Laporan')

@section('content')
<style>
    .laporan-judul {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .laporan-judul-icon {
        width: 56px;
        height: 56px;
        flex-shrink: 0;
        border-radius: 16px;
        background: var(--brand-forest-dark);
        color: var(--brand-lime);
        font-size: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-isi {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .stat-isi .stat-value {
        margin-bottom: 0;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        flex-shrink: 0;
        border-radius: 16px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon.biru {
        background: #e6eefb;
        color: #1f3f73;
    }

    .stat-icon.kuning {
        background: #fff3cf;
        color: #b78103;
    }

    .stat-icon.hijau {
        background: #dcfce7;
        color: #16a34a;
    }

    .stat-icon.merah {
        background: #fee2e2;
        color: #dc2626;
    }

    .tabel-judul {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding: 24px 24px 12px;
    }

    .tabel-judul h5 {
        font-weight: 800;
        margin-bottom: 4px;
    }

    .pill-label {
        border: 1px solid var(--border-light);
        border-radius: 999px;
        padding: 6px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
    }
</style>

<div class="page-header">
    <div class="laporan-judul">
        <div class="laporan-judul-icon"><i class="bi bi-file-earmark-bar-graph"></i></div>
        <div>
            <h1 class="page-title">Laporan Peminjaman</h1>
            <p class="page-subtitle">Rekap seluruh peminjaman aset beserta status dan kondisi pengembaliannya.</p>
        </div>
    </div>
    <a href="{{ route('admin.laporan.cetak') }}" class="btn-custom btn-custom-primary"><i class="bi bi-printer"></i> Cetak Laporan</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Total Peminjaman</div>
            <div class="stat-isi">
                <div class="stat-value">{{ $total }}</div>
                <div class="stat-icon biru"><i class="bi bi-clipboard-data"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Sedang Dipinjam</div>
            <div class="stat-isi">
                <div class="stat-value">{{ $dipinjam }}</div>
                <div class="stat-icon kuning"><i class="bi bi-box-arrow-up-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Dikembalikan</div>
            <div class="stat-isi">
                <div class="stat-value">{{ $dikembalikan }}</div>
                <div class="stat-icon hijau"><i class="bi bi-check-circle"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card p-4 border-light shadow-sm card-stat">
            <div class="stat-label">Ditolak</div>
            <div class="stat-isi">
                <div class="stat-value">{{ $ditolak }}</div>
                <div class="stat-icon merah"><i class="bi bi-x-circle"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="table-card-custom">
    <div class="tabel-judul">
        <div>
            <h5>Daftar Peminjaman</h5>
            <div class="text-muted">Rekapitulasi data karyawan, aset, dan status peminjaman</div>
        </div>
        <span class="pill-label">Data Laporan</span>
    </div>

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
