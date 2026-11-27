@extends('karyawan.index')

@section('title', 'Peminjaman Saya')

@section('content')

    <!-- Judul halaman -->
    <section class="section dark-background" style="padding: 110px 0 40px;">
      <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <h1 style="font-size: 32px; font-weight: 700;">Peminjaman Saya</h1>
          <p class="mb-0">Pantau status pengajuan dan riwayat peminjamanmu di sini.</p>
        </div>
        <a href="{{ route('karyawan.peminjaman.create') }}" class="btn rounded-pill px-4" style="background: #f5b301; color: #0b1b33; font-weight: 600; white-space: nowrap;">Ajukan Peminjaman</a>
      </div>
    </section>

    <section class="section light-background">
      <div class="container">

        @include('karyawan.components.alert')

        @forelse ($peminjaman as $item)
        <div class="card border-0 shadow-sm mb-3" style="border-radius: 16px;">
          <div class="card-body p-4">

            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
              <div>
                <h5 class="mb-1">Pengajuan #{{ $item->id }}</h5>
                <small class="text-muted">Diajukan {{ $item->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</small>
              </div>

              @if ($item->status == 'pending')
              <span class="badge text-bg-warning fs-6">Menunggu</span>
              @elseif ($item->status == 'disetujui')
              <span class="badge text-bg-info fs-6">Disetujui</span>
              @elseif ($item->status == 'dipinjam')
              <span class="badge text-bg-primary fs-6">Dipinjam</span>
              @elseif ($item->status == 'dikembalikan')
              <span class="badge text-bg-success fs-6">Dikembalikan</span>
              @else
              <span class="badge text-bg-danger fs-6">Ditolak</span>
              @endif
            </div>

            <div class="row g-3">
              <div class="col-lg-7">
                @foreach ($item->details as $detail)
                <div class="d-flex align-items-center gap-3 mb-2">
                  @if ($detail->asset->gambar)
                  <img src="{{ asset('storage/' . $detail->asset->gambar) }}" alt="{{ $detail->asset->nama }}"
                    style="width: 48px; height: 48px; object-fit: cover; border-radius: 10px;">
                  @else
                  <div class="d-flex align-items-center justify-content-center text-muted"
                    style="width: 48px; height: 48px; border-radius: 10px; background: #e9eef5;">
                    <i class="bi bi-image"></i>
                  </div>
                  @endif
                  <div>
                    <div class="fw-semibold">{{ $detail->asset->nama }}</div>
                    <small class="text-muted">Jumlah: {{ $detail->jumlah }}</small>
                  </div>
                </div>
                @endforeach
              </div>

              <div class="col-lg-5">
                <div class="mb-1"><small class="text-muted">Tanggal pinjam</small><br>{{ $item->tanggal_pinjam->locale('id')->translatedFormat('d F Y') }}</div>
                <div><small class="text-muted">Tanggal kembali</small><br>{{ $item->tanggal_kembali->locale('id')->translatedFormat('d F Y') }}</div>
              </div>
            </div>

            <hr>

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
              <small class="text-muted">
                @if ($item->status == 'pending')
                Pengajuanmu sedang menunggu pengecekan.
                @elseif ($item->status == 'disetujui')
                Pengajuan disetujui. Silakan ambil aset dari petugas gudang.
                @elseif ($item->status == 'dipinjam')
                    @if ($item->tanggal_kembali->format('Y-m-d') < date('Y-m-d'))
                    <span class="text-danger fw-semibold">Terlambat.</span> Segera kembalikan aset ke petugas gudang.
                    @else
                    Aset sedang kamu pinjam. Kembalikan sebelum tanggal kembali.
                    @endif
                @elseif ($item->status == 'dikembalikan')
                Aset sudah dikembalikan. Terima kasih.
                @else
                Pengajuan ini ditolak.
                @endif
              </small>
              <a href="{{ route('karyawan.peminjaman.show', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">Lihat Detail</a>
            </div>

          </div>
        </div>
        @empty
        <div class="card border-0 shadow-sm text-center p-5" style="border-radius: 16px;">
          <div class="text-muted mb-2" style="font-size: 40px;"><i class="bi bi-clipboard-x"></i></div>
          <h5>Belum ada pengajuan</h5>
          <p class="text-muted">Kamu belum pernah mengajukan peminjaman. Pilih aset di katalog, lalu ajukan.</p>
          <div>
            <a href="{{ route('karyawan.peminjaman.create') }}" class="btn btn-primary rounded-pill px-4">Ajukan Peminjaman</a>
          </div>
        </div>
        @endforelse

      </div>
    </section>

@endsection
