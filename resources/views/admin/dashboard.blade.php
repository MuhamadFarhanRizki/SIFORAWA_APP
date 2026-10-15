
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin | SIFORAWA</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <style>
        :root {
            --primary: #164b99;
            --primary-dark: #104891;
            --primary-light: #e8f4fb;
            --sidebar-bg: #c5e0f1;
            --page-bg: #eff7ff;
            --white: #ffffff;
            --text: #183c68;
            --muted: #71839b;
            --border: #dce7f2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--page-bg);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
            cursor: pointer;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1000;
            width: 310px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--sidebar-bg);
            box-shadow: 2px 0 12px rgba(24, 60, 104, .06);
            overflow-y: auto;
            transition: transform .3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 18px;
            background: #f7fbff;
            min-height: 130px;
        }

        .brand-image {
            width: 94px;
            height: 94px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-title {
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -.7px;
            line-height: 1.25;
            color: #124995;
        }

        .brand-subtitle {
            font-size: 10px;
            line-height: 1.6;
            font-weight: 500;
            color: #183c68;
        }

        .brand-location {
            font-size: 10px;
            line-height: 1.5;
            color: #183c68;
        }

        .menu-label {
            padding: 23px 24px 12px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.1px;
            color: #55769a;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
            padding: 0 12px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 17px;
            min-height: 57px;
            padding: 12px 15px;
            color: #245184;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            transition: background .2s, color .2s;
        }

        .menu-item i {
            width: 30px;
            flex-shrink: 0;
            text-align: center;
            font-size: 24px;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, .45);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, .58);
            color: #104891;
            font-weight: 700;
        }

        .menu-item.active i {
            color: #1253a5;
        }

        .sidebar-illustration-wrapper {
            position: relative;
            margin-top: auto;
            width: 100%;
            min-height: 175px;
            overflow: hidden;
        }

        .sidebar-illustration {
            display: block;
            width: 100%;
            height: 205px;
            object-fit: cover;
            object-position: center;
        }

        .sidebar-bottom {
            padding: 14px 18px 20px;
            background: var(--sidebar-bg);
        }

        .logout-button {
            width: 100%;
            min-height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
            border-radius: 9px;
            background: #dc3545;
            color: white;
            font-size: 14px;
            font-weight: 600;
            transition: background .2s;
        }

        .logout-button:hover {
            background: #bb2534;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main-content {
            margin-left: 310px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */

        .topbar {
            min-height: 70px;
            padding: 15px 38px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: rgba(255, 255, 255, .58);
            border-bottom: 1px solid #e5eef8;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        /* Hamburger disembunyikan pada desktop */
        .sidebar-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            color: #111;
            font-size: 21px;
        }

        .sidebar-toggle:hover {
            background: #f0f7fc;
        }

        .profile-summary {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-avatar {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #bfe6f5;
            color: #2584b6;
            font-size: 25px;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 600;
            color: #214a78;
        }

        .profile-role {
            margin-top: 2px;
            font-size: 10px;
            color: #71839b;
        }

        /* =========================
           WELCOME BANNER ADMIN
        ========================= */

        .welcome-banner {
            position: relative;
            margin: 0 38px 28px;
            overflow: hidden;
            background: #dceefa;
            border: 1px solid #d5e8f3;
            border-radius: 12px;
        }

        .welcome-main {
            position: relative;
            isolation: isolate;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 170px;
            overflow: hidden;
            background: linear-gradient(
                110deg,
                #d6d9df 0%,
                #dce8f0 38%,
                #dceefa 70%,
                #c9e6f8 100%
            );
        }

        /* Garis lengkung putih dekoratif */
        .welcome-main::before {
            content: "";
            position: absolute;
            z-index: 0;
            pointer-events: none;
            width: 72%;
            height: 230%;
            left: 19%;
            top: -66%;
            border: 3px solid rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            transform: rotate(-13deg);
        }

        .welcome-text {
            position: relative;
            z-index: 1;
            flex: 1 1 65%;
            min-width: 0;
            padding: 25px 28px;
        }

        .welcome-title {
            margin-bottom: 10px;
            color: #183e63;
            font-size: 32px;
            font-weight: 800;
            line-height: 1.25;
        }

        .welcome-description {
            color: #263f55;
            font-size: 14px;
            line-height: 1.6;
        }

        .welcome-description .line {
            display: block;
        }

        .welcome-image {
            position: relative;
            z-index: 1;
            display: block;
            flex: 0 0 35%;
            width: 35%;
            max-width: 35%;
            min-width: 0;
            height: 170px;
            margin: 0;
            padding: 0;
            object-fit: contain;
            object-position: right bottom;
            align-self: stretch;
        }

        /* =========================
           STATISTIK
        ========================= */

        .stats-wrapper {
            padding: 0 38px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 26px;
        }

        .stat-card {
            min-width: 0;
            padding: 15px 13px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            box-shadow: 0 4px 18px rgba(39, 87, 116, .04);
        }

        .stat-top {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 10px;
        }

        .stat-icon {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 14px;
        }

        .icon-blue {
            color: #2471bd;
            background: #e6f1ff;
            box-shadow: 0 0 0 4px #f0f6ff;
        }

        .icon-green {
            color: #208866;
            background: #dcf6eb;
            box-shadow: 0 0 0 4px #effaf5;
        }

        .icon-orange {
            color: #df7b48;
            background: #ffeadf;
            box-shadow: 0 0 0 4px #fff5ef;
        }

        .icon-purple {
            color: #8055c7;
            background: #f0eaff;
            box-shadow: 0 0 0 4px #f7f3ff;
        }

        .icon-teal {
            color: #0e7490;
            background: #cffafe;
            box-shadow: 0 0 0 4px #effdff;
        }

        .stat-label {
            color: #607d94;
            font-size: 10px;
            line-height: 1.5;
        }

        .stat-value {
            padding-left: 44px;
            color: #263f55;
            font-size: 25px;
            font-weight: 800;
            line-height: 1.2;
        }

        .stat-note {
            padding-left: 44px;
            margin-top: 5px;
            color: var(--muted);
            font-size: 9px;
        }

        /* =========================
           INFORMASI PENGADUAN
        ========================= */

        .history-section {
            padding: 0 38px;
            margin-bottom: 25px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 13px;
            padding: 0 10px;
        }

        .section-title {
            color: #173f63;
            font-size: 17px;
            font-weight: 600;
        }

        .section-description {
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            padding: 13px 15px;
            background: white;
            border: 1px solid #edf1f7;
            border-radius: 7px;
            transition: box-shadow .2s;
        }

        .history-item:hover {
            box-shadow: 0 4px 12px rgba(39, 87, 116, .07);
        }

        .history-main {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .history-icon {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #666;
            border-radius: 50%;
            color: #222;
            font-size: 23px;
        }

        .history-info {
            min-width: 0;
        }

        .history-title {
            margin-bottom: 3px;
            overflow-wrap: anywhere;
            color: #194f91;
            font-size: 11px;
            font-weight: 700;
        }

        .history-description {
            color: #4d5c6b;
            font-size: 10px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .history-meta {
            margin-top: 2px;
            color: #5f6872;
            font-size: 10px;
        }

        .history-side {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 5px;
            flex-shrink: 0;
            text-align: right;
        }

        .history-date {
            color: #596573;
            font-size: 10px;
            white-space: nowrap;
        }

        /* STATUS */

        .status-text {
            font-size: 12px;
            font-weight: 700;
        }

        .status-diajukan {
            color: #b35eaf;
        }

        .status-diverifikasi {
            color: #5898c5;
        }

        .status-diproses {
            color: #d79a20;
        }

        .status-ditanggapi {
            color: #168c78;
        }

        .status-selesai {
            color: #20865b;
        }

        .detail-link {
            color: #1769aa;
            font-size: 10px;
            font-weight: 600;
        }

        .detail-link:hover {
            text-decoration: underline;
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .empty-state {
            padding: 35px 15px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            text-align: center;
        }

        .empty-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            color: #1769aa;
            background: #e1f1fa;
            border-radius: 50%;
            font-size: 24px;
        }

        .empty-title {
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 700;
        }

        .empty-description {
            color: var(--muted);
            font-size: 11px;
        }

        /* =========================
           LIHAT SELENGKAPNYA
        ========================= */

        .history-footer {
            display: flex;
            justify-content: flex-end;
            padding: 12px 5px 0;
        }

        .see-all-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #1769aa;
            font-size: 12px;
            font-weight: 700;
        }

        .see-all-link:hover {
            text-decoration: underline;
        }

        /* FOOTER */

        .dashboard-footer {
            margin-top: auto;
            padding: 20px 38px 15px;
            border-top: 1px solid var(--border);
            color: #8994a0;
            font-size: 10px;
            text-align: center;
        }

        /* SIDEBAR OVERLAY */

        .sidebar-overlay {
            display: none;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1350px) {
            .stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 1000px) {
            .sidebar {
                width: 275px;
            }

            .main-content {
                margin-left: 275px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .welcome-title {
                font-size: 27px;
            }

            .topbar {
                padding-left: 20px;
                padding-right: 20px;
            }

            .welcome-banner {
                margin: 0 20px 22px;
            }

            .stats-wrapper,
            .history-section {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 275px;
                max-width: 85vw;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 10px 0 35px rgba(0, 0, 0, .12);
            }

            .sidebar-overlay.active {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(20, 35, 26, .45);
            }

            .main-content {
                margin-left: 0;
            }

            /* Hamburger hanya tampil di mobile */
            .sidebar-toggle {
                display: inline-flex;
            }

            .topbar {
                padding: 12px 15px;
            }

            .welcome-banner {
                margin: 15px 15px 22px;
            }

            .welcome-main {
                min-height: 155px;
            }

            .welcome-text {
                padding: 17px;
            }

            .welcome-title {
                font-size: 23px;
            }

            .welcome-description {
                font-size: 11px;
            }

            .welcome-image {
                flex-basis: 36%;
                width: 36%;
                max-width: 36%;
                height: 155px;
                object-fit: contain;
                object-position: right bottom;
            }

            .stats-wrapper,
            .history-section {
                padding: 0 15px;
            }

            .dashboard-footer {
                padding: 18px 15px;
            }
        }

        @media (max-width: 560px) {
            .brand-image {
                width: 85px;
                height: 85px;
            }

            .brand-title {
                font-size: 23px;
            }

            .welcome-main {
                min-height: 145px;
            }

            .welcome-text {
                padding: 14px;
            }

            .welcome-title {
                font-size: 19px;
            }

            .welcome-description {
                font-size: 10px;
            }

            .welcome-image {
                flex-basis: 32%;
                width: 32%;
                max-width: 32%;
                height: 145px;
                object-fit: contain;
                object-position: right bottom;
            }

            .stats-grid {
                gap: 9px;
            }

            .stat-card {
                padding: 13px 10px;
            }

            .stat-top {
                gap: 8px;
            }

            .stat-icon {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .stat-label {
                font-size: 9px;
            }

            .stat-value {
                padding-left: 0;
                font-size: 23px;
            }

            .stat-note {
                padding-left: 0;
                font-size: 9px;
            }

            .section-title {
                font-size: 15px;
            }

            .history-item {
                align-items: flex-start;
                gap: 8px;
                padding: 12px 10px;
            }

            .history-main {
                gap: 9px;
            }

            .history-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .history-title {
                font-size: 10px;
            }

            .history-description,
            .history-meta {
                font-size: 9px;
            }

            .history-date {
                font-size: 9px;
            }

            .status-text {
                font-size: 10px;
            }

            .history-side {
                gap: 6px;
            }
        }

        @media (max-width: 380px) {
            .welcome-title {
                font-size: 17px;
            }

            .welcome-image {
                flex-basis: 28%;
                width: 28%;
                max-width: 28%;
            }

            .history-item {
                flex-direction: column;
            }

            .history-side {
                width: 100%;
                padding-left: 45px;
                flex-direction: row;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                text-align: left;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();

    $totalPengaduan = $totalPengaduan ?? 0;
    $pengaduanDitanggapi = $pengaduanDitanggapi ?? 0;
    $pengaduanDiproses = $pengaduanDiproses ?? 0;
    $pengaduanDiverifikasi = $pengaduanDiverifikasi ?? 0;
    $pengaduanSelesai = $pengaduanSelesai ?? 0;

    $pengaduanTerbaru = $pengaduanTerbaru ?? collect();

    $statusClass = [
        'diajukan' => 'status-diajukan',
        'diverifikasi' => 'status-diverifikasi',
        'diproses' => 'status-diproses',
        'ditanggapi' => 'status-ditanggapi',
        'selesai' => 'status-selesai',
    ];

    $statusLabel = [
        'diajukan' => 'Diajukan',
        'diverifikasi' => 'Diverifikasi',
        'diproses' => 'Diproses',
        'ditanggapi' => 'Ditanggapi',
        'selesai' => 'Selesai',
    ];
@endphp

<!-- OVERLAY SIDEBAR -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR ADMIN -->
<aside class="sidebar" id="sidebar">

    <div class="brand">

        <img
            src="{{ asset('images/logo-siforawa.jpeg') }}"
            alt="Logo SIFORAWA"
            class="brand-image"
        >

        <div>
            <div class="brand-title">SIFORAWA</div>

            <div class="brand-subtitle">
                Sistem Informasi Aduan Warga
            </div>

            <div class="brand-location">
                Kelurahan Cibaduyut
            </div>
        </div>

    </div>

    <div class="menu-label">
        MENU ADMIN
    </div>

    <nav class="sidebar-menu">

        <!-- BERANDA ADMIN -->
        <a
            href="{{ route('admin.dashboard') }}"
            class="menu-item active"
            aria-current="page"
        >
            <i class="fa-solid fa-house"></i>
            <span>Beranda</span>
        </a>

        <!-- DAFTAR SEMUA PENGADUAN -->
        <a
            href="{{ route('admin.pengaduan.index') }}"
            class="menu-item"
        >
            <i class="fa-solid fa-folder-open"></i>
            <span>Pengaduan</span>
        </a>

        <!-- RIWAYAT PENGADUAN -->
        <a
            href="{{ route('admin.riwayat.index') }}"
            class="menu-item"
        >
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Riwayat Pengaduan</span>
        </a>

        <!-- PROFIL ADMIN -->
        <a
            href="{{ route('admin.profil') }}"
            class="menu-item"
        >
            <i class="fa-solid fa-user"></i>
            <span>Profil</span>
        </a>

    </nav>

    <!-- ILUSTRASI SIDEBAR -->
    <div class="sidebar-illustration-wrapper">

        <img
            src="{{ asset('images/ilustrasi-sidebar.jpeg') }}"
            alt="Ilustrasi lingkungan Kelurahan Cibaduyut"
            class="sidebar-illustration"
        >

    </div>

    <!-- LOGOUT -->
    <div class="sidebar-bottom">

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>

    </div>

</aside>

<!-- MAIN CONTENT -->
<main class="main-content">

    <!-- TOPBAR -->
    <header class="topbar">

        <div class="topbar-left">

            <button
                class="sidebar-toggle"
                id="sidebarToggle"
                type="button"
                aria-label="Buka atau tutup menu"
                aria-expanded="false"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>

        <!-- PROFIL ADMIN -->
        <div class="profile-summary">

            <div class="profile-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <div class="profile-name">
                    {{ $user->username ?? $user->name ?? 'Admin' }}
                </div>

                <div class="profile-role">
                    Admin
                </div>
            </div>

        </div>

    </header>

    <!-- BANNER SELAMAT DATANG -->
    <section class="welcome-banner">

        <div class="welcome-main">

            <div class="welcome-text">

                <h1 class="welcome-title">
                    Halo selamat datang admin!
                </h1>

                <p class="welcome-description">
                    <span class="line">
                        Selamat datang di SIFORAWA.
                    </span>

                    <span class="line">
                        Selamat bekerja dan bertugas
                    </span>
                </p>

            </div>

            <!-- GAMBAR ADMIN -->
            <img
                src="{{ asset('images/banner-admin.jpeg') }}"
                alt="Ilustrasi admin sedang bekerja di depan laptop"
                class="welcome-image"
            >

        </div>

    </section>

    <!-- STATISTIK PENGADUAN -->
    <section class="stats-wrapper">

        <div class="stats-grid">

            <!-- TOTAL PENGADUAN -->
            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-icon icon-blue">
                        <i class="fa-solid fa-file-lines"></i>
                    </span>

                    <span class="stat-label">
                        Total Pengaduan
                    </span>

                </div>

                <div class="stat-value">
                    {{ $totalPengaduan }}
                </div>

                <div class="stat-note">
                    Seluruh laporan warga
                </div>

            </div>

            <!-- DITANGGAPI -->
            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-icon icon-green">
                        <i class="fa-solid fa-comment-dots"></i>
                    </span>

                    <span class="stat-label">
                        Ditanggapi
                    </span>

                </div>

                <div class="stat-value">
                    {{ $pengaduanDitanggapi }}
                </div>

                <div class="stat-note">
                    Sudah ditanggapi
                </div>

            </div>

            <!-- DIPROSES -->
            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-icon icon-orange">
                        <i class="fa-solid fa-gears"></i>
                    </span>

                    <span class="stat-label">
                        Diproses
                    </span>

                </div>

                <div class="stat-value">
                    {{ $pengaduanDiproses }}
                </div>

                <div class="stat-note">
                    Sedang ditindaklanjuti
                </div>

            </div>

            <!-- DIVERIFIKASI -->
            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-icon icon-teal">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>

                    <span class="stat-label">
                        Diverifikasi
                    </span>

                </div>

                <div class="stat-value">
                    {{ $pengaduanDiverifikasi }}
                </div>

                <div class="stat-note">
                    Sudah diperiksa
                </div>

            </div>

            <!-- SELESAI -->
            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-icon icon-purple">
                        <i class="fa-solid fa-check-double"></i>
                    </span>

                    <span class="stat-label">
                        Selesai
                    </span>

                </div>

                <div class="stat-value">
                    {{ $pengaduanSelesai }}
                </div>

                <div class="stat-note">
                    Penanganan selesai
                </div>

            </div>

        </div>

    </section>

    <!-- INFORMASI PENGADUAN DARI SEMUA WARGA -->
    <section class="history-section">

        <div class="section-heading">

            <div>
                <h2 class="section-title">
                    Informasi Pengaduan
                </h2>

                <p class="section-description">
                    Daftar pengaduan terbaru dari warga Kelurahan Cibaduyut.
                </p>
            </div>

        </div>

        @if($pengaduanTerbaru->count() > 0)

            <div class="history-list">

                @foreach($pengaduanTerbaru as $pengaduan)

                    @php
                        $status = strtolower(
                            $pengaduan->status ?? 'diajukan'
                        );

                        $classStatus = $statusClass[$status]
                            ?? 'status-diajukan';

                        $labelStatus = $statusLabel[$status]
                            ?? ucfirst($status);
                    @endphp

                    <article class="history-item">

                        <div class="history-main">

                            <div class="history-icon">
                                <i class="fa-regular fa-file-lines"></i>
                            </div>

                            <div class="history-info">

                                <!-- JUDUL PENGADUAN -->
                                <h3 class="history-title">
                                    {{ $pengaduan->judul }}
                                </h3>

                                <!-- JENIS PENGADUAN -->
                                <p class="history-description">
                                    {{ $pengaduan->jenis_pengaduan }}
                                </p>

                                <!-- RW -->
                                <p class="history-meta">
                                    RW {{ $pengaduan->rw }}
                                </p>

                            </div>

                        </div>

                        <div class="history-side">

                            <!-- TANGGAL PENGADUAN -->
                            <span class="history-date">
                                {{
                                    $pengaduan->created_at
                                        ? $pengaduan->created_at->translatedFormat('d F Y')
                                        : '-'
                                }}
                            </span>

                            <!-- STATUS -->
                            <span class="status-text {{ $classStatus }}">
                                {{ $labelStatus }}
                            </span>

                        </div>

                    </article>

                @endforeach

            </div>

            <!-- LIHAT SEMUA PENGADUAN -->
            <div class="history-footer">

                <a
                    href="{{ route('admin.pengaduan.index') }}"
                    class="see-all-link"
                >
                    Lihat selengkapnya
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        @else

            <!-- JIKA BELUM ADA PENGADUAN -->
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="fa-regular fa-folder-open"></i>
                </div>

                <h3 class="empty-title">
                    Belum Ada Pengaduan
                </h3>

                <p class="empty-description">
                    Belum ada pengaduan yang dikirim oleh warga.
                </p>

            </div>

        @endif

    </section>

    <!-- FOOTER -->
    <footer class="dashboard-footer">

        &copy; {{ date('Y') }}
        Kelurahan Cibaduyut.
        SIFORAWA — Sistem Informasi Aduan Warga.

    </footer>

</main>

<!-- JAVASCRIPT SIDEBAR -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');

        function bukaSidebar() {
            sidebar.classList.add('active');
            overlay.classList.add('active');

            toggle.setAttribute('aria-expanded', 'true');
            toggle.setAttribute('aria-label', 'Tutup menu');
        }

        function tutupSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');

            toggle.setAttribute('aria-expanded', 'false');
            toggle.setAttribute('aria-label', 'Buka menu');
        }

        toggle.addEventListener('click', function () {

            if (sidebar.classList.contains('active')) {
                tutupSidebar();
            } else {
                bukaSidebar();
            }

        });

        overlay.addEventListener('click', tutupSidebar);

        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                tutupSidebar();
            }

        });

        window.addEventListener('resize', function () {

            if (window.innerWidth > 768) {
                tutupSidebar();
            }

        });

    });
</script>

</body>
</html>