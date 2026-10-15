
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga | SIFORAWA</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

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
            --red: #dc3545;
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

        /* =====================================================
           SIDEBAR
           ===================================================== */

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

        .sidebar-caption {
            display: none;
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
            cursor: pointer;
            transition: background .2s;
        }

        .logout-button:hover {
            background: #bb2534;
        }

        /* =====================================================
           MAIN CONTENT
           ===================================================== */

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

        .page-title,
        .page-subtitle {
            display: none;
        }

        .profile-summary {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #c3e6f5;
            color: #2584b6;
            font-size: 19px;
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

        .sidebar-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            color: var(--primary);
            cursor: pointer;
            font-size: 18px;
        }

        /* WELCOME BANNER */

        .welcome-banner {
            margin: 25px 38px 0;
            overflow: hidden;
            background: #dceefa;
            border: 1px solid #d5e8f3;
            box-shadow: 0 5px 10px rgba(51, 88, 111, .10);
        }

        .welcome-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 205px;
            overflow: hidden;
        }

        .welcome-text {
            width: 58%;
            padding: 30px;
        }

        .welcome-title {
            margin-bottom: 13px;
            color: #104a82;
            font-size: 32px;
            font-weight: 800;
            line-height: 1.2;
        }

        .welcome-description {
            max-width: 570px;
            color: #3e6585;
            font-size: 12px;
            line-height: 2;
        }

        .welcome-description .line {
            display: block;
        }

        .welcome-image {
            width: 42%;
            height: 205px;
            object-fit: cover;
            object-position: center;
            align-self: stretch;
        }

        /* MOTTO / BANNER ABU-ABU */

        .motto-box {
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 62px;
            margin: 0 38px 25px;
            padding: 11px 24px;
            background: #e2e2e2;
        }

        .motto-icon {
            flex-shrink: 0;
            color: #3f3f3f;
            font-size: 19px;
        }

        .motto-text {
            color: #4d4d4d;
            font-size: 11px;
            line-height: 1.55;
        }

        .motto-text strong {
            display: block;
            color: #3f3f3f;
            font-size: 12px;
            font-weight: 600;
        }

        /* =====================================================
           STATISTIK
           DIUBAH HANYA MENJADI 5 KARTU
           ===================================================== */

        .stats-wrapper {
            padding: 0 38px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 28px;
        }

        .stat-card {
            min-width: 0;
            padding: 17px 15px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;
            box-shadow: 0 4px 18px rgba(39, 87, 116, .04);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 7px;
            margin-bottom: 15px;
        }

        .stat-label {
            color: #607d94;
            font-size: 10px;
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
        }

        .green {
            color: #1769aa;
            background: #e1f1fa;
        }

        .orange {
            color: #d97706;
            background: #fff1db;
        }

        .blue {
            color: #2471bd;
            background: #e6f1ff;
        }

        .purple {
            color: #8055c7;
            background: #f0eaff;
        }

        .stat-value {
            color: #263f55;
            font-size: 27px;
            font-weight: 800;
            line-height: 1.3;
        }

        .stat-note {
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
        }

        /* RIWAYAT */

        .history-card {
            margin: 0 38px 24px;
            padding: 21px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(39, 87, 116, .04);
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title {
            color: #173f63;
            font-size: 20px;
            font-weight: 700;
        }

        .section-description {
            margin-top: 3px;
            color: var(--muted);
            font-size: 10px;
        }

        .history-list {
            display: flex;
            flex-direction: column;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 16px 0;
            border-bottom: 1px solid #edf0ed;
        }

        .history-item:last-child {
            border-bottom: 0;
        }

        .history-main {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            min-width: 0;
        }

        .history-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1769aa;
            background: #e1f1fa;
            border-radius: 10px;
        }

        .history-info {
            min-width: 0;
        }

        .history-title {
            margin-bottom: 4px;
            overflow-wrap: anywhere;
            color: #1c5d96;
            font-size: 12px;
            font-weight: 700;
        }

        .history-description {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .history-date {
            margin-top: 5px;
            color: #8b958e;
            font-size: 10px;
        }

        .history-side {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
            flex-shrink: 0;
        }

        /* STATUS */

        .status-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .status-diajukan {
            color: #a16207;
            background: #fef3c7;
        }

        .status-diverifikasi {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .status-diproses {
            color: #7e22ce;
            background: #f3e8ff;
        }

        .status-ditanggapi {
            color: #0e7490;
            background: #cffafe;
        }

        .status-selesai {
            color: #166534;
            background: #dcfce7;
        }

        .detail-link {
            color: #1769aa;
            font-size: 10px;
            font-weight: 600;
        }

        .detail-link:hover {
            text-decoration: underline;
        }

        /* EMPTY STATE */

        .empty-state {
            padding: 36px 15px;
            text-align: center;
        }

        .empty-icon {
            width: 62px;
            height: 62px;
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
            margin-bottom: 16px;
            color: var(--muted);
            font-size: 11px;
        }

        .primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            color: white;
            background: #1769aa;
            border: 0;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 600;
        }

        .primary-button:hover {
            background: #104f87;
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

        /* OVERLAY */

        .sidebar-overlay {
            display: none;
        }

        /* RESPONSIVE */

        @media (max-width: 1250px) {
            .stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .sidebar-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .topbar {
                padding: 14px 15px;
            }

            .welcome-banner {
                margin: 15px 15px 0;
            }

            .welcome-main {
                min-height: 175px;
            }

            .welcome-text {
                width: 60%;
                padding: 20px;
            }

            .welcome-title {
                font-size: 23px;
            }

            .welcome-description {
                font-size: 10px;
                line-height: 1.8;
            }

            .welcome-image {
                width: 40%;
                height: 175px;
            }

            .motto-box {
                margin: 0 15px 20px;
            }

            .stats-wrapper {
                padding: 0 15px;
            }

            .history-card {
                margin: 0 15px 20px;
            }
        }

        @media (max-width: 560px) {
            .brand-image {
                width: 94px;
                height: 94px;
            }

            .brand-title {
                font-size: 25px;
            }

            .menu-item {
                min-height: 57px;
                font-size: 14px;
            }

            .menu-item i {
                font-size: 24px;
            }

            .sidebar-illustration {
                height: 205px;
            }

            .welcome-main {
                min-height: 155px;
            }

            .welcome-text {
                width: 62%;
                padding: 15px;
            }

            .welcome-title {
                font-size: 19px;
            }

            .welcome-description {
                font-size: 9px;
            }

            .welcome-image {
                width: 38%;
                height: 155px;
            }

            .stats-grid {
                gap: 9px;
            }

            .stat-card {
                padding: 14px 11px;
            }

            .stat-value {
                font-size: 23px;
            }

            .history-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .history-side {
                align-items: flex-start;
                flex-direction: row;
                padding-left: 54px;
            }
        }

        @media (max-width: 480px) {
            .welcome-title {
                font-size: 17px;
            }

            .welcome-image {
                width: 35%;
                height: 145px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 9px;
            }

            .stat-label {
                font-size: 9px;
            }

            .stat-icon {
                width: 29px;
                height: 29px;
                font-size: 12px;
            }

            .stat-value {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();

    $totalPengaduan = $totalPengaduan ?? 0;
    $pengaduanDiajukan = $pengaduanDiajukan ?? 0;
    $pengaduanDiverifikasi = $pengaduanDiverifikasi ?? 0;
    $pengaduanDiproses = $pengaduanDiproses ?? 0;
    $pengaduanDitanggapi = $pengaduanDitanggapi ?? 0;
    $pengaduanSelesai = $pengaduanSelesai ?? 0;

    $pengaduanTerbaru = $pengaduanTerbaru ?? collect();

    $statusClass = [
        'diajukan' => 'status-diajukan',
        'diverifikasi' => 'status-diverifikasi',
        'diproses' => 'status-diproses',
        'ditanggapi' => 'status-ditanggapi',
        'selesai' => 'status-selesai',
    ];
@endphp

<!-- OVERLAY SIDEBAR -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
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
        MENU UTAMA
    </div>

    <nav class="sidebar-menu">

        <a
            href="{{ route('warga.dashboard') }}"
            class="menu-item active"
            aria-current="page"
        >
            <i class="fa-solid fa-house"></i>
            <span>Beranda</span>
        </a>

        <a
            href="{{ route('warga.pengaduan.create') }}"
            class="menu-item"
        >
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Buat Pengaduan</span>
        </a>

        <!-- LANGSUNG MENU CEK STATUS PENGADUAN -->
        <a
            href="{{ route('warga.pengaduan.index') }}"
            class="menu-item"
        >
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Cek Status Pengaduan</span>
        </a>

        <a
            href="{{ route('warga.profil') }}"
            class="menu-item"
        >
            <i class="fa-solid fa-user"></i>
            <span>Profil Saya</span>
        </a>

    </nav>

    <div class="sidebar-illustration-wrapper">
        <img
            src="{{ asset('images/ilustrasi-sidebar.jpeg') }}"
            alt="Ilustrasi lingkungan perumahan"
            class="sidebar-illustration"
        >

        <div class="sidebar-caption">
            <i class="fa-solid fa-heart"></i>
            Bersama membangun lingkungan yang lebih baik
        </div>
    </div>

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
                aria-label="Buka menu"
            >
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <div class="profile-summary">

            <div class="profile-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <div class="profile-name">
                    {{ $user->username ?? $user->name ?? 'Warga' }}
                </div>

                <div class="profile-role">
                    Warga
                </div>
            </div>

        </div>

    </header>

    <!-- WELCOME -->
    <section class="welcome-banner">

        <div class="welcome-main">

            <div class="welcome-text">

                <h1 class="welcome-title">
                    Halo, {{ $user->username ?? $user->name ?? 'Warga' }}!
                </h1>

                <p class="welcome-description">
                    <span class="line">
                        Selamat datang di SIFORAWA.
                    </span>

                    <span class="line">
                        Sampaikan aduan Anda untuk lingkungan yang lebih baik.
                    </span>
                </p>

            </div>

            <img
                src="{{ asset('images/banner-perumahan.jpeg') }}"
                alt="Ilustrasi lingkungan perumahan"
                class="welcome-image"
            >

        </div>

    </section>

    <!-- BANNER ABU-ABU -->
    <section class="motto-box">

        <i class="fa-solid fa-quote-left motto-icon"></i>

        <div class="motto-text">

            <strong>
                Bersama kita wujudkan lingkungan yang lebih baik.
            </strong>

            Setiap laporan Anda berarti untuk menciptakan lingkungan
            Kelurahan Cibaduyut yang aman, nyaman, dan tertib.

        </div>

    </section>

    <!-- STATISTIK: 5 KARTU DARI DATABASE -->
    <section class="stats-wrapper">

        <div class="stats-grid">

            <!-- TOTAL PENGADUAN -->
            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-label">
                        Total Pengaduan
                    </span>

                    <span class="stat-icon green">
                        <i class="fa-solid fa-file-lines"></i>
                    </span>
                </div>

                <div class="stat-value">
                    {{ $totalPengaduan }}
                </div>

                <div class="stat-note">
                    Seluruh laporan Anda
                </div>

            </div>

            <!-- PENGADUAN DITANGGAPI -->
            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-label">
                        Pengaduan Ditanggapi
                    </span>

                    <span class="stat-icon green">
                        <i class="fa-solid fa-comment-dots"></i>
                    </span>
                </div>

                <div class="stat-value">
                    {{ $pengaduanDitanggapi }}
                </div>

                <div class="stat-note">
                    Sudah mendapat tanggapan
                </div>

            </div>

            <!-- PENGADUAN DIPROSES -->
            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-label">
                        Pengaduan Diproses
                    </span>

                    <span class="stat-icon orange">
                        <i class="fa-solid fa-gears"></i>
                    </span>
                </div>

                <div class="stat-value">
                    {{ $pengaduanDiproses }}
                </div>

                <div class="stat-note">
                    Sedang ditindaklanjuti
                </div>

            </div>

            <!-- PENGADUAN DIVERIFIKASI -->
            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-label">
                        Pengaduan Diverifikasi
                    </span>

                    <span class="stat-icon blue">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                </div>

                <div class="stat-value">
                    {{ $pengaduanDiverifikasi }}
                </div>

                <div class="stat-note">
                    Sudah diperiksa
                </div>

            </div>

            <!-- PENGADUAN SELESAI -->
            <div class="stat-card">

                <div class="stat-top">
                    <span class="stat-label">
                        Pengaduan Selesai
                    </span>

                    <span class="stat-icon purple">
                        <i class="fa-solid fa-check-double"></i>
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

    <!-- RIWAYAT PENGADUAN -->
    <section class="history-card">

        <div class="section-heading">

            <div>
                <h2 class="section-title">
                    Riwayat Pengaduan
                </h2>

                <p class="section-description">
                    Pengaduan terbaru yang Anda kirim.
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
                    @endphp

                    <article class="history-item">

                        <div class="history-main">

                            <div class="history-icon">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>

                            <div class="history-info">

                                <h3 class="history-title">
                                    {{ $pengaduan->judul }}
                                </h3>

                                <p class="history-description">
                                    {{
                                        \Illuminate\Support\Str::limit(
                                            $pengaduan->isi_pengaduan ?? '',
                                            120
                                        )
                                    }}
                                </p>

                                <div class="history-date">
                                    <i class="fa-regular fa-calendar"></i>

                                    {{
                                        $pengaduan->created_at?->format(
                                            'd M Y, H:i'
                                        ) ?? '-'
                                    }}
                                </div>

                            </div>

                        </div>

                        <div class="history-side">

                            <span class="status-badge {{ $classStatus }}">
                                {{ ucfirst($status) }}
                            </span>

                            <!-- TETAP MENU CEK STATUS PENGADUAN -->
                            <a
                                href="{{ route('warga.pengaduan.index') }}"
                                class="detail-link"
                            >
                                Lihat status
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="fa-regular fa-folder-open"></i>
                </div>

                <h3 class="empty-title">
                    Belum Ada Pengaduan
                </h3>

                <p class="empty-description">
                    Anda belum mengirim pengaduan.
                </p>

                <a
                    href="{{ route('warga.pengaduan.create') }}"
                    class="primary-button"
                >
                    <i class="fa-solid fa-plus"></i>
                    Buat Pengaduan
                </a>

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
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');

    function bukaSidebar() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
    }

    function tutupSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    }

    toggle.addEventListener('click', function () {
        if (sidebar.classList.contains('active')) {
            tutupSidebar();
        } else {
            bukaSidebar();
        }
    });

    overlay.addEventListener('click', tutupSidebar);
</script>

</body>
</html>