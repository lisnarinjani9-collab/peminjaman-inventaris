@extends('admin_ga.index')

@section('title', 'Persetujuan')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Persetujuan Peminjaman</h1>
        <p class="page-subtitle">Setujui atau tolak pengajuan yang berisi aset bernilai tinggi.</p>
    </div>
</div>

<div class="table-card-custom">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Aset</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($persetujuan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->karyawan->nama }}</td>
                    <td>
                        @foreach ($item->details as $detail)
                        <div>
                            {{ $detail->asset->nama }} <span class="text-muted">({{ $detail->jumlah }})</span>
                            @if ($detail->asset->bernilai_tinggi)
                            <i class="bi bi-gem text-warning" title="Aset bernilai tinggi"></i>
                            @endif
                        </div>
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
                        <div class="d-flex justify-content-center gap-1">
                            @if ($item->status == 'pending')
                            <a href="{{ route('admin.persetujuan.validasi', $item->id) }}" class="table-btn-action" title="Proses Pengajuan"><i class="bi bi-check-circle"></i></a>
                            @else
                            <a href="{{ route('admin.persetujuan.show', $item->id) }}" class="table-btn-action" title="Lihat Pengajuan"><i class="bi bi-eye"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada pengajuan aset bernilai tinggi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
