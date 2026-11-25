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
            <img src="{{ asset('template-karyawan/assets/img/hero-img.png') }}" class="img-fluid animated" alt="Peminjaman inventaris">
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

    <!-- Alur Section -->
    <section id="alur" class="services section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Alur Peminjaman</h2>
        <p>Empat langkah dari pengajuan sampai pengembalian</p>
      </div>

      <div class="container">
        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-1-circle icon"></i></div>
              <h4>Ajukan</h4>
              <p>Pilih aset dari katalog, tentukan jumlah, tanggal pinjam, dan tanggal kembali.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-2-circle icon"></i></div>
              <h4>Validasi</h4>
              <p>Petugas Gudang memeriksa pengajuan, lalu menyetujui atau menolaknya.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-3-circle icon"></i></div>
              <h4>Serah Terima</h4>
              <p>Ambil aset yang sudah disetujui langsung dari petugas gudang.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-4-circle icon"></i></div>
              <h4>Pengembalian</h4>
              <p>Kembalikan aset sebelum batas waktu. Kondisinya akan diperiksa dan dicatat.</p>
            </div>
          </div>

        </div>
      </div>

    </section><!-- /Alur Section -->

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

    <!-- FAQ Section -->
    <section id="faq" class="faq-2 section light-background">

      <div class="container section-title" data-aos="fade-up">
        <h2>Pertanyaan Umum</h2>
        <p>Hal-hal yang sering ditanyakan seputar peminjaman inventaris</p>
      </div>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="faq-container">

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Bagaimana cara meminjam aset?</h3>
                <div class="faq-content">
                  <p>Buka menu Katalog untuk melihat aset yang tersedia, lalu klik Ajukan Peminjaman. Pilih aset, isi jumlah, dan tentukan tanggal pinjam serta tanggal kembali.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Apa arti status pengajuan saya?</h3>
                <div class="faq-content">
                  <p>Pending berarti menunggu validasi petugas. Disetujui berarti aset siap diambil. Dipinjam berarti aset sedang kamu gunakan. Dikembalikan berarti peminjaman selesai. Ditolak berarti pengajuan tidak disetujui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Kenapa aset yang saya cari tidak muncul di katalog?</h3>
                <div class="faq-content">
                  <p>Katalog hanya menampilkan aset yang stoknya masih tersedia. Jika stok sedang habis dipinjam, coba cek kembali nanti.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Bagaimana cara mengembalikan aset?</h3>
                <div class="faq-content">
                  <p>Serahkan aset langsung ke Petugas Gudang sebelum atau pada tanggal kembali. Petugas akan memeriksa kondisinya dan mencatat pengembalian di sistem.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

            </div>
          </div>
        </div>
      </div>

    </section><!-- /FAQ Section -->

@endsection
