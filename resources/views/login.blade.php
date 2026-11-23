<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Peminjaman Inventaris</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('asset/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" />

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="{{ asset('asset/icons-1.13.1/font/bootstrap-icons.min.css') }}" />

    <style>
        :root {
            --ink: #12201c;
            --teal: #0f766e;
            --teal-dark: #0b5a54;
            --soft: #f3f6f4;
            --line: #d5ddd9;
            --muted: #5f6f6a;
        }

        body {
            font-family: "Segoe UI", system-ui, -apple-system, Roboto, Arial, sans-serif;
            color: var(--ink);
        }

        .login-wrapper {
            min-height: 100vh;
        }

        /* panel kiri */
        .brand-panel {
            background: var(--soft);
            position: relative;
        }

        /* pita kuning hitam di bagian atas */
        .brand-panel::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 14px;
            background: repeating-linear-gradient(-45deg, #ffd23f 0 14px, var(--ink) 14px 28px);
        }

        .brand-title {
            font-weight: 800;
            line-height: 1.2;
        }

        .point-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 12px;
            background: #fff;
            border: 1.5px solid var(--ink);
            color: var(--teal);
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* panel kanan */
        .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--teal);
            color: #fff;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control {
            border: 1.5px solid var(--line);
            border-radius: 10px;
            padding: 0.75rem 0.9rem;
        }

        .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 0.25rem rgba(15, 118, 110, 0.18);
        }

        .password-box {
            position: relative;
        }

        .password-box .form-control {
            padding-right: 3rem;
        }

        #togglePassword {
            position: absolute;
            top: 50%;
            right: 6px;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: var(--muted);
            width: 40px;
            height: 40px;
        }

        .btn-login {
            background: var(--ink);
            color: #fff;
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: 600;
        }

        .btn-login:hover {
            background: var(--teal-dark);
            color: #fff;
        }
    </style>
</head>

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

                        @if (session('success'))
                        <div class="alert alert-success fade show" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger fade show" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger fade show" role="alert">
                            @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                            @endforeach
                        </div>
                        @endif

                        <button type="submit" class="btn btn-login w-100 mt-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </button>
                    </form>

                    <p class="text-center text-muted small mt-4 mb-0">&copy; {{ date('Y') }} Sistem Peminjaman Inventaris</p>
                </div>
            </div>

        </div>
    </div>
    <!-- Script -->
    <script src="{{ asset('asset/bootstrap-5.3.8-dist/js/bootstrap.bundle.js') }}"></script>
    <script>
        // tombol mata: tampilkan atau sembunyikan password
        const toggle = document.getElementById('togglePassword');
        const input = document.getElementById('password');

        toggle.addEventListener('click', function () {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            this.querySelector('i').className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    </script>
</body>

</html>
