<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Peminjaman Inventaris</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('asset/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" />

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="{{ asset('asset/icons-1.13.1/font/bootstrap-icons.min.css') }}" />

    <!-- Style halaman login dan register -->
    <link rel="stylesheet" href="{{ asset('style/auth.css') }}" />
</head>

<body>
    <div class="auth-page">

        <!-- Panel kiri -->
        <div class="auth-brand">
            <div class="brand-top">
                <div class="brand-mark"><i class="bi bi-box-seam"></i></div>
                <span>Peminjaman Inventaris</span>
            </div>
            <div>
                <h2 class="brand-title">Peminjaman aset kantor, <span>tercatat rapi</span> dari awal sampai kembali.</h2>
                <p class="brand-desc">Satu sistem untuk mengajukan, menyetujui, menyerahkan, dan mengembalikan aset perusahaan.</p>

                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-boxes"></i></div>
                    <div>
                        <strong>Data aset terpusat</strong>
                        <small>Laptop, proyektor, kendaraan, dan ruang rapat beserta stoknya.</small>
                    </div>
                </div>
                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-arrow-left-right"></i></div>
                    <div>
                        <strong>Peminjaman terkontrol</strong>
                        <small>Ajukan, setujui, dan serah terima dalam satu alur.</small>
                    </div>
                </div>
                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-clipboard-check"></i></div>
                    <div>
                        <strong>Pengembalian tercatat</strong>
                        <small>Kondisi aset dicatat saat dikembalikan.</small>
                    </div>
                </div>
            </div>

            <div class="brand-footer">&copy; {{ date('Y') }} Sistem Peminjaman Inventaris</div>
        </div>

        <!-- Panel kanan -->
        <div class="auth-form-side">
            <div class="auth-card">

                <div class="mobile-brand">
                    <div class="brand-mark"><i class="bi bi-box-seam"></i></div>
                    <span>Peminjaman Inventaris</span>
                </div>

                <h1>Selamat datang</h1>
                <p class="subtitle">Masuk untuk mengelola peminjaman aset.</p>

                @if (session('success'))
                <div class="auth-alert auth-alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                </div>
                @endif
                @if (session('error'))
                <div class="auth-alert auth-alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>{{ session('error') }}</div>
                </div>
                @endif
                @if ($errors->any())
                <div class="auth-alert auth-alert-danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
                @endif

                <form action="{{ route('authenticate') }}" method="post">
                    @csrf

                    <label class="field-label" for="email">Email</label>
                    <div class="field">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="nama@email.com">
                    </div>

                    <label class="field-label" for="password">Password</label>
                    <div class="field has-toggle">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Masukkan password">
                        <button type="button" id="togglePassword" aria-label="Tampilkan password"><i class="bi bi-eye"></i></button>
                    </div>

                    <button type="submit" class="btn-auth">Masuk <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>
        </div>

    </div>

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
