@extends('admin_ga.index')

@section('title', 'Dashboard')

@section('content')
<h4 class="page-title mb-1">Dashboard</h4>
<p class="text-muted mb-4">Ringkasan sistem peminjaman inventaris.</p>

<div class="card-box">
    <h5 class="mb-1">Selamat datang, {{ auth()->user()->nama }}</h5>
    <p class="text-muted mb-0">Gunakan menu di samping untuk mengelola data master, persetujuan, dan laporan.</p>
</div>
@endsection
