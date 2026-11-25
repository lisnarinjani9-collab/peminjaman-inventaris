<footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="{{ route('karyawan.dashboard') }}" class="d-flex align-items-center">
            <span class="sitename">Inventaris</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Sistem Peminjaman Inventaris Kantor</p>
            <p>Dikelola oleh bagian General Affairs (GA)</p>
            <p class="mt-3">Ajukan, pantau, dan kembalikan peminjaman aset kantor dengan mudah dan tercatat.</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Menu</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.dashboard') }}">Beranda</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.katalog') }}">Katalog Aset</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.peminjaman') }}">Peminjaman Saya</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.peminjaman.create') }}">Ajukan Peminjaman</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h4>Kategori Aset</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.katalog') }}">Elektronik</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.katalog') }}">Kendaraan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.katalog') }}">Ruangan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('karyawan.katalog') }}">Perlengkapan Kantor</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>{{ date('Y') }}</span> <strong class="px-1 sitename">Peminjaman Inventaris</strong> <span>Hak cipta dilindungi</span></p>
      <div class="credits">
        Template oleh <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>
