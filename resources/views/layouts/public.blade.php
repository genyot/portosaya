<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', ($owner->name ?? 'Portfolio') . ' — Portfolio')</title>
    <meta name="description" content="@yield('meta_description', 'Portfolio pribadi — menampilkan karya, layanan, keahlian, dan pengalaman.')">

    {{-- Terapkan tema SEBELUM render, supaya tidak berkedip (anti-flicker) --}}
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <style>
        /* =====================================================
           TEMA: DARK (default)
        ===================================================== */
        :root {
            --bg: #08080a;
            --bg-soft: #0e0e12;
            --bg-card: #121218;
            --bg-card-2: #17171f;
            --bg-alt: #0e0e12;
            --bg-input: #0c0c10;

            --border: rgba(255, 255, 255, .08);
            --border-strong: rgba(255, 255, 255, .14);

            --surface-1: rgba(255, 255, 255, .03);
            --surface-2: rgba(255, 255, 255, .05);

            --text: #f4f4f7;
            --text-primary: #f4f4f7;
            --text-secondary: #b9b9c8;
            --text-muted: #8e8ea0;
            --text-dim: #6f6f80;

            /* Aksen violet/blue yang subtle (bukan merah) */
            --accent: #7c6cff;
            --accent-2: #4d9cff;
            --accent-soft: rgba(124, 108, 255, .12);

            --maxw: 1200px;
        }

        /* =====================================================
           TEMA: LIGHT
        ===================================================== */
        [data-theme="light"] {
            --bg: #f4f5fa;
            --bg-soft: #ffffff;
            --bg-card: #ffffff;
            --bg-card-2: #f7f8fc;
            --bg-alt: #eef0f8;
            --bg-input: #f7f8fc;

            --border: rgba(20, 25, 50, .10);
            --border-strong: rgba(20, 25, 50, .18);

            --surface-1: rgba(20, 25, 50, .02);
            --surface-2: rgba(20, 25, 50, .04);

            --text: #14161f;
            --text-primary: #14161f;
            --text-secondary: #3f4560;
            --text-muted: #626879;
            --text-dim: #838899;
        }

        /* Transisi halus saat ganti tema */
        body, .pub-nav, .work-card, .service-card, .contact-card {
            transition: background-color .25s ease, color .25s ease, border-color .25s ease;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }

        .container-pub {
            width: 100%;
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* =========================
           SUBTLE GRID PATTERN
        ========================= */

        .grid-bg {
            position: fixed;
            inset: 0;

            z-index: -2;

            pointer-events: none;

            background-image:
                linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);

            background-size: 56px 56px;

            /* Memudar ke bawah supaya tidak ramai */
            mask-image: radial-gradient(ellipse 100% 60% at 50% 0%, #000 40%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 100% 60% at 50% 0%, #000 40%, transparent 100%);
        }

        /* =========================
           CUSTOM SCROLLBAR
        ========================= */

        ::-webkit-scrollbar { width: 10px; }

        ::-webkit-scrollbar-track { background: var(--bg); }

        ::-webkit-scrollbar-thumb {
            background: #232330;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        /* =========================
           SCROLL PROGRESS BAR
        ========================= */

        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;

            height: 3px;
            width: 0%;

            background: linear-gradient(90deg, var(--accent), var(--accent-2));

            z-index: 2000;

            transition: width .1s linear;
        }

        /* =========================
           BACKGROUND GLOW (halus)
        ========================= */

        .bg-glow {
            position: fixed;
            inset: 0;

            z-index: -1;

            pointer-events: none;

            overflow: hidden;
        }

        .bg-glow span {
            position: absolute;

            border-radius: 50%;

            filter: blur(140px);
            opacity: .14;
        }

        .bg-glow span:nth-child(1) {
            width: 520px;
            height: 520px;

            top: -180px;
            left: -140px;

            background: var(--accent);

            animation: glowFloat 16s ease-in-out infinite;
        }

        .bg-glow span:nth-child(2) {
            width: 460px;
            height: 460px;

            bottom: -200px;
            right: -140px;

            background: var(--accent-2);

            animation: glowFloat 20s ease-in-out infinite reverse;
        }

        @keyframes glowFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%      { transform: translate(40px, -30px) scale(1.15); }
        }

        /* =========================
           SCROLL REVEAL
        ========================= */

        .reveal {
            opacity: 0;

            transform: translateY(34px);

            transition:
                opacity .8s cubic-bezier(.2, .7, .2, 1),
                transform .8s cubic-bezier(.2, .7, .2, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 { transition-delay: .08s; }
        .reveal-delay-2 { transition-delay: .16s; }
        .reveal-delay-3 { transition-delay: .24s; }
        .reveal-delay-4 { transition-delay: .32s; }

        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
            .bg-glow span { animation: none; }
            html { scroll-behavior: auto; }
        }

        /* =========================
           NAVBAR — PILL GLASSMORPHISM
        ========================= */

        .nav-wrap {
            position: fixed;
            top: 18px;
            left: 0;
            right: 0;

            z-index: 1000;

            display: flex;
            justify-content: center;

            padding: 0 20px;

            pointer-events: none;
        }

        .pub-nav {
            pointer-events: auto;

            width: 100%;
            max-width: var(--maxw);

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            padding: 10px 12px 10px 22px;

            border-radius: 100px;

            background: rgba(18,18,24,.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            border: 1px solid var(--border);

            transition:
                background .3s ease,
                border-color .3s ease,
                box-shadow .3s ease,
                padding .3s ease;
        }

        /* Saat scroll: pill lebih solid */
        .pub-nav.scrolled {
            background: rgba(16,16,22,.85);

            border-color: var(--border-strong);

            box-shadow: 0 12px 40px rgba(0,0,0,.45);
        }

        .pub-brand {
            display: flex;
            align-items: center;
            gap: 10px;

            font-size: 15px;
            font-weight: 700;
            letter-spacing: -.2px;

            white-space: nowrap;
        }

        .pub-brand .brand-avatar {
            width: 34px;
            height: 34px;

            flex-shrink: 0;

            border-radius: 50%;

            overflow: hidden;

            background: linear-gradient(135deg, var(--accent), var(--accent-2));

            display: flex;
            align-items: center;
            justify-content: center;

            color: #fff;

            font-size: 13px;
            font-weight: 700;

            border: 2px solid rgba(124, 108, 255, .5);
        }

        .pub-brand .brand-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .pub-menu {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pub-menu a {
            color: var(--text-muted);

            padding: 9px 16px;

            border-radius: 100px;

            font-size: 13px;
            font-weight: 500;

            transition: .2s ease;
        }

        .pub-menu a:hover {
            color: var(--text-primary);
            background: var(--border);
        }

        .pub-nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pub-nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 20px;

            background: var(--accent);
            color: var(--text-primary);

            border-radius: 100px;

            font-size: 12px;
            font-weight: 600;

            white-space: nowrap;

            transition: .2s ease;
        }

        .pub-nav-cta:hover {
            background: #6b5aff;
            color: var(--text-primary);
            transform: translateY(-1px);
        }

        /* Tombol Login / Dashboard */
        .pub-nav-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 18px;

            background: var(--surface-2);
            color: var(--text-muted);

            border: 1px solid var(--border);
            border-radius: 100px;

            font-size: 12px;
            font-weight: 600;

            white-space: nowrap;

            transition: .2s ease;
        }

        .pub-nav-login:hover {
            color: var(--text-primary);
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        .pub-nav-login i { font-size: 14px; }

        /* Tombol ganti tema */
        .pub-theme-toggle {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 50%;

            color: var(--text-muted);
            font-size: 16px;

            cursor: pointer;

            transition: .2s ease;
        }

        .pub-theme-toggle:hover {
            color: var(--accent);
            border-color: var(--accent);
            background: var(--accent-soft);
            transform: translateY(-1px);
        }

        .pub-nav-toggle {
            display: none;

            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 50%;

            color: var(--text-primary);
            font-size: 18px;

            width: 42px;
            height: 42px;

            cursor: pointer;
        }

        /* =========================
           SECTION
        ========================= */

        .pub-section { padding: 110px 0; }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            color: var(--accent);

            font-size: 12px;
            font-weight: 600;

            letter-spacing: 2.5px;
            text-transform: uppercase;

            margin-bottom: 16px;
        }

        .section-eyebrow::before {
            content: '';

            width: 26px;
            height: 1px;

            background: var(--accent);
        }

        .section-title {
            font-size: 46px;
            font-weight: 800;

            letter-spacing: -2px;
            line-height: 1.05;

            margin: 0 0 18px;
        }

        .section-title .muted { color: var(--text-muted); }

        .section-text {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.85;
            max-width: 620px;
        }

        /* =========================
           BUTTONS
        ========================= */

        .btn-accent {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            padding: 14px 28px;

            background: var(--accent);
            color: var(--text-primary);

            border: none;
            border-radius: 100px;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;

            transition: .2s ease;
        }

        .btn-accent:hover {
            background: #6b5aff;
            color: var(--text-primary);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(124,108,255,.3);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            padding: 14px 28px;

            background: var(--surface-1);
            color: var(--text-primary);

            border: 1px solid var(--border-strong);
            border-radius: 100px;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;

            transition: .2s ease;
        }

        .btn-ghost:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-soft);
        }

        /* =========================
           FOOTER
        ========================= */

        .pub-footer {
            border-top: 1px solid var(--border);

            padding: 40px 0;

            background: var(--bg-soft);
        }

        .pub-footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            flex-wrap: wrap;
        }

        .pub-footer p {
            margin: 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .pub-footer-right {
            display: flex;
            align-items: center;
            gap: 18px;

            flex-wrap: wrap;
        }

        .footer-tag {
            color: var(--text-muted);
            font-size: 12px;
        }

        .footer-admin-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;

            transition: .2s ease;
        }

        .footer-admin-link:hover { color: var(--accent); }

        .footer-admin-link i { font-size: 13px; }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 992px) {
            .section-title { font-size: 38px; letter-spacing: -1.4px; }
            .pub-section { padding: 85px 0; }
        }

        @media (max-width: 900px) {
            .pub-menu {
                display: none;
            }

            .pub-menu.open {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 4px;

                position: absolute;
                top: 74px;
                left: 20px;
                right: 20px;

                padding: 14px;

                background: rgba(14,14,18,.97);
                backdrop-filter: blur(16px);

                border: 1px solid var(--border);
                border-radius: 22px;
            }

            .pub-menu.open a { text-align: left; padding: 12px 16px; }

            .pub-nav-toggle { display: inline-flex; align-items: center; justify-content: center; }

            .pub-nav-cta { display: none; }
        }

        @media (max-width: 576px) {
            .pub-nav { padding: 8px 8px 8px 16px; }
            .section-title { font-size: 30px; letter-spacing: -1px; }
            .pub-section { padding: 65px 0; }
            .nav-wrap { top: 12px; padding: 0 14px; }

            /* Di HP kecil: tombol login jadi ikon saja */
            .pub-nav-login span { display: none; }
            .pub-nav-login { padding: 10px 12px; }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- SUBTLE GRID -->
    <div class="grid-bg"></div>

    <!-- BACKGROUND GLOW -->
    <div class="bg-glow">
        <span></span>
        <span></span>
    </div>

    <!-- SCROLL PROGRESS -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- NAVBAR (PILL) -->
    <div class="nav-wrap">
        <nav class="pub-nav" id="pubNav">

            <a href="{{ route('home') }}" class="pub-brand">
                <span class="brand-avatar">
                    @if ($owner && $owner->photo_url)
                        <img src="{{ $owner->photo_url }}" alt="{{ $owner->name }}">
                    @else
                        {{ strtoupper(substr($owner->name ?? 'P', 0, 1)) }}
                    @endif
                </span>
                {{ $owner->name ?? 'Portfolio' }}
            </a>

            <div class="pub-menu" id="pubMenu">
                <a href="#home">Home</a>
                <a href="#services">Services</a>
                <a href="#portfolio">Work</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>

            <div class="pub-nav-right">

                {{-- TOMBOL GANTI TEMA --}}
                <button
                    type="button"
                    class="pub-theme-toggle"
                    id="themeToggle"
                    onclick="toggleTheme()"
                    title="Ganti tema terang/gelap"
                    aria-label="Ganti tema"
                >
                    <i class="bi bi-moon-stars" id="themeIcon"></i>
                </button>

                {{-- Kalau sudah login: ke Dashboard. Kalau belum: ke Login --}}
                @auth
                    <a href="{{ route('dashboard') }}" class="pub-nav-login" title="Dashboard">
                        <i class="bi bi-grid-1x2"></i>
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="pub-nav-login" title="Login Admin">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                @endauth

                <a href="#contact" class="pub-nav-cta">
                    Let's Talk
                    <i class="bi bi-arrow-right"></i>
                </a>

                <button class="pub-nav-toggle" onclick="togglePubMenu()" aria-label="Menu">
                    <i class="bi bi-list"></i>
                </button>
            </div>

        </nav>
    </div>

    @yield('content')

    <!-- FOOTER -->
    <footer class="pub-footer">
        <div class="container-pub pub-footer-inner">
            <p>
                © {{ date('Y') }} {{ $owner->name ?? 'Portfolio' }}. All rights reserved.
            </p>

            <div class="pub-footer-right">
                <span class="footer-tag">
                    Developer × Graphic Designer
                </span>

                @auth
                    <a href="{{ route('dashboard') }}" class="footer-admin-link">
                        <i class="bi bi-grid-1x2"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="footer-admin-link">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login Admin
                    </a>
                @endauth
            </div>
        </div>
    </footer>

    <script>
        function togglePubMenu() {
            document.getElementById('pubMenu').classList.toggle('open');
        }

        document.querySelectorAll('#pubMenu a').forEach(function (link) {
            link.addEventListener('click', function () {
                document.getElementById('pubMenu').classList.remove('open');
            });
        });


        /* =====================================================
           SCROLL PROGRESS + NAVBAR STATE
        ===================================================== */

        const scrollProgress = document.getElementById('scrollProgress');
        const pubNav = document.getElementById('pubNav');

        function onScroll() {
            const scrollTop = window.scrollY;

            const docHeight =
                document.documentElement.scrollHeight - window.innerHeight;

            const percent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;

            if (scrollProgress) {
                scrollProgress.style.width = percent + '%';
            }

            if (pubNav) {
                pubNav.classList.toggle('scrolled', scrollTop > 20);
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();


        /* =====================================================
           SCROLL REVEAL
        ===================================================== */

        const revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -60px 0px',
        });

        document.querySelectorAll('.reveal').forEach(function (el) {
            revealObserver.observe(el);
        });


        /* =====================================================
           COUNTER ANGKA
        ===================================================== */

        function animateCounter(el) {
            const target = parseInt(el.dataset.count, 10) || 0;

            const duration = 1500;
            const start = performance.now();

            function tick(now) {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);

                el.textContent = Math.round(eased * target);

                if (progress < 1) {
                    requestAnimationFrame(tick);
                }
            }

            requestAnimationFrame(tick);
        }

        const counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('[data-count]').forEach(function (el) {
            counterObserver.observe(el);
        });


        /* =====================================================
           SKILL BAR (bar horizontal & chart vertikal)
        ===================================================== */

        const skillObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                const el = entry.target;

                if (!el.isIntersecting) return;

                // Bar horizontal -> pakai data-width
                if (el.dataset.width !== undefined) {
                    el.style.width = el.dataset.width + '%';
                }

                // Bar vertikal (chart) -> pakai data-height
                if (el.dataset.height !== undefined) {
                    el.style.height = el.dataset.height + '%';
                }

                skillObserver.unobserve(el);
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('.chart-col-bar').forEach(function (el) {
            skillObserver.observe(el);
        });


        /* =====================================================
           ACTIVE MENU SAAT SCROLL
        ===================================================== */

        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('#pubMenu a');

        const activeObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');

                    navLinks.forEach(function (link) {
                        link.classList.toggle(
                            'active',
                            link.getAttribute('href') === '#' + id
                        );
                    });
                }
            });
        }, { rootMargin: '-45% 0px -50% 0px' });

        sections.forEach(function (section) {
            activeObserver.observe(section);
        });


        /* =====================================================
           GANTI TEMA (DARK / LIGHT)
        ===================================================== */

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

    @stack('scripts')
</body>
</html>
