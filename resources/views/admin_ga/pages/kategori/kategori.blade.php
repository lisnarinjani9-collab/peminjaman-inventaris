@extends('admin_ga.index')

@section('title', 'Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="page-title mb-0">Data Kategori</h4>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-dark bi bi-plus"><span class="mx-1">Tambah Kategori</span></a>
</div>

<div class="card-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
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
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->assets_count }}</td>
                    <td class="text-center">-</td>
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
