<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('karyawan.dashboard') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">Inventaris</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('karyawan.dashboard') }}#hero" class="{{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}">Beranda</a></li>
          <li><a href="{{ route('karyawan.dashboard') }}#about">Tentang</a></li>
          <li><a href="{{ route('karyawan.dashboard') }}#kategori">Kategori</a></li>
          <li><a href="{{ route('karyawan.dashboard') }}#alur">Portfolio</a></li>
          <li><a href="{{ route('karyawan.katalog') }}" class="{{ request()->routeIs('karyawan.katalog') ? 'active' : '' }}">Katalog</a></li>
          <li><a href="{{ route('karyawan.peminjaman') }}" class="{{ request()->routeIs('karyawan.peminjaman*') ? 'active' : '' }}">Peminjaman Saya</a></li>
          @auth
          <li class="dropdown"><a href="#"><span>{{ auth()->user()->nama }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li>
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar?')">
                  @csrf
                  <button type="submit" class="btn btn-link text-start w-100" style="padding: 10px 20px; text-decoration: none;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('karyawan.peminjaman.create') }}">Ajukan Peminjaman</a>

    </div>
  </header>
