@extends('admin_ga.index')

@section('title', 'Akun')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Akun</h1>
        <p class="page-subtitle">Kelola akun petugas gudang dan karyawan. Karyawan tidak mendaftar sendiri, akunnya dibuat di sini.</p>
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
                    <th>Role</th>
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
                        @if ($item->role == 'petugas_gudang')
                        <span class="badge-table pending">Petugas Gudang</span>
                        @else
                        <span class="badge-table success">Karyawan</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('admin.akun.destroy', $item->id) }}" method="post" onsubmit="return confirm('Akun ini akan dihapus. Jika akun karyawan, riwayat peminjamannya ikut terhapus. Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table-btn-action delete" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
