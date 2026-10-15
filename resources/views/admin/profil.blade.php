
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $judulProfil ?? 'Profil Admin' }} - SIFORAWA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary: #164b99;
            --primary-dark: #103b7b;
            --sidebar-bg: #c5e0f1;
            --page-bg: #eff7ff;
            --white: #ffffff;
            --text: #183c68;
            --muted: #71839b;
            --danger: #dc3545;
            --shadow: 0 12px 35px rgba(31, 79, 133, .09);
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

        button, input { font: inherit; }
        a { text-decoration: none; }

        /* SIDEBAR */

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

        .brand-subtitle, .brand-location {
            font-size: 10px;
            line-height: 1.6;
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

        .menu-item:hover { background: rgba(255, 255, 255, .45); }

        .menu-item.active {
            background: rgba(255, 255, 255, .58);
            color: #104891;
            font-weight: 700;
        }

        .sidebar-illustration-wrapper {
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
            background: var(--danger);
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-button:hover { background: #bb2534; }

        .sidebar-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid #dce7f2;
            border-radius: 9px;
            background: white;
            color: var(--primary);
            cursor: pointer;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sidebar-overlay { display: none; }

        /* KONTEN */

        .main-content {
            margin-left: 310px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 36px 48px 25px;
        }

        .page-heading {
            margin-bottom: 25px;
            animation: fadeIn .55s ease both;
        }

        .page-heading h1 {
            color: #3859b8;
            font-size: 29px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: #52657b;
            font-size: 13px;
            line-height: 1.7;
        }

        .alert {
            max-width: 950px;
            padding: 14px 17px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-success {
            background: #e9f9f0;
            border: 1px solid #bcebd0;
            color: #176a43;
        }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #f4c5c5;
            color: #a72b2b;
        }

        /* KARTU PROFIL */

        .profile-card {
            width: 100%;
            max-width: 950px;
            background: var(--white);
            border: 1px solid rgba(214, 230, 244, .8);
            border-radius: 20px;
            padding: 38px;
            display: grid;
            grid-template-columns: minmax(180px, .8fr) minmax(0, 1.2fr);
            align-items: center;
            gap: 35px;
            box-shadow: var(--shadow);
            animation: fadeUp .65s ease both;
        }

        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 17px;
        }

        .avatar-wrap {
            position: relative;
            width: 220px;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-halo {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: #b9e9f7;
            animation: haloPulse 3s ease-in-out infinite;
        }

        .avatar {
            width: 190px;
            height: 190px;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, #65c9e2, #3b9fc9);
            box-shadow: 0 10px 25px rgba(44, 156, 199, .22);
            animation: floatAvatar 4s ease-in-out infinite;
        }

        .avatar-head {
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #f7fcff;
        }

        .avatar-body {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 116px;
            height: 88px;
            border-radius: 60px 60px 12px 12px;
            background: #f7fcff;
        }

        .avatar-caption {
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        .profile-details { min-width: 0; }

        .detail-item {
            padding: 15px 0;
            border-bottom: 1px solid #eaf0f7;
        }

        .detail-item:first-child { padding-top: 0; }
        .detail-item:last-child { border-bottom: none; }

        .detail-label {
            display: block;
            color: #6a7b90;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .detail-value {
            color: #1c2c40;
            font-size: 19px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .role-badge {
            display: inline-block;
            color: var(--primary);
            background: #e6f2ff;
            border-radius: 20px;
            padding: 6px 13px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        /* TOMBOL GANTI PASSWORD */

        .password-toggle-section {
            width: 100%;
            max-width: 950px;
            margin-top: 25px;
        }

        .btn-open-password {
            min-height: 48px;
            padding: 0 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 5px 14px rgba(23, 76, 155, .18);
            transition: background .2s, transform .2s;
        }

        .btn-open-password:hover {
            background: #103b7b;
            transform: translateY(-2px);
        }

        /* FORM PASSWORD */

        .password-card {
            display: none;
            width: 100%;
            max-width: 950px;
            margin-top: 20px;
            padding: 30px 35px;
            background: var(--white);
            border: 1px solid rgba(214, 230, 244, .8);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .password-card.show {
            display: block;
            animation: fadeUp .4s ease both;
        }

        .section-heading { margin-bottom: 23px; }

        .section-heading h2 {
            color: var(--primary);
            font-size: 20px;
            margin-bottom: 7px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group { min-width: 0; }
        .form-group.full-width { grid-column: 1 / -1; }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334b67;
            margin-bottom: 9px;
        }

        .input-wrap { position: relative; }

        .form-input {
            width: 100%;
            height: 47px;
            border: 1px solid #d7e4f0;
            border-radius: 10px;
            padding: 0 48px 0 14px;
            color: #24364b;
            background: #fbfdff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-input:focus {
            border-color: #4d8cce;
            box-shadow: 0 0 0 3px rgba(77, 140, 206, .12);
            background: #fff;
        }

        .toggle-password {
            position: absolute;
            right: 7px;
            top: 50%;
            transform: translateY(-50%);
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #71849b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover {
            background: #eaf4ff;
            color: var(--primary);
        }

        .toggle-password svg { width: 20px; height: 20px; }

        .field-error {
            display: block;
            margin-top: 7px;
            color: #d52e38;
            font-size: 12px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .btn-save {
            min-height: 46px;
            padding: 0 23px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 5px 14px rgba(23, 76, 155, .18);
            transition: background .2s, transform .2s;
        }

        .btn-save:hover {
            background: #103b7b;
            transform: translateY(-2px);
        }

        /* ANIMASI */

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes floatAvatar {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-7px); }
        }

        @keyframes haloPulse {
            0%, 100% { transform: scale(.98); opacity: .6; }
            50% { transform: scale(1.07); opacity: .95; }
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .sidebar { width: 270px; }

            .main-content {
                margin-left: 270px;
                padding: 30px 28px 25px;
            }

            .brand { gap: 8px; padding: 16px 12px; }
            .brand-image { width: 80px; height: 80px; }
            .brand-title { font-size: 22px; }

            .profile-card { padding: 28px; gap: 20px; }
            .avatar-wrap { width: 185px; height: 185px; }
            .avatar { width: 160px; height: 160px; }
            .avatar-head { top: 25px; width: 47px; height: 47px; }
            .avatar-body { width: 100px; height: 75px; }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: min(300px, 85vw);
                transform: translateX(-100%);
                box-shadow: 5px 0 25px rgba(0, 0, 0, .12);
            }

            .sidebar.open { transform: translateX(0); }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(12, 34, 60, .45);
            }

            .sidebar-overlay.show { display: block; }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px 18px 30px;
            }

            .sidebar-toggle {
                display: grid;
                place-items: center;
                margin-bottom: 20px;
            }

            .page-heading h1 { font-size: 25px; }

            .profile-card {
                grid-template-columns: 1fr;
                padding: 26px 20px;
                gap: 24px;
            }

            .avatar-wrap { width: 170px; height: 170px; }
            .avatar { width: 148px; height: 148px; }
            .avatar-head { top: 23px; width: 44px; height: 44px; }
            .avatar-body { width: 92px; height: 69px; }
            .profile-details { width: 100%; }
            .detail-value { font-size: 17px; }

            .password-card { padding: 25px 20px; }
            .btn-open-password { width: 100%; }
        }

        @media (max-width: 480px) {
            .brand-title { font-size: 21px; }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }

            .form-group.full-width { grid-column: auto; }
            .form-actions { justify-content: stretch; }
            .btn-save { width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

@php
    $judul = $judulProfil ?? 'Profil Admin';
    $pengguna = $profil ?? auth()->user();
@endphp

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
            <div class="brand-subtitle">Sistem Informasi Aduan Warga</div>
            <div class="brand-location">Kelurahan Cibaduyut</div>
        </div>
    </div>

    <div class="menu-label">MENU ADMIN</div>

    <nav class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <i class="fa-solid fa-house"></i>
            <span>Beranda</span>
        </a>

        <a href="{{ route('admin.pengaduan.index') }}" class="menu-item">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Pengaduan Warga</span>
        </a>

        <a href="{{ route('admin.riwayat.index') }}" class="menu-item">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>Riwayat Pengaduan</span>
        </a>

        <a
            href="{{ route('admin.profil') }}"
            class="menu-item active"
            aria-current="page"
        >
            <i class="fa-solid fa-user"></i>
            <span>Profil Admin</span>
        </a>
    </nav>

    <div class="sidebar-illustration-wrapper">
        <img
            src="{{ asset('images/ilustrasi-sidebar.jpeg') }}"
            alt="Ilustrasi lingkungan perumahan"
            class="sidebar-illustration"
        >
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

<!-- KONTEN UTAMA -->
<main class="main-content">

    <button
        class="sidebar-toggle"
        id="sidebarToggle"
        type="button"
        aria-label="Buka menu"
        aria-expanded="false"
    >
        <i class="fa-solid fa-bars"></i>
    </button>

    <header class="page-heading">
        <h1>{{ $judul }}</h1>
        <p>Kelola informasi akun admin Anda</p>
    </header>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <strong>Periksa kembali data berikut:</strong>
            <ul style="margin: 8px 0 0 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- KARTU PROFIL -->
    <section class="profile-card">

        <div class="avatar-section">
            <div class="avatar-wrap">
                <div class="avatar-halo"></div>

                <div class="avatar" aria-label="Ikon profil admin">
                    <div class="avatar-head"></div>
                    <div class="avatar-body"></div>
                </div>
            </div>

            <p class="avatar-caption">Profil akun admin SIFORAWA</p>
        </div>

        <div class="profile-details">

            <div class="detail-item">
                <span class="detail-label">Nama Pengguna</span>
                <div class="detail-value">
                    {{ $pengguna->username ?? 'Belum tersedia' }}
                </div>
            </div>

            <div class="detail-item">
                <span class="detail-label">Nomor Telepon</span>
                <div class="detail-value">
                    {{ $pengguna->no_telepon ?? 'Belum diisi' }}
                </div>
            </div>

            <div class="detail-item">
                <span class="detail-label">Jenis Akun</span>
                <span class="role-badge">
                    {{ $pengguna->role ?? 'admin' }}
                </span>
            </div>

        </div>
    </section>

    <!-- TOMBOL GANTI PASSWORD -->
    <div class="password-toggle-section">
        <button
            type="button"
            class="btn-open-password"
            id="togglePasswordForm"
            aria-expanded="{{ $errors->any() ? 'true' : 'false' }}"
            aria-controls="passwordCard"
        >
            <i class="fa-solid fa-lock"></i>
            <span id="passwordButtonText">
                {{ $errors->any() ? 'Tutup Form Ganti Password' : 'Ganti Password' }}
            </span>
        </button>
    </div>

    <!-- FORM PASSWORD -->
    <section
        class="password-card {{ $errors->any() ? 'show' : '' }}"
        id="passwordCard"
    >

        <div class="section-heading">
            <h2>Ganti Password</h2>
            <p>
                Masukkan password lama, lalu buat password baru
                untuk menjaga keamanan akun Anda.
            </p>
        </div>

        <form
            action="{{ route('profil.password.update') }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group full-width">
                    <label class="form-label" for="password_lama">
                        Password Lama
                    </label>

                    <div class="input-wrap">
                        <input
                            type="password"
                            name="password_lama"
                            id="password_lama"
                            class="form-input"
                            placeholder="Masukkan password lama"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            data-target="password_lama"
                            aria-label="Tampilkan password lama"
                            aria-pressed="false"
                        >
                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12S5.5 5 12 5S22 12 22 12S18.5 19 12 19S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>

                    @error('password_lama')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_baru">
                        Password Baru
                    </label>

                    <div class="input-wrap">
                        <input
                            type="password"
                            name="password_baru"
                            id="password_baru"
                            class="form-input"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            data-target="password_baru"
                            aria-label="Tampilkan password baru"
                            aria-pressed="false"
                        >
                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12S5.5 5 12 5S22 12 22 12S18.5 19 12 19S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>

                    @error('password_baru')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_baru_confirmation">
                        Konfirmasi Password Baru
                    </label>

                    <div class="input-wrap">
                        <input
                            type="password"
                            name="password_baru_confirmation"
                            id="password_baru_confirmation"
                            class="form-input"
                            placeholder="Ulangi password baru"
                            autocomplete="new-password"
                            minlength="8"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            data-target="password_baru_confirmation"
                            aria-label="Tampilkan konfirmasi password"
                            aria-pressed="false"
                        >
                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12S5.5 5 12 5S22 12 22 12S18.5 19 12 19S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Password
                </button>
            </div>
        </form>
    </section>

</main>

<script>
    // SIDEBAR MOBILE
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function bukaSidebar() {
        sidebar.classList.add('open');
        sidebarOverlay.classList.add('show');
        sidebarToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function tutupSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('show');
        sidebarToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (sidebarToggle && sidebarOverlay) {
        sidebarToggle.addEventListener('click', function () {
            if (sidebar.classList.contains('open')) {
                tutupSidebar();
            } else {
                bukaSidebar();
            }
        });

        sidebarOverlay.addEventListener('click', tutupSidebar);

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
    }

    // BUKA/TUTUP FORM PASSWORD
    const passwordToggleButton = document.getElementById('togglePasswordForm');
    const passwordCard = document.getElementById('passwordCard');
    const passwordButtonText = document.getElementById('passwordButtonText');

    if (passwordToggleButton && passwordCard) {
        passwordToggleButton.addEventListener('click', function () {
            const sedangTerbuka = passwordCard.classList.toggle('show');

            passwordToggleButton.setAttribute(
                'aria-expanded',
                sedangTerbuka ? 'true' : 'false'
            );

            passwordButtonText.textContent = sedangTerbuka
                ? 'Tutup Form Ganti Password'
                : 'Ganti Password';

            if (sedangTerbuka) {
                passwordCard.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // TAMPILKAN/SEMBUNYIKAN PASSWORD
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(
                this.getAttribute('data-target')
            );

            if (!input) {
                return;
            }

            const tampilkan = input.type === 'password';
            input.type = tampilkan ? 'text' : 'password';

            this.setAttribute(
                'aria-pressed',
                tampilkan ? 'true' : 'false'
            );

            this.setAttribute(
                'aria-label',
                tampilkan ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });
    });
</script>

</body>
</html>