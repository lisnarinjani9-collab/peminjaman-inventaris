@extends('admin_ga.index')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Ringkasan sistem peminjaman inventaris.</p>
    </div>
</div>

<div class="card p-4 border-light shadow-sm">
    <h5 class="mb-1">Selamat datang, {{ auth()->user()->nama }}</h5>
    <p class="text-muted mb-0">Gunakan menu di samping untuk mengelola data master, persetujuan, dan laporan.</p>
</div>
@endsection
