<div class="sidebar-wrapper" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <i class="bi bi-box-seam"></i>
        <span>Peminjaman Inventaris</span>
    </a>

    <div class="flex-grow-1 overflow-y-auto">
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Menu</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Data Master</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.kategori') }}" class="sidebar-menu-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}" title="Kategori">
                        <i class="bi bi-tags-fill"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.aset') }}" class="sidebar-menu-link {{ request()->routeIs('admin.aset*') ? 'active' : '' }}" title="Aset">
                        <i class="bi bi-boxes"></i>
                        <span>Aset</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.akun') }}" class="sidebar-menu-link {{ request()->routeIs('admin.akun*') ? 'active' : '' }}" title="Akun Petugas">
                        <i class="bi bi-people-fill"></i>
                        <span>Akun</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Peminjaman</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.persetujuan') }}" class="sidebar-menu-link {{ request()->routeIs('admin.persetujuan*') ? 'active' : '' }}" title="Persetujuan">
                        <i class="bi bi-patch-check-fill"></i>
                        <span>Persetujuan</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.laporan') }}" class="sidebar-menu-link {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}" title="Laporan">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
