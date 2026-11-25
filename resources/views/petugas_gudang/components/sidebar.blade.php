<div class="sidebar-wrapper" id="sidebar">
    <a href="{{ route('petugas.dashboard') }}" class="sidebar-brand">
        <i class="bi bi-box-seam"></i>
        <span>Peminjaman Inventaris</span>
    </a>

    <div class="flex-grow-1 overflow-y-auto">
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Menu</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('petugas.dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" title="Dashboard">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Peminjaman</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('petugas.pengajuan') }}" class="sidebar-menu-link {{ request()->routeIs('petugas.pengajuan*') ? 'active' : '' }}" title="Pengajuan">
                        <i class="bi bi-patch-check-fill"></i>
                        <span>Pengajuan</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('petugas.serah_terima') }}" class="sidebar-menu-link {{ request()->routeIs('petugas.serah_terima*') ? 'active' : '' }}" title="Serah Terima">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Serah Terima</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link" title="Pengembalian">
                        <i class="bi bi-box-arrow-in-left"></i>
                        <span>Pengembalian</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
