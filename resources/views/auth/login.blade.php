<x-guest-layout>

    <div class="login-wrapper">

        <div class="login-card">

            {{-- LOGO --}}
            <div class="login-brand">

                <div class="logo-box">

                    @if ($owner && $owner->photo_url)

                        <img src="{{ $owner->photo_url }}" alt="{{ $owner->name }}">

                    @else

                        {{ strtoupper(substr($owner->name ?? 'MR', 0, 2)) }}

                    @endif

                </div>

                <div class="logo-info">
                    <div class="logo-title">
                        {{ $owner->name ?? 'MR Admin' }}
                    </div>

                    <div class="logo-subtitle">
                        Portfolio Management System
                    </div>
                </div>

            </div>


            {{-- HEADER --}}
            <div class="login-header">

                <h1>
                    Selamat Datang
                </h1>

                <p>
                    Silakan masuk untuk mengakses dashboard administrator.
                </p>

            </div>


            {{-- SESSION STATUS --}}
            @if (session('status'))
                <div class="login-status">
                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('status') }}
                    </span>
                </div>
            @endif


            {{-- LOGIN FORM --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf


                {{-- EMAIL --}}
                <div class="login-field">

                    <label for="email">
                        Email
                    </label>

                    <div class="login-input-wrapper">

                        <i class="bi bi-envelope"></i>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Masukkan email Anda"
                        >

                    </div>

                    @if ($errors->has('email'))
                        <div class="login-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                </div>


                {{-- PASSWORD --}}
                <div class="login-field">

                    <div class="label-row">

                        <label for="password">
                            Password
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif

                    </div>


                    <div class="login-input-wrapper">

                        <i class="bi bi-lock"></i>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan password Anda"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            aria-label="Tampilkan password"
                        >
                            <i id="passwordIcon" class="bi bi-eye"></i>
                        </button>

                    </div>

                    @if ($errors->has('password'))
                        <div class="login-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                </div>


                {{-- REMEMBER ME --}}
                <div class="remember-wrapper">

                    <label class="remember-label">

                        <input
                            type="checkbox"
                            name="remember"
                            id="remember_me"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <span>
                            Ingat saya
                        </span>

                    </label>

                </div>


                {{-- LOGIN BUTTON --}}
                <button
                    type="submit"
                    class="login-button"
                >

                    <i class="bi bi-box-arrow-in-right"></i>

                    <span>
                        MASUK
                    </span>

                </button>

            </form>


            {{-- FOOTER --}}
            <div class="login-footer">

                <div class="footer-line"></div>

                <div class="footer-content">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        Akses administrator yang aman
                    </span>

                </div>

            </div>


            {{-- TOMBOL KEMBALI KE HALAMAN PUBLIK --}}
            <a href="{{ route('home') }}" class="back-public-btn">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Halaman Publik</span>
            </a>

            {{-- TOMBOL GANTI TEMA --}}
            <button
                type="button"
                class="login-theme-toggle"
                onclick="toggleTheme()"
                title="Ganti tema terang/gelap"
            >
                <i class="bi bi-moon-stars" id="themeIcon"></i>
                <span>Ganti Tema</span>
            </button>

        </div>

    </div>


    {{-- =========================
         CSS
    ========================== --}}
    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            padding: 0;
            background: var(--bg-sidebar) !important;
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            transition: background-color .25s ease, color .25s ease;
        }


        .login-wrapper {
            position: relative;

            min-height: 100vh;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;

            background: var(--bg-sidebar);
            overflow: hidden;
        }

        /* Subtle grid pattern (senada halaman publik) */
        .login-wrapper::before {
            content: '';

            position: absolute;
            inset: 0;

            pointer-events: none;

            background-image:
                linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);

            background-size: 56px 56px;

            mask-image: radial-gradient(ellipse 80% 70% at 50% 40%, #000 30%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 80% 70% at 50% 40%, #000 30%, transparent 100%);
        }

        /* Glow halus violet & blue */
        .login-wrapper::after {
            content: '';

            position: absolute;
            inset: 0;

            pointer-events: none;

            background:
                radial-gradient(circle at 15% 15%, rgba(124,108,255,.16), transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(77,156,255,.12), transparent 40%);
        }


        .login-card {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 430px;

            background: var(--bg-card);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            border: 1px solid var(--border);

            border-radius: 20px;

            padding: 40px;

            box-shadow:
                0 30px 80px rgba(0,0,0,.35);

            transition: background-color .25s ease, border-color .25s ease;
        }


        /* =========================
           BRAND
        ========================== */

        .login-brand {
            display: flex;
            align-items: center;

            gap: 13px;

            margin-bottom: 32px;
        }


        .logo-box {
            width: 55px;
            height: 55px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: linear-gradient(135deg, #7c6cff, #4d9cff);

            color: var(--text-primary);

            font-size: 18px;
            font-weight: 700;

            letter-spacing: 0.5px;

            overflow: hidden;

            box-shadow:
                0 10px 26px rgba(124,108,255,0.35);
        }

        .logo-box img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }


        .logo-title {
            color: var(--text-primary);

            font-size: 17px;
            font-weight: 700;

            letter-spacing: -0.2px;

            line-height: 1.2;
        }


        .logo-subtitle {
            margin-top: 4px;

            color: var(--text-muted);

            font-size: 11.5px;
            font-weight: 400;
        }


        /* =========================
           HEADER
        ========================== */

        .login-header {
            margin-bottom: 28px;
        }


        .login-header h1 {
            margin: 0 0 8px;

            color: var(--text-primary);

            font-size: 26px;
            font-weight: 800;

            letter-spacing: -0.8px;

            line-height: 1.25;
        }


        .login-header p {
            margin: 0;

            color: var(--text-muted);

            font-size: 13px;

            line-height: 1.6;
        }


        /* =========================
           STATUS
        ========================== */

        .login-status {
            display: flex;
            align-items: center;

            gap: 9px;

            margin-bottom: 20px;

            padding: 12px 14px;

            background: rgba(54,201,143,0.10);

            border: 1px solid rgba(54,201,143,0.20);

            border-radius: 8px;

            color: #36c98f;

            font-size: 12px;
        }


        /* =========================
           FIELD
        ========================== */

        .login-field {
            margin-bottom: 20px;
        }


        .login-field label {
            display: block;

            margin-bottom: 8px;

            color: var(--text-secondary);

            font-size: 12px;
            font-weight: 600;
        }


        .label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 8px;
        }


        .label-row label {
            margin-bottom: 0;
        }


        .label-row a {
            color: #9b8ff5;

            font-size: 11px;

            text-decoration: none;

            transition: 0.2s;
        }


        .label-row a:hover {
            color: #b8afff;
        }


        /* =========================
           INPUT
        ========================== */

        .login-input-wrapper {
            position: relative;

            width: 100%;
        }


        .login-input-wrapper > i {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--text-muted);

            font-size: 15px;

            z-index: 2;

            pointer-events: none;
        }


        .login-input-wrapper input {
            width: 100%;

            height: 48px;

            padding: 0 45px 0 43px;

            background: rgba(12,12,16,.9);

            border: 1px solid var(--border);

            border-radius: 12px;

            outline: none;

            color: var(--text-primary);

            font-family: 'Inter', sans-serif;

            font-size: 13px;

            transition: all 0.2s ease;
        }


        .login-input-wrapper input::placeholder {
            color: var(--text-dim);

            opacity: 1;
        }


        .login-input-wrapper input:focus {
            border-color: #7c6cff;

            background: rgba(12,12,16,1);

            box-shadow:
                0 0 0 3px rgba(124,108,255,0.16);
        }


        .login-input-wrapper input:-webkit-autofill,
        .login-input-wrapper input:-webkit-autofill:hover,
        .login-input-wrapper input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--text-primary);

            -webkit-box-shadow:
                0 0 0px 1000px var(--bg-input) inset;

            transition:
                background-color 5000s ease-in-out 0s;
        }


        /* =========================
           PASSWORD TOGGLE
        ========================== */

        .password-toggle {
            position: absolute;

            right: 12px;
            top: 50%;

            transform: translateY(-50%);

            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;

            background: transparent;

            color: var(--text-muted);

            cursor: pointer;

            border-radius: 6px;

            transition: 0.2s;
        }


        .password-toggle:hover {
            color: var(--text-primary);

            background: var(--surface-2);
        }


        .password-toggle i {
            font-size: 15px;
        }


        /* =========================
           ERROR
        ========================== */

        .login-error {
            display: flex;
            align-items: center;

            gap: 6px;

            margin-top: 7px;

            color: #f05268;

            font-size: 11px;

            line-height: 1.4;
        }


        /* =========================
           REMEMBER
        ========================== */

        .remember-wrapper {
            margin-top: -2px;

            margin-bottom: 22px;
        }


        .remember-label {
            display: flex;

            align-items: center;

            gap: 9px;

            cursor: pointer;
        }


        .remember-label input {
            width: 15px;
            height: 15px;

            margin: 0;

            accent-color: #7c6cff;

            cursor: pointer;
        }


        .remember-label span {
            color: var(--text-muted);

            font-size: 12px;
        }


        /* =========================
           BUTTON
        ========================== */

        .login-button {
            width: 100%;

            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            border: none;

            border-radius: 12px;

            background: linear-gradient(135deg, #7c6cff, #6551e8);

            color: var(--text-primary);

            font-family: 'Inter', sans-serif;

            font-size: 12.5px;
            font-weight: 700;

            letter-spacing: 0.5px;

            cursor: pointer;

            transition: all 0.2s ease;
        }


        .login-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 14px 34px rgba(124,108,255,0.4);
        }


        .login-button:active {
            transform: translateY(0);
        }


        .login-button i {
            font-size: 15px;
        }


        /* =========================
           FOOTER
        ========================== */

        .login-footer {
            margin-top: 28px;

            color: var(--text-muted);

            font-size: 11px;

            text-align: center;
        }


        .footer-line {
            width: 100%;
            height: 1px;

            margin-bottom: 18px;

            background: var(--border);
        }


        .footer-content {
            display: flex;

            align-items: center;
            justify-content: center;

            gap: 7px;
        }


        .footer-content i {
            color: #36c98f;

            font-size: 13px;
        }


        .footer-content span {
            color: var(--text-muted);
        }


        /* =========================
           TOMBOL KEMBALI KE PUBLIK
        ========================= */

        .back-public-btn {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            margin-top: 14px;

            padding: 12px 16px;

            background: var(--surface-1);

            border: 1px solid var(--border);
            border-radius: 12px;

            color: var(--text-muted);

            font-size: 12px;
            font-weight: 500;

            text-decoration: none;

            transition: all 0.2s ease;
        }

        .back-public-btn:hover {
            border-color: #7c6cff;

            color: var(--text-primary);

            background: rgba(124,108,255,.1);
        }

        .back-public-btn i {
            font-size: 13px;
        }


        /* =========================
           TOMBOL GANTI TEMA
        ========================= */

        .login-theme-toggle {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            margin-top: 10px;

            padding: 12px 16px;

            background: var(--surface-1);

            border: 1px solid var(--border);
            border-radius: 12px;

            color: var(--text-muted);

            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 500;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .login-theme-toggle:hover {
            border-color: var(--accent);
            color: var(--text-primary);
            background: var(--accent-soft);
        }

        .login-theme-toggle i {
            font-size: 14px;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 576px) {

            .login-wrapper {
                padding: 20px 15px;
            }


            .login-card {
                padding: 30px 25px;
            }


            .login-brand {
                margin-bottom: 28px;
            }


            .login-header h1 {
                font-size: 21px;
            }

        }

    </style>


    {{-- =========================
         JAVASCRIPT
    ========================== --}}
    <script>

        function togglePassword() {

            const passwordInput =
                document.getElementById('password');

            const passwordIcon =
                document.getElementById('passwordIcon');


            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                passwordIcon.classList.remove('bi-eye');

                passwordIcon.classList.add('bi-eye-slash');

            } else {

                passwordInput.type = 'password';

                passwordIcon.classList.remove('bi-eye-slash');

                passwordIcon.classList.add('bi-eye');

            }

        }


        /*
         * =====================================================
         * GANTI TEMA (DARK / LIGHT)
         * =====================================================
         */

        function applyThemeIcon() {
            var theme = document.documentElement.getAttribute('data-theme') || 'dark';
            var icon = document.getElementById('themeIcon');

            if (icon) {
                icon.className = theme === 'dark'
                    ? 'bi bi-moon-stars'
                    : 'bi bi-sun';
            }
        }

        function toggleTheme() {
            var current = document.documentElement.getAttribute('data-theme') || 'dark';
            var next = current === 'dark' ? 'light' : 'dark';

            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);

            applyThemeIcon();
        }

        applyThemeIcon();

    </script>

</x-guest-layout>