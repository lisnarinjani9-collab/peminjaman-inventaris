@extends('karyawan.index')

@section('title', 'Beranda')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Pinjam Inventaris Kantor Jadi Lebih Mudah</h1>
            <p>Ajukan peminjaman aset, pantau statusnya, dan kembalikan tepat waktu. Semua tercatat rapi dalam satu sistem.</p>
            <div class="d-flex">
              <a href="{{ route('karyawan.peminjaman.create') }}" class="btn-get-started">Ajukan Peminjaman</a>
              <a href="{{ route('karyawan.katalog') }}" class="btn-watch-video d-flex align-items-center"><i class="bi bi-grid"></i><span>Lihat Katalog</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('template-karyawan/assets/img/hero-inventaris.svg') }}" class="img-fluid animated" alt="Peminjaman inventaris">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Sistem</h2>
      </div>

      <div class="container">
        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
              Sistem Peminjaman Inventaris membantu karyawan meminjam aset kantor secara resmi, mulai dari pengajuan
              sampai pengembalian, tanpa perlu catatan manual.
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> <span>Lihat aset yang tersedia beserta stoknya secara langsung.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Ajukan peminjaman lebih dari satu aset dalam satu pengajuan.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Pantau status pengajuan dan riwayat peminjaman kapan saja.</span></li>
            </ul>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p>Setiap pengajuan akan divalidasi oleh Petugas Gudang, lalu aset diserahkan dan dicatat kondisinya saat dikembalikan. Dengan begitu, ketersediaan aset selalu terpantau dan tanggung jawab peminjam jelas.</p>
            <a href="{{ route('karyawan.peminjaman') }}" class="read-more"><span>Lihat Peminjaman Saya</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Kategori Section -->
    <section id="kategori" class="services section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Kategori Aset</h2>
        <p>Jenis aset yang bisa kamu pinjam</p>
      </div>

      <div class="container">
        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-laptop icon"></i></div>
              <h4><a href="{{ route('karyawan.katalog') }}" class="stretched-link">Elektronik</a></h4>
              <p>Laptop, proyektor, kamera, dan perangkat elektronik lainnya.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-car-front icon"></i></div>
              <h4><a href="{{ route('karyawan.katalog') }}" class="stretched-link">Kendaraan</a></h4>
              <p>Kendaraan operasional untuk keperluan dinas dan kegiatan kantor.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-door-open icon"></i></div>
              <h4><a href="{{ route('karyawan.katalog') }}" class="stretched-link">Ruangan</a></h4>
              <p>Ruang rapat dan ruang pertemuan untuk acara atau diskusi tim.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-briefcase icon"></i></div>
              <h4><a href="{{ route('karyawan.katalog') }}" class="stretched-link">Perlengkapan Kantor</a></h4>
              <p>Perlengkapan pendukung kerja dan kegiatan operasional harian.</p>
            </div>
          </div>

        </div>
      </div>

    </section><!-- /Kategori Section -->

    <!-- Galeri Aset Section -->
    <section id="portfolio" class="portfolio section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Galeri Aset</h2>
        <p>Foto aset yang bisa kamu pinjam, dikelompokkan per kategori</p>
      </div>

      <div class="container">

        @if ($aset->count() > 0)
        <div class="isotope-layout" data-default-filter="*" data-layout="fitRows" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">Semua</li>
            @foreach ($kategori as $item)
            <li data-filter=".filter-kategori-{{ $item->id }}">{{ $item->nama }}</li>
            @endforeach
          </ul>

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($aset as $item)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-kategori-{{ $item->kategori_id }}">
              <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid" alt="{{ $item->nama }}"
                style="width: 100%; aspect-ratio: 4 / 3; object-fit: cover;">
              <div class="portfolio-info">
                <h4>{{ $item->nama }}</h4>
                <p>{{ $item->category->nama }} &middot; Stok {{ $item->stok_tersedia }}</p>
                <a href="{{ asset('storage/' . $item->gambar) }}" title="{{ $item->nama }}" data-gallery="galeri-aset" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="{{ route('karyawan.peminjaman.create', ['aset' => $item->id]) }}" title="Ajukan pinjam" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
            @endforeach
          </div>

        </div>
        @else
        <p class="text-center text-muted mb-0">Belum ada foto aset yang tersedia.</p>
        @endif

      </div>

    </section><!-- /Galeri Aset Section -->

    <!-- Cara Meminjam Section -->
    <section id="cara" class="services section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Cara Meminjam</h2>
        <p>Empat langkah dari pengajuan sampai pengembalian</p>
      </div>

      <div class="container">
        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-1-circle icon"></i></div>
              <h4>Pilih Aset</h4>
              <p>Buka Katalog atau Galeri Aset, lalu pilih aset yang stoknya masih tersedia.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-2-circle icon"></i></div>
              <h4>Ajukan Peminjaman</h4>
              <p>Klik Ajukan Peminjaman, isi tanggal pinjam dan tanggal kembali, pilih aset beserta jumlahnya, lalu kirim.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-3-circle icon"></i></div>
              <h4>Tunggu Persetujuan</h4>
              <p>Petugas Gudang memeriksa pengajuanmu. Aset bernilai tinggi disetujui Admin GA. Pantau di menu Peminjaman Saya.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-4-circle icon"></i></div>
              <h4>Ambil dan Kembalikan</h4>
              <p>Ambil aset dari petugas setelah disetujui, lalu kembalikan sebelum tanggal kembali. Kondisinya akan dicatat.</p>
            </div>
          </div>

        </div>
      </div>

    </section><!-- /Cara Meminjam Section -->
    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="{{ asset('template-karyawan/assets/img/bg/bg-8.webp') }}" alt="">

      <div class="container">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-9 text-center text-xl-start">
            <h3>Butuh Aset untuk Pekerjaanmu?</h3>
            <p>Cek ketersediaan aset di katalog, lalu ajukan peminjaman sekarang. Pengajuanmu akan segera diproses oleh petugas.</p>
          </div>
          <div class="col-xl-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="{{ route('karyawan.peminjaman.create') }}">Ajukan Sekarang</a>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

@endsection
