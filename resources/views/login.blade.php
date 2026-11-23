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
