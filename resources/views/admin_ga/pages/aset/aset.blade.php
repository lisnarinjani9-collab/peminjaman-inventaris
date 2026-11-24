@extends('admin_ga.index')

@section('title', 'Aset')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Aset</h1>
        <p class="page-subtitle">Kelola daftar aset sarana dan prasarana perusahaan.</p>
    </div>
    <a href="{{ route('admin.aset.create') }}" class="btn-custom btn-custom-primary"><i class="bi bi-plus-lg"></i> Tambah Aset</a>
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
                    <th>Kondisi</th>
                    <th>Bernilai Tinggi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($aset as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->nama }}</td>
                    <td>{{ $item->category->nama }}</td>
                    <td>{{ $item->stok_awal }}</td>
                    <td>{{ $item->stok_tersedia }}</td>
                    <td>
                        @if ($item->kondisi == 'baik')
                        <span class="badge-table success">Baik</span>
                        @elseif ($item->kondisi == 'rusak_ringan')
                        <span class="badge-table pending">Rusak Ringan</span>
                        @else
                        <span class="badge-table failed">Rusak Berat</span>
                        @endif
                    </td>
                    <td>{{ $item->bernilai_tinggi ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.aset.edit', $item->id) }}" class="table-btn-action" title="Ubah"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.aset.destroy', $item->id) }}" method="post" onsubmit="return confirm('Aset ini akan dihapus. Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table-btn-action delete" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Data tidak ada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
