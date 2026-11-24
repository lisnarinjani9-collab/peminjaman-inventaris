@extends('petugas_gudang.index')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Ringkasan tugas petugas gudang.</p>
    </div>
</div>

<div class="card p-4 border-light shadow-sm">
    <h5 class="mb-1">Selamat datang, {{ auth()->user()->nama }}</h5>
    <p class="text-muted mb-0">Gunakan menu di samping untuk memverifikasi pengajuan, serah terima, dan pengembalian aset.</p>
</div>
@endsection
