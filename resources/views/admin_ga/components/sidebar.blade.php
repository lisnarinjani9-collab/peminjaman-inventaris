<aside id="sidebar">
    <div class="sidebar-brand">
        <div class="logo"><i class="bi bi-box-seam"></i></div>
        <div>
            <strong>Peminjaman Inventaris</strong>
            <small>Admin GA</small>
        </div>
    </div>

    <ul class="sidebar-nav">
        <li>
            <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-label">Data Master</li>
        <li>
            <a class="sidebar-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}" href="{{ route('admin.kategori') }}">
                <i class="bi bi-tags-fill"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li>
            <a class="sidebar-link" href="#">
                <i class="bi bi-boxes"></i>
                <span>Aset</span>
            </a>
        </li>
        <li>
            <a class="sidebar-link" href="#">
                <i class="bi bi-people-fill"></i>
                <span>Akun</span>
            </a>
        </li>

        <li class="sidebar-label">Peminjaman</li>
        <li>
            <a class="sidebar-link" href="#">
                <i class="bi bi-patch-check-fill"></i>
                <span>Persetujuan</span>
            </a>
        </li>
        <li>
            <a class="sidebar-link" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                <span>Laporan</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-bottom">
        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar?')">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-door-open-fill"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
