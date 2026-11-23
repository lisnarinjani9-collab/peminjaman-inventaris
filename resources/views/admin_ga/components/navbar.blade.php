@php
    $labelRole = [
        'admin_ga' => 'Admin GA',
        'petugas_gudang' => 'Petugas Gudang',
        'karyawan' => 'Karyawan',
    ][auth()->user()->role] ?? auth()->user()->role;
@endphp

<header class="navbar-custom">
    <div class="navbar-left">
        <!-- tombol kecilkan sidebar (layar besar) -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
            id="desktop-sidebar-toggle" aria-label="Kecilkan sidebar">
            <i class="bi bi-chevron-bar-left"></i>
        </button>
        <!-- tombol buka sidebar (layar kecil) -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="navbar-actions ms-auto">
        <button class="navbar-action-btn me-1" aria-label="Layar penuh" id="btn-fullscreen">
            <i class="bi bi-arrows-fullscreen"></i>
        </button>

        <div class="dropdown ms-2">
            <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" id="profile-dropdown">
                <img src="{{ asset('spark/assets/images/avatar.png') }}" alt="Foto profil" class="navbar-profile-img">
                <span class="navbar-profile-name d-none d-md-inline">{{ auth()->user()->nama }}</span>
                <i class="bi bi-chevron-down navbar-profile-caret"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
                <li class="dropdown-header">{{ $labelRole }}</li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar?')">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
