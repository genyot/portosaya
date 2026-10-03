<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MR Admin') }} — Admin Area</title>

    {{-- Terapkan tema SEBELUM render (anti-flicker) --}}
    <script>
        (function () {
            var t = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        /* =====================================================
           TEMA: DARK (default)
        ===================================================== */
        :root {
            --bg-main: #171d32;
            --bg-sidebar: #11172a;
            --bg-card: #222a43;
            --bg-alt: #1d243a;
            --bg-input: #171d32;

            --text-primary: #ffffff;
            --text-secondary: #aeb8ca;
            --text-muted: #8993ab;
            --text-dim: #78839c;

            --border: rgba(255,255,255,.07);
            --border-strong: rgba(255,255,255,.12);

            --surface-1: rgba(255,255,255,.03);
            --surface-2: rgba(255,255,255,.05);

            --accent: #7c6cff;
            --accent-2: #4d9cff;
            --accent-soft: rgba(124,108,255,.12);
        }

        /* =====================================================
           TEMA: LIGHT
        ===================================================== */
        [data-theme="light"] {
            --bg-main: #f3f4f9;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-alt: #f7f8fc;
            --bg-input: #f7f8fc;

            --text-primary: #1a1d2b;
            --text-secondary: #4a5169;
            --text-muted: #6b7288;
            --text-dim: #8a90a4;

            --border: rgba(20,25,50,.10);
            --border-strong: rgba(20,25,50,.18);

            --surface-1: rgba(20,25,50,.02);
            --surface-2: rgba(20,25,50,.04);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;

            background: var(--bg-sidebar);

            color: var(--text-primary);

            font-family: 'Inter', sans-serif;

            -webkit-font-smoothing: antialiased;

            transition: background-color .25s ease, color .25s ease;
        }

        /* Halaman auth full-screen */
        .auth-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;

            background:
                radial-gradient(
                    circle at top left,
                    rgba(101,81,232,0.12),
                    transparent 35%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(77,156,255,0.08),
                    transparent 35%
                ),
                #11172a;
        }

        /* Kartu default untuk halaman auth (selain login yang punya card sendiri) */
        .auth-card {
            width: 100%;
            max-width: 430px;

            background: var(--bg-card);

            border: 1px solid var(--border);
            border-radius: 12px;

            padding: 40px;

            box-shadow: 0 25px 70px rgba(0,0,0,0.35);
        }

        .auth-card h1 {
            margin: 0 0 8px;

            color: var(--text-primary);

            font-size: 22px;
            font-weight: 600;

            line-height: 1.3;
        }

        .auth-card .auth-text {
            margin: 0 0 24px;

            color: var(--text-secondary);

            font-size: 13px;

            line-height: 1.6;
        }

        .auth-card label {
            display: block;

            margin-bottom: 8px;

            color: var(--text-secondary);

            font-size: 12px;
            font-weight: 500;
        }

        .auth-card input[type="email"],
        .auth-card input[type="password"],
        .auth-card input[type="text"] {
            width: 100%;
            height: 46px;

            padding: 0 15px;

            background: var(--bg-input);
            color: var(--text-primary);

            border: 1px solid var(--border);
            border-radius: 8px;

            outline: none;

            font-family: 'Inter', sans-serif;
            font-size: 13px;

            transition: all 0.2s ease;
        }

        .auth-card input::placeholder {
            color: var(--text-dim);
            opacity: 1;
        }

        .auth-card input:focus {
            border-color: #6551e8;

            box-shadow: 0 0 0 3px rgba(101,81,232,0.14);
        }

        .auth-field {
            margin-bottom: 18px;
        }

        .auth-error {
            display: flex;
            align-items: center;
            gap: 6px;

            margin-top: 7px;

            color: #f05268;

            font-size: 11px;

            line-height: 1.4;
        }

        .auth-status {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 20px;

            padding: 12px 14px;

            background: rgba(54,201,143,0.10);
            color: #36c98f;

            border: 1px solid rgba(54,201,143,0.20);
            border-radius: 8px;

            font-size: 12px;
        }

        .auth-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            gap: 12px;

            margin-top: 24px;
        }

        .auth-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            height: 46px;

            padding: 0 20px;

            background: #6551e8;
            color: var(--text-primary);

            border: none;
            border-radius: 8px;

            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 600;

            letter-spacing: 0.3px;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .auth-btn:hover {
            background: #7461ed;

            transform: translateY(-1px);

            box-shadow: 0 8px 20px rgba(101,81,232,0.25);
        }

        .auth-btn-full {
            width: 100%;
        }

        .auth-link {
            color: #a397ef;

            font-size: 12px;

            text-decoration: none;

            transition: 0.2s;
        }

        .auth-link:hover {
            color: #c1b8ff;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
