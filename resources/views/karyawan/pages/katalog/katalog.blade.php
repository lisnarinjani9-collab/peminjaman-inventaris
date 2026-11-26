@extends('karyawan.index')

@section('title', 'Katalog')

@section('content')

    <!-- Judul halaman -->
    <section class="page-title dark-background" style="padding: 110px 0 40px;">
      <div class="container">
        <h1>Katalog Aset</h1>
        <p class="mb-0">Pilih aset yang ingin kamu pinjam. Hanya aset dengan stok tersedia yang ditampilkan.</p>
      </div>
    </section>

    <section class="section light-background">
      <div class="container">

        @include('karyawan.components.alert')

        <!-- Cari dan filter kategori -->
        <div class="row g-3 align-items-center mb-4">
          <div class="col-lg-4">
            <input type="text" id="cari" class="form-control" placeholder="Cari nama aset...">
          </div>
          <div class="col-lg-8 d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-sm btn-primary filter-kategori" data-kategori="">Semua</button>
            @foreach ($kategori as $item)
            <button type="button" class="btn btn-sm btn-outline-primary filter-kategori" data-kategori="{{ $item->nama }}">{{ $item->nama }}</button>
            @endforeach
          </div>
        </div>

        <div class="row gy-4" id="daftar-aset">
          @forelse ($aset as $item)
          <div class="col-6 col-md-4 col-xl-3 kartu-aset" data-nama="{{ strtolower($item->nama) }}" data-kategori="{{ $item->category->nama }}">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">

              @if ($item->gambar)
              <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                style="width: 100%; height: 190px; object-fit: cover;">
              @else
              <div class="d-flex align-items-center justify-content-center text-muted"
                style="width: 100%; height: 190px; background: #e9eef5; font-size: 40px;">
                <i class="bi bi-image"></i>
              </div>
              @endif

              <div class="card-body d-flex flex-column">
                <small class="text-muted">{{ $item->category->nama }}</small>
                <h5 class="mt-1 mb-2" style="font-size: 17px;">{{ $item->nama }}</h5>

                <div class="mb-2">
                  <span class="badge text-bg-success">Stok: {{ $item->stok_tersedia }}</span>
                  @if ($item->kondisi == 'baik')
                  <span class="badge text-bg-light border">Baik</span>
                  @elseif ($item->kondisi == 'rusak_ringan')
                  <span class="badge text-bg-warning">Rusak Ringan</span>
                  @else
                  <span class="badge text-bg-danger">Rusak Berat</span>
                  @endif
                </div>

                @if ($item->bernilai_tinggi)
                <small class="text-muted mb-2"><i class="bi bi-shield-check"></i> Perlu persetujuan Admin GA</small>
                @endif

                <a href="{{ route('karyawan.peminjaman.create', ['aset' => $item->id]) }}" class="btn btn-primary btn-sm mt-auto rounded-pill">Ajukan Pinjam</a>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center text-muted py-5">Belum ada aset yang tersedia untuk dipinjam.</div>
          @endforelse
        </div>

        <!-- tampil kalau hasil cari atau filter kosong -->
        <div id="kosong" class="text-center text-muted py-5" style="display: none;">Aset tidak ditemukan.</div>

      </div>
    </section>

    <script>
      // cari nama dan filter kategori, tanpa reload halaman
      const kolomCari = document.getElementById('cari');
      const tombolFilter = document.querySelectorAll('.filter-kategori');
      const kartu = document.querySelectorAll('.kartu-aset');
      const pesanKosong = document.getElementById('kosong');
      let kategoriDipilih = '';

      function tampilkan() {
        const kataKunci = kolomCari.value.toLowerCase();
        let jumlah = 0;

        kartu.forEach(function (item) {
          const cocokNama = item.dataset.nama.includes(kataKunci);
          const cocokKategori = kategoriDipilih === '' || item.dataset.kategori === kategoriDipilih;

          if (cocokNama && cocokKategori) {
            item.style.display = '';
            jumlah++;
          } else {
            item.style.display = 'none';
          }
        });

        pesanKosong.style.display = (jumlah === 0 && kartu.length > 0) ? '' : 'none';
      }

      kolomCari.addEventListener('input', tampilkan);

      tombolFilter.forEach(function (tombol) {
        tombol.addEventListener('click', function () {
          kategoriDipilih = this.dataset.kategori;

          tombolFilter.forEach(function (t) {
            t.classList.remove('btn-primary');
            t.classList.add('btn-outline-primary');
          });
          this.classList.remove('btn-outline-primary');
          this.classList.add('btn-primary');

          tampilkan();
        });
      });
    </script>

@endsection
