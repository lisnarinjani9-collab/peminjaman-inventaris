@extends('karyawan.index')

@section('title', 'Detail Peminjaman')

@section('content')

    <!-- Judul halaman -->
    <section class="section dark-background" style="padding: 110px 0 40px;">
      <div class="container">
        <h1 style="font-size: 32px; font-weight: 700;">Detail Pengajuan #{{ $peminjaman->id }}</h1>
        <p class="mb-0">Diajukan {{ $peminjaman->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</p>
      </div>
    </section>

    <section class="section light-background">
      <div class="container">

        @include('karyawan.components.alert')

        <div class="row justify-content-center">
          <div class="col-lg-9">

            <!-- Status -->
            <div class="card border-0 shadow-sm p-4 mb-3" style="border-radius: 16px;">
              <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h5 class="mb-0">Status Pengajuan</h5>
                @if ($peminjaman->status == 'pending')
                <span class="badge text-bg-warning fs-6">Menunggu</span>
                @elseif ($peminjaman->status == 'disetujui')
                <span class="badge fs-6" style="background: #b45309; color: #ffffff;">Disetujui</span>
                @elseif ($peminjaman->status == 'dipinjam')
                <span class="badge fs-6" style="background: #5a402b; color: #ffffff;">Dipinjam</span>
                @elseif ($peminjaman->status == 'dikembalikan')
                <span class="badge text-bg-success fs-6">Dikembalikan</span>
                @else
                <span class="badge text-bg-danger fs-6">Ditolak</span>
                @endif
              </div>

              @php
                $urutan = ['pending' => 1, 'disetujui' => 2, 'dipinjam' => 3, 'dikembalikan' => 4];
                $tahap = $urutan[$peminjaman->status] ?? 0;
                $namaTahap = ['Diajukan', 'Disetujui', 'Dipinjam', 'Dikembalikan'];
              @endphp

              @if ($peminjaman->status != 'ditolak')
              <div class="row text-center g-2 mb-3">
                @foreach ($namaTahap as $i => $nama)
                <div class="col-3">
                  <div class="py-2 rounded-3 {{ $tahap >= $i + 1 ? 'text-white' : 'text-muted bg-white border' }}"
                    style="{{ $tahap >= $i + 1 ? 'background: var(--accent-color);' : '' }} font-size: 14px;">
                    {{ $nama }}
                  </div>
                </div>
                @endforeach
              </div>
              @endif

              <p class="mb-0 text-muted">
                @if ($peminjaman->status == 'pending')
                Pengajuanmu sedang menunggu pengecekan.
                @elseif ($peminjaman->status == 'disetujui')
                Pengajuan disetujui. Silakan ambil aset dari petugas gudang.
                @elseif ($peminjaman->status == 'dipinjam')
                    @if ($peminjaman->tanggal_kembali->format('Y-m-d') < date('Y-m-d'))
                    <span class="text-danger fw-semibold">Terlambat.</span> Segera kembalikan aset ke petugas gudang.
                    @else
                    Aset sedang kamu pinjam. Untuk mengembalikan, bawa aset ke petugas gudang sebelum tanggal kembali. Status akan berubah setelah petugas memeriksa asetnya.
                    @endif
                @elseif ($peminjaman->status == 'dikembalikan')
                Aset sudah dikembalikan. Terima kasih.
                @else
                Pengajuan ini ditolak.
                @endif
              </p>
            </div>

            <!-- Tanggal dan aset -->
            <div class="card border-0 shadow-sm p-4 mb-3" style="border-radius: 16px;">
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <small class="text-muted">Tanggal pinjam</small><br>
                  <span class="fw-semibold">{{ $peminjaman->tanggal_pinjam->locale('id')->translatedFormat('d F Y') }}</span>
                </div>
                <div class="col-md-6">
                  <small class="text-muted">Tanggal kembali</small><br>
                  <span class="fw-semibold">{{ $peminjaman->tanggal_kembali->locale('id')->translatedFormat('d F Y') }}</span>
                </div>
              </div>

              <h5 class="mb-3">Aset yang Dipinjam</h5>

              @foreach ($peminjaman->details as $detail)
              <div class="d-flex align-items-center gap-3 {{ $loop->last ? '' : 'mb-3' }}">
                @if ($detail->asset->gambar)
                <img src="{{ asset('storage/' . $detail->asset->gambar) }}" alt="{{ $detail->asset->nama }}"
                  style="width: 56px; height: 56px; object-fit: cover; border-radius: 10px;">
                @else
                <div class="d-flex align-items-center justify-content-center text-muted"
                  style="width: 56px; height: 56px; border-radius: 10px; background: #f3ece1;">
                  <i class="bi bi-image"></i>
                </div>
                @endif
                <div class="flex-grow-1">
                  <div class="fw-semibold">{{ $detail->asset->nama }}</div>
                  @if ($detail->asset->bernilai_tinggi)
                  <small class="text-muted">Aset bernilai tinggi</small>
                  @endif
                </div>
                <div class="text-muted">Jumlah: {{ $detail->jumlah }}</div>
              </div>
              @endforeach
            </div>

            <!-- Data pengembalian, hanya muncul kalau sudah dikembalikan -->
            @if ($peminjaman->returnLog)
            <div class="card border-0 shadow-sm p-4 mb-3" style="border-radius: 16px;">
              <h5 class="mb-3">Data Pengembalian</h5>
              <div class="row g-3">
                <div class="col-md-4">
                  <small class="text-muted">Tanggal dikembalikan</small><br>
                  {{ $peminjaman->returnLog->created_at->locale('id')->translatedFormat('d F Y, H:i') }}
                </div>
                <div class="col-md-4">
                  <small class="text-muted">Kondisi aset</small><br>
                  {{ ucfirst(str_replace('_', ' ', $peminjaman->returnLog->kondisi_kembali)) }}
                </div>
                <div class="col-md-4">
                  <small class="text-muted">Diperiksa oleh</small><br>
                  {{ $peminjaman->returnLog->petugas->nama }}
                </div>
                @if ($peminjaman->returnLog->catatan)
                <div class="col-12">
                  <small class="text-muted">Catatan petugas</small><br>
                  {{ $peminjaman->returnLog->catatan }}
                </div>
                @endif
              </div>
            </div>
            @endif

            <a href="{{ route('karyawan.peminjaman') }}" class="btn btn-light rounded-pill px-4">Kembali</a>

          </div>
        </div>

      </div>
    </section>

@endsection
