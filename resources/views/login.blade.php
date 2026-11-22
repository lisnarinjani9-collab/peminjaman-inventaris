@include('partials.login-head')

<body>
    <div class="container-fluid">
        <div class="row g-0 login-wrapper">

            <!-- Panel kiri -->
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center brand-panel p-5">
                <div style="max-width: 420px;">
                    <h2 class="brand-title display-6 mb-4">Peminjaman aset kantor, tercatat rapi dari awal sampai kembali.</h2>

                    <div class="d-flex align-items-start gap-3 py-3 border-top">
                        <div class="point-icon"><i class="bi bi-boxes"></i></div>
                        <div>
                            <div class="fw-bold">Data aset terpusat</div>
                            <small class="text-muted">Laptop, proyektor, kendaraan, dan ruang rapat beserta stoknya.</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3 py-3 border-top">
                        <div class="point-icon"><i class="bi bi-arrow-left-right"></i></div>
                        <div>
                            <div class="fw-bold">Peminjaman terkontrol</div>
                            <small class="text-muted">Ajukan, setujui, dan serah terima dalam satu alur.</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3 py-3 border-top">
                        <div class="point-icon"><i class="bi bi-clipboard-check"></i></div>
                        <div>
                            <div class="fw-bold">Pengembalian tercatat</div>
                            <small class="text-muted">Kondisi dan keterlambatan dicatat saat aset kembali.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel kanan -->
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center p-4">
                <div class="w-100" style="max-width: 400px;">
                    <div class="brand-logo mb-4"><i class="bi bi-box-seam"></i></div>

                    <h3 class="fw-bold mb-1">Selamat Datang</h3>
                    <p class="text-muted mb-4">Masuk untuk mengelola peminjaman aset.</p>

                    <form action="{{ route('authenticate') }}" method="post">
                        @csrf
                        <input class="form-control mb-3" type="email" name="email" value="{{ old('email') }}" placeholder="Email">

                        <div class="password-box mb-3">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                            <button class="btn" type="button" id="togglePassword"><i class="bi bi-eye"></i></button>
                        </div>

                        @include('admin_ga.components.alert')

                        <button type="submit" class="btn btn-login w-100 mt-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </button>
                    </form>

                    <p class="text-center text-muted small mt-4 mb-0">&copy; {{ date('Y') }} Sistem Peminjaman Inventaris</p>
                </div>
            </div>

        </div>
    </div>
@include('partials.login-script')
</body>
