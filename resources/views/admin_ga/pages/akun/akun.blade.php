@extends('admin_ga.index')

@section('title', 'Akun Petugas')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Akun Petugas Gudang</h1>
        <p class="page-subtitle">Kelola akun petugas yang memproses peminjaman.</p>
    </div>
    <a href="{{ route('admin.akun.create') }}" class="btn-custom btn-custom-primary"><i class="bi bi-plus-lg"></i> Tambah Akun</a>
</div>

<div class="table-card-custom">
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Divisi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($akun as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->divisi }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('admin.akun.destroy', $item->id) }}" method="post" onsubmit="return confirm('Akun petugas ini akan dihapus. Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table-btn-action delete" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
