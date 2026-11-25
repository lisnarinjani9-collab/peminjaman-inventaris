@extends('petugas_gudang.index')

@section('title', 'Pengembalian')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Pengembalian Aset</h1>
        <p class="page-subtitle">Verifikasi aset yang dikembalikan karyawan dan catat kondisinya.</p>
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
                @forelse ($pengembalian as $item)
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
                        @if ($item->status == 'dipinjam')
                        <span class="badge-table pending">Sedang Dipinjam</span>
                        @else
                        <span class="badge-table success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            @if ($item->status == 'dipinjam')
                            <a href="{{ route('petugas.pengembalian.verifikasi', $item->id) }}" class="table-btn-action" title="Verifikasi Pengembalian"><i class="bi bi-check-circle"></i></a>
                            @else
                            <a href="{{ route('petugas.pengembalian.show', $item->id) }}" class="table-btn-action" title="Lihat Pengembalian"><i class="bi bi-eye"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada aset yang sedang dipinjam</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
