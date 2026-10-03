<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'MR Admin') }}</title>

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
            --bg-hover: #29324e;
            --bg-hover-2: #323d5c;
            --bg-input: #171d32;

            --text-primary: #ffffff;
            --text-secondary: #aeb8ca;
            --text-muted: #8993ab;
            --text-dim: #78839c;

            --border: rgba(255,255,255,.07);
            --border-strong: rgba(255,255,255,.12);

            --surface-1: rgba(255,255,255,.03);
            --surface-2: rgba(255,255,255,.05);
            --surface-3: rgba(255,255,255,.08);

            --purple: #6551e8;
            --purple-light: #7865ef;
            --blue: #4d9cff;
            --green: #36c98f;
            --orange: #f3a735;
            --red: #f05268;

            --accent: #6551e8;
            --accent-soft: rgba(101,81,232,.12);
        }

        /* =====================================================
           TEMA: LIGHT
        ===================================================== */
        [data-theme="light"] {
            --bg-main: #f3f4f9;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-alt: #f7f8fc;
            --bg-hover: #eef0f7;
            --bg-hover-2: #e4e7f2;
            --bg-input: #f7f8fc;

            --text-primary: #1a1d2b;
            --text-secondary: #4a5169;
            --text-muted: #6b7288;
            --text-dim: #8a90a4;

            --border: rgba(20,25,50,.10);
            --border-strong: rgba(20,25,50,.18);

            --surface-1: rgba(20,25,50,.02);
            --surface-2: rgba(20,25,50,.04);
            --surface-3: rgba(20,25,50,.06);
        }

        /* Transisi halus saat ganti tema */
        body, .sidebar, .topbar, .content,
        .crud-card, .crud-table td, .crud-table th,
        .filter-search input, .filter-select {
            transition: background-color .25s ease, color .25s ease, border-color .25s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            color: var(--text-primary);
        }

        a {
            text-decoration: none;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;

            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);

            display: flex;
            flex-direction: column;

            z-index: 1000;
        }

        .sidebar-brand {
            height: 72px;

            display: flex;
            align-items: center;

            gap: 12px;

            padding: 0 20px;

            border-bottom: 1px solid var(--border);
        }

        .brand-avatar {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            border-radius: 50%;

            overflow: hidden;

            background: var(--purple);

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--text-primary);

            font-size: 17px;
            font-weight: 700;

            letter-spacing: .5px;
        }

        .brand-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }

        .brand-info {
            min-width: 0;
            flex: 1;
        }

        .brand-name {
            color: var(--text-primary);

            font-size: 14px;
            font-weight: 600;

            line-height: 1.3;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .brand-role {
            color: var(--text-muted);

            font-size: 11px;

            margin-top: 2px;
        }

        /* Tombol tutup sidebar (disembunyikan di desktop) */
        .sidebar-close {
            display: none;

            margin-left: auto;

            width: 34px;
            height: 34px;

            align-items: center;
            justify-content: center;

            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 8px;

            color: var(--text-muted);
            font-size: 14px;

            cursor: pointer;

            transition: .2s ease;
        }

        .sidebar-close:hover {
            background: var(--border);
            color: var(--text-primary);
        }

        /* Overlay gelap saat sidebar mobile terbuka */
        .sidebar-overlay {
            display: none;

            position: fixed;
            inset: 0;

            z-index: 999;

            background: rgba(5,8,20,.6);
            backdrop-filter: blur(2px);

            opacity: 0;
            transition: opacity .2s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        .sidebar-menu {
            padding: 20px 14px;
            overflow-y: auto;
        }

        .menu-title {
            color: var(--text-dim);
            font-size: 10px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: 1px;

            padding: 15px 15px 8px;
        }

        .nav-sidebar {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-sidebar .nav-item {
            margin-bottom: 5px;
        }

        .nav-sidebar .nav-link {
            color: var(--text-secondary);

            padding: 12px 15px;

            border-radius: 8px;

            display: flex;
            align-items: center;

            gap: 13px;

            font-size: 13px;
            font-weight: 500;

            transition: .2s ease;
        }

        .nav-sidebar .nav-link i {
            font-size: 17px;
            width: 20px;
        }

        .nav-sidebar .nav-link:hover {
            background: rgba(101,81,232,.10);
            color: var(--text-primary);
        }

        .nav-sidebar .nav-link.active {
            background: var(--purple);
            color: var(--text-primary);

            box-shadow: 0 8px 20px rgba(101,81,232,.25);
        }

        .nav-sidebar .nav-link.disabled {
            opacity: .45;

            cursor: not-allowed;
        }

        .nav-sidebar .nav-link.disabled:hover {
            background: transparent;
            color: var(--text-secondary);
        }

        .menu-badge {
            margin-left: auto;

            padding: 2px 7px;

            background: var(--border);
            color: var(--text-muted);

            border-radius: 20px;

            font-size: 9px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .3px;
        }

        /* Badge jumlah pesan belum dibaca */
        .menu-badge-count {
            min-width: 20px;

            padding: 2px 6px;

            text-align: center;

            background: var(--red);
            color: #ffffff;

            font-size: 10px;
            letter-spacing: 0;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 15px;
            border-top: 1px solid var(--border);
        }

        /* =========================
           MAIN
        ========================= */

        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            height: 72px;

            background: var(--bg-sidebar);

            border-bottom: 1px solid var(--border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 28px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .menu-toggle {
            color: var(--text-muted);
            font-size: 21px;
            cursor: pointer;
        }

        .topbar-search-form {
            position: relative;

            display: flex;
            align-items: center;
        }

        .topbar-search-icon {
            position: absolute;

            left: 13px;

            color: var(--text-dim);

            font-size: 14px;

            pointer-events: none;
        }

        .topbar-search {
            width: 260px;

            background: #242c45;
            border: 1px solid var(--surface-2);

            border-radius: 7px;

            padding: 9px 14px 9px 36px;

            color: var(--text-primary);
            outline: none;

            font-size: 13px;
        }

        .topbar-search:focus {
            border-color: rgba(101,81,232,.5);
        }

        .topbar-search::placeholder {
            color: var(--text-dim);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-icon {
            color: var(--text-muted);
            font-size: 18px;
            cursor: pointer;
        }

        .top-icon:hover {
            color: var(--text-primary);
        }

        /* Ikon topbar yang bisa diklik (chat & bell) */
        .top-icon-btn {
            position: relative;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 38px;
            height: 38px;

            border-radius: 10px;

            transition: all .2s ease;
        }

        .top-icon-btn:hover {
            background: var(--surface-2);
            color: var(--text-primary);
        }

        /* Badge angka di ikon */
        .top-badge {
            position: absolute;
            top: 2px;
            right: 1px;

            min-width: 17px;
            height: 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 0 4px;

            background: var(--red);
            color: #fff;

            border: 2px solid var(--bg-sidebar);
            border-radius: 20px;

            font-size: 9px;
            font-weight: 700;

            line-height: 1;
        }

        /* Dropdown notifikasi */
        .notif-menu {
            width: 320px;

            padding: 0;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;

            overflow: hidden;

            box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
        }

        .notif-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 14px 16px;

            border-bottom: 1px solid var(--border);

            color: var(--text-primary);
            font-size: 13px;
            font-weight: 700;
        }

        .notif-count {
            padding: 3px 9px;

            background: rgba(240, 82, 104, .12);
            color: var(--red);

            border-radius: 20px;

            font-size: 10px;
            font-weight: 700;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 11px;

            padding: 12px 16px;

            border-bottom: 1px solid var(--border);

            transition: .2s ease;
        }

        .notif-item:hover { background: var(--bg-hover); }

        .notif-unread { background: rgba(101, 81, 232, .06); }

        .notif-avatar {
            width: 36px;
            height: 36px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--purple);
            color: #fff;

            font-size: 14px;
            font-weight: 700;
        }

        .notif-body { min-width: 0; flex: 1; }

        .notif-name {
            color: var(--text-primary);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .notif-text {
            color: var(--text-muted);
            font-size: 11px;
            margin-bottom: 3px;
        }

        .notif-time {
            color: var(--text-dim);
            font-size: 10px;
        }

        .notif-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;

            padding: 30px 16px;

            color: var(--text-dim);
            font-size: 12px;
        }

        .notif-empty i { font-size: 24px; }

        .notif-footer a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 13px;

            color: var(--purple-light);
            font-size: 12px;
            font-weight: 600;

            transition: .2s ease;
        }

        .notif-footer a:hover { background: var(--bg-hover); }

        /* Tombol ganti tema */
        .theme-toggle {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 10px;

            color: var(--text-muted);
            font-size: 16px;

            cursor: pointer;

            transition: all .2s ease;
        }

        .theme-toggle:hover {
            color: var(--purple-light);
            border-color: var(--purple);
            background: rgba(101, 81, 232, .12);
            transform: translateY(-1px);
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;

            color: var(--text-primary);
        }

        .user-avatar {
            width: 36px;
            height: 36px;

            border-radius: 50%;

            background: var(--purple);

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            font-size: 13px;
            font-weight: 600;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }

        .user-name {
            font-size: 13px;
            font-weight: 500;
        }

        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 28px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-title {
            font-size: 23px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 13px;
        }

        /* =========================
           DASHBOARD CARD
        ========================= */

        .dashboard-card {
            background: var(--bg-card);

            border: 1px solid var(--border);

            border-radius: 10px;

            padding: 22px;

            height: 100%;

            transition: .2s ease;
        }

        .dashboard-card:hover {
            background: var(--bg-hover);
        }

        .card-title {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;

            margin-bottom: 8px;
        }

        .card-value {
            color: var(--text-primary);

            font-size: 28px;
            font-weight: 700;
        }

        .card-icon {
            width: 48px;
            height: 48px;

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 21px;
        }

        .icon-purple {
            color: var(--text-primary);
            background: rgba(101,81,232,.25);
        }

        .icon-blue {
            color: #55a8ff;
            background: rgba(77,156,255,.15);
        }

        .icon-green {
            color: #36c98f;
            background: rgba(54,201,143,.15);
        }

        .icon-orange {
            color: #f3a735;
            background: rgba(243,167,53,.15);
        }

        .icon-red {
            color: #f05268;
            background: rgba(240,82,104,.15);
        }

        .stat-description {
            color: var(--text-dim);
            font-size: 11px;
            margin-top: 3px;
        }

        /* =========================
           BIG CARD
        ========================= */

        .chart-card {
            min-height: 330px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding-bottom: 18px;
            margin-bottom: 20px;

            border-bottom: 1px solid var(--border);
        }

        .chart-title {
            font-size: 15px;
            font-weight: 600;
        }

        .chart-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--purple-light);
        }

        /* =========================
           TABLE
        ========================= */

        .table-dark-custom {
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .table-dark-custom thead th {
            color: var(--text-dim);

            font-size: 11px;
            font-weight: 500;

            border-bottom: 1px solid var(--border);

            padding: 12px;
        }

        .table-dark-custom tbody td {
            border-color: var(--border);

            padding: 14px 12px;

            font-size: 12px;
        }

        .badge-status {
            padding: 5px 9px;

            border-radius: 5px;

            font-size: 10px;
        }

        .badge-published {
            background: rgba(54,201,143,.15);
            color: #36c98f;
        }

        .badge-pending {
            background: rgba(243,167,53,.15);
            color: #f3a735;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 992px) {

            .sidebar {
                width: 220px;
            }

            .main-wrapper {
                margin-left: 220px;
            }

            .topbar-search {
                width: 200px;
            }
        }

        @media (max-width: 768px) {

            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;

                box-shadow: 0 0 40px rgba(0,0,0,.4);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-close {
                display: inline-flex;
            }

            .main-wrapper {
                margin-left: 0;
            }

            /* Topbar jadi 2 baris: baris 1 (hamburger + ikon), baris 2 (search full-width) */
            .topbar {
                height: auto;

                flex-wrap: wrap;
                align-items: center;

                gap: 12px;

                padding: 14px 18px;
            }

            /* Hilangkan kotak pembungkus, biar isinya jadi anak langsung topbar */
            .topbar-left {
                display: contents;
            }

            .menu-toggle {
                order: 1;
            }

            .topbar-right {
                order: 2;
                margin-left: auto;
            }

            /* Search turun ke baris sendiri, selebar penuh */
            .topbar-search-form {
                order: 3;
                flex: 1 1 100%;
            }

            .topbar-search {
                display: block;
                width: 100%;
            }

            .content {
                padding: 18px;
            }

            .user-name {
                display: none;
            }
        }

        /* =========================
           PAGINATION (Bootstrap override)
        ========================= */

        .pagination {
            margin: 0;

            --bs-pagination-bg: #171d32;
            --bs-pagination-border-color: rgba(255, 255, 255, .08);
            --bs-pagination-color: #aeb8ca;

            --bs-pagination-hover-bg: #29324e;
            --bs-pagination-hover-border-color: rgba(255, 255, 255, .12);
            --bs-pagination-hover-color: #ffffff;

            --bs-pagination-focus-bg: #29324e;
            --bs-pagination-focus-color: #ffffff;
            --bs-pagination-focus-box-shadow: 0 0 0 .15rem rgba(101, 81, 232, .12);

            --bs-pagination-active-bg: #6551e8;
            --bs-pagination-active-border-color: #6551e8;
            --bs-pagination-active-color: #ffffff;

            --bs-pagination-disabled-bg: #171d32;
            --bs-pagination-disabled-border-color: rgba(255, 255, 255, .05);
            --bs-pagination-disabled-color: #5a647c;
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="sidebar">

    <!-- BRAND -->
    <div class="sidebar-brand">

        <div class="brand-avatar">

            @if (Auth::user()->photo_url)

                <img
                    src="{{ Auth::user()->photo_url }}"
                    alt="{{ Auth::user()->name }}"
                >

            @else

                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

            @endif

        </div>

        <div class="brand-info">

            <div class="brand-name">
                {{ Auth::user()->name }}
            </div>

            <div class="brand-role">
                Administrator
            </div>

        </div>

        <!-- Tombol tutup sidebar (khusus mobile) -->
        <button
            type="button"
            class="sidebar-close"
            onclick="closeSidebar()"
            aria-label="Tutup menu"
        >
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- MENU -->
    <div class="sidebar-menu">

        <div class="menu-title">
            Main Menu
        </div>

        <ul class="nav-sidebar">

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <i class="bi bi-grid-1x2-fill"></i>

                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Karya -->
            <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}"
               href="{{ route('projects.index') }}">
                 <i class="bi bi-briefcase"></i> Karya
            </a>
            </li>

            <!-- Kategori -->
            <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
               href="{{ route('categories.index') }}">
                <i class="bi bi-tags"></i> Kategori
            </a>
            </li>

        </ul>


        <div class="menu-title">
            Portfolio
        </div>

        <ul class="nav-sidebar">

            <!-- Skills -->
            <li class="nav-item">
                <a href="{{ route('skills.index') }}"
                   class="nav-link {{ request()->routeIs('skills.*') ? 'active' : '' }}">

                    <i class="bi bi-stars"></i>

                    <span>Skills</span>
                </a>
            </li>

            <!-- Pengalaman -->
            <li class="nav-item">
                <a href="{{ route('experiences.index') }}"
                   class="nav-link {{ request()->routeIs('experiences.*') ? 'active' : '' }}">

                    <i class="bi bi-briefcase"></i>

                    <span>Pengalaman</span>
                </a>
            </li>

            <!-- Layanan -->
            <li class="nav-item">
                <a href="{{ route('services.index') }}"
                   class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">

                    <i class="bi bi-grid"></i>

                    <span>Layanan</span>
                </a>
            </li>

            <!-- Testimoni -->
            <li class="nav-item">
                <a href="{{ route('testimonials.index') }}"
                   class="nav-link {{ request()->routeIs('testimonials.*') ? 'active' : '' }}">

                    <i class="bi bi-chat-quote"></i>

                    <span>Testimoni</span>
                </a>
            </li>

        </ul>


        <div class="menu-title">
            Communication
        </div>

        <ul class="nav-sidebar">

            <!-- Pesan -->
            <li class="nav-item">
                <a href="{{ route('messages.index') }}"
                   class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">

                    <i class="bi bi-envelope"></i>

                    <span>Pesan Masuk</span>

                    @if (($unreadMessages ?? 0) > 0)
                        <span class="menu-badge menu-badge-count">
                            {{ $unreadMessages }}
                        </span>
                    @endif
                </a>
            </li>

        </ul>

    </div>


    <!-- LOGOUT -->
    <div class="sidebar-bottom">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button type="submit"
                    class="nav-link w-100 border-0 bg-transparent">

                <i class="bi bi-box-arrow-left"></i>

                <span>Keluar</span>

            </button>

        </form>

    </div>

</div>


<!-- OVERLAY (khusus mobile: menutup sidebar saat diklik) -->
<div
    class="sidebar-overlay"
    id="sidebarOverlay"
    onclick="closeSidebar()"
></div>


<!-- MAIN -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <div class="topbar">

        <div class="topbar-left">

            <div class="menu-toggle" onclick="openSidebar()">
                <i class="bi bi-list"></i>
            </div>

            <form action="{{ route('projects.index') }}" method="GET" class="topbar-search-form">
                <i class="bi bi-search topbar-search-icon"></i>

                <input
                    type="text"
                    name="search"
                    class="topbar-search"
                    placeholder="Cari karya..."
                    value="{{ request('search') }}"
                    autocomplete="off"
                >
            </form>

        </div>


        <div class="topbar-right">

            {{-- TOMBOL GANTI TEMA --}}
            <button
                type="button"
                class="theme-toggle"
                id="themeToggle"
                onclick="toggleTheme()"
                title="Ganti tema terang/gelap"
                aria-label="Ganti tema"
            >
                <i class="bi bi-moon-stars" id="themeIcon"></i>
            </button>

            {{-- Pesan (link ke inbox) --}}
            <a href="{{ route('messages.index') }}"
               class="top-icon top-icon-btn"
               title="Pesan Masuk">

                <i class="bi bi-chat-square-text"></i>

                @if (($unreadMessages ?? 0) > 0)
                    <span class="top-badge">{{ $unreadMessages }}</span>
                @endif
            </a>


            {{-- Notifikasi (dropdown pesan terbaru) --}}
            <div class="dropdown">

                <a href="#"
                   class="top-icon top-icon-btn"
                   data-bs-toggle="dropdown"
                   title="Notifikasi">

                    <i class="bi bi-bell"></i>

                    @if (($unreadMessages ?? 0) > 0)
                        <span class="top-badge">{{ $unreadMessages }}</span>
                    @endif
                </a>


                <ul class="dropdown-menu dropdown-menu-end notif-menu">

                    <li class="notif-header">
                        <span>Notifikasi</span>

                        @if (($unreadMessages ?? 0) > 0)
                            <span class="notif-count">{{ $unreadMessages }} baru</span>
                        @endif
                    </li>

                    @forelse (($recentMessages ?? collect()) as $msg)

                        <li>
                            <a class="notif-item {{ $msg->is_read ? '' : 'notif-unread' }}"
                               href="{{ route('messages.show', $msg->id) }}">

                                <div class="notif-avatar">
                                    {{ strtoupper(substr($msg->name, 0, 1)) }}
                                </div>

                                <div class="notif-body">
                                    <div class="notif-name">{{ $msg->name }}</div>
                                    <div class="notif-text">
                                        {{ \Illuminate\Support\Str::limit($msg->subject ?: $msg->message, 42) }}
                                    </div>
                                    <div class="notif-time">
                                        {{ $msg->created_at->diffForHumans() }}
                                    </div>
                                </div>

                            </a>
                        </li>

                    @empty

                        <li class="notif-empty">
                            <i class="bi bi-bell-slash"></i>
                            <span>Belum ada notifikasi</span>
                        </li>

                    @endforelse

                    <li class="notif-footer">
                        <a href="{{ route('messages.index') }}">
                            Lihat Semua Pesan
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </li>

                </ul>

            </div>


            <div class="dropdown">

                <a href="#"
                   class="dropdown-toggle user-dropdown"
                   data-bs-toggle="dropdown">

                    <div class="user-avatar">

                        @if (Auth::user()->photo_url)

                            <img
                                src="{{ Auth::user()->photo_url }}"
                                alt="{{ Auth::user()->name }}"
                            >

                        @else

                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                        @endif

                    </div>

                    <span class="user-name">
                        {{ Auth::user()->name }}
                    </span>

                </a>


                <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                    <li>
                        <a class="dropdown-item"
                           href="{{ route('profile.edit') }}">

                            <i class="bi bi-person me-2"></i>

                            Profil

                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button class="dropdown-item">

                                <i class="bi bi-box-arrow-right me-2"></i>

                                Keluar

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </div>


    <!-- CONTENT -->
    <main class="content">

        {{ $slot }}

    </main>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /*
     * =====================================================
     * SIDEBAR MOBILE
     * =====================================================
     * Di layar <= 768px, sidebar tersembunyi (translateX(-100%)).
     * Fungsi di bawah membuka/menutupnya.
     */

    function openSidebar() {
        document.querySelector('.sidebar').classList.add('show');
        document.getElementById('sidebarOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        document.querySelector('.sidebar').classList.remove('show');
        document.getElementById('sidebarOverlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    // Tutup sidebar pakai tombol ESC
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeSidebar();
        }
    });

    // Auto-tutup sidebar saat menu diklik (biar langsung lihat halaman baru)
    document.querySelectorAll('.sidebar .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                closeSidebar();
            }
        });
    });


    /*
     * =====================================================
     * GANTI TEMA (DARK / LIGHT)
     * =====================================================
     */

    function applyThemeIcon() {
        var theme = document.documentElement.getAttribute('data-theme') || 'dark';
        var icon = document.getElementById('themeIcon');

        if (icon) {
            // Dark aktif -> tampilkan ikon bulan (untuk pindah ke light)
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

    // Set ikon saat halaman dimuat
    applyThemeIcon();
</script>

@stack('scripts')

</body>
</html>