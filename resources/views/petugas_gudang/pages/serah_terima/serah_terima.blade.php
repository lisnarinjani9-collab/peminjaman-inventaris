@extends('petugas_gudang.index')

@section('title', 'Serah Terima')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Serah Terima Aset</h1>
        <p class="page-subtitle">Serahkan aset kepada karyawan untuk pengajuan yang sudah disetujui.</p>
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
                @forelse ($serahTerima as $item)
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
                        @if ($item->status == 'disetujui')
                        <span class="badge-table pending">Belum Diserahkan</span>
                        @else
                        <span class="badge-table success">Dipinjam</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            @if ($item->status == 'disetujui')
                            <form action="{{ route('petugas.serah_terima.update', $item->id) }}" method="post" onsubmit="return confirm('Serahkan aset ini kepada karyawan?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="table-btn-action" title="Serahkan"><i class="bi bi-box-arrow-right"></i></button>
                            </form>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada aset yang perlu diserahkan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
