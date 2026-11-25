@extends('admin_ga.index')

@section('title', 'Kategori')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Kategori</h1>
        <p class="page-subtitle">Kelola kategori untuk mengelompokkan aset sarana dan prasarana.</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn-custom btn-custom-primary"><i class="bi bi-plus-lg"></i> Tambah Kategori</a>
</div>

<div class="table-card-custom">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Aset</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->nama }}</td>
                    <td>{{ $item->assets_count }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.kategori.edit', $item->id) }}" class="table-btn-action" title="Ubah"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="post" onsubmit="return confirm('Kategori beserta seluruh asetnya akan dihapus. Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table-btn-action delete" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Data tidak ada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
