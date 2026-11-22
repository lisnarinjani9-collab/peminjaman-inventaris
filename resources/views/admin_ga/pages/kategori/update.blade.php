@extends('admin_ga.index')

@section('title', 'Ubah Kategori')

@section('content')
<div class="col-md-8 col-lg-6 mx-auto">
    <a class="btn btn-sm btn-dark bi bi-arrow-left mb-3" href="{{ route('admin.kategori') }}"><span class="mx-1">Kembali</span></a>

    <div class="card-box">
        <h4 class="page-title mb-3">Ubah Kategori</h4>

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="post">
            @csrf
            @method('PUT')
            <label class="form-label" for="nama">Nama Kategori</label>
            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama', $kategori->nama) }}" maxlength="100" required>

            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-dark w-50" type="submit">Ubah Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection
