@extends('admin_ga.index')

@section('title', 'Tambah Akun')

@section('content')
<div class="col-md-8 col-lg-6 mx-auto">
    <a class="btn btn-sm btn-dark bi bi-arrow-left mb-3" href="{{ route('admin.akun') }}"><span class="mx-1">Kembali</span></a>

    <div class="card-box">
        <h4 class="page-title mb-3">Tambah Akun</h4>

        <form action="{{ route('admin.akun.store') }}" method="post">
            @csrf
            <label class="form-label" for="nama">Nama Akun</label>
            <input class="form-control" type="text" name="nama" id="nama" value="{{ old('nama') }}" maxlength="100" required>

            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-dark w-50" type="submit">Tambah Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection
