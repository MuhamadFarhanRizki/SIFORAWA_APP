<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Pengaduan - SIFORAWA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary: #164b99;
            --primary-light: #315fbd;
            --sidebar-bg: #c5e0f1;
            --page-bg: #eff7ff;
            --text: #183c68;
            --border: #dce7f2;
            --orange: #e89436;
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
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

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

        .brand-subtitle,
        .brand-location {
            font-size: 10px;
            line-height: 1.6;
            color: #183c68;
        }

        .brand-subtitle {
            font-weight: 500;
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
            transition: background .2s;
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
            background: #dc3545;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #bb2534;
        }

        /* KONTEN */

        .main-content {
            margin-left: 310px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-area {
            flex: 1;
            width: 100%;
            padding: 36px 48px 30px;
            display: flex;
            align-items: center;
        }

        .content-container {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
        }

        .mobile-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }

        .page-heading h1 {
            margin-bottom: 7px;
            color: #4859c3;
            font-size: 27px;
            font-weight: 700;
        }

        .page-heading p {
            color: #303b4b;
            font-size: 13px;
            line-height: 1.8;
        }

        .sidebar-toggle {
            display: none;
            place-items: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: #fff;
            color: var(--primary);
            font-size: 18px;
            cursor: pointer;
        }

        /* NOTIFIKASI */

        .alert {
            padding: 13px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 12px;
        }

        .alert-success {
            background: #e5f7eb;
            border: 1px solid #b7e4c7;
            color: #176b36;
        }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #f0c3c3;
            color: #a52430;
        }

        /* KARTU DETAIL */

        .detail-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(0, 1fr);
            gap: 30px;
            align-items: stretch;
        }

        .detail-card {
            min-width: 0;
            min-height: 450px;
            padding: 28px 30px;
            background: #fff;
            border-radius: 3px;
            box-shadow: 0 2px 12px rgba(24, 60, 104, .025);
        }

        .category {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 18px;
            padding: 5px 16px;
            background: #e2f5f7;
            color: #347fa7;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .complaint-title {
            margin-bottom: 20px;
            color: #171717;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .complaint-description {
            margin-bottom: 36px;
            color: #303030;
            font-size: 12px;
            line-height: 1.7;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .complaint-meta {
            display: grid;
            gap: 15px;
            color: #555;
            font-size: 12px;
            line-height: 1.8;
        }

        .complaint-meta strong {
            color: #333;
            font-weight: 600;
        }

        .status-row {
            margin-top: 23px;
            padding-top: 17px;
            border-top: 1px solid #edf1f5;
            font-size: 12px;
        }

        .status-badge {
            display: inline-block;
            margin-top: 7px;
            padding: 6px 12px;
            border-radius: 20px;
            background: #eef2ff;
            color: #4859c3;
            font-weight: 600;
        }

        .status-diajukan {
            background: #f9e8fb;
            color: #a044aa;
        }

        .status-diverifikasi {
            background: #e4f3fb;
            color: #357da5;
        }

        .status-diproses {
            background: #fff4d9;
            color: #98731d;
        }

        .status-ditanggapi {
            background: #f5f0d9;
            color: #89782e;
        }

        .status-selesai {
            background: #e3f7e9;
            color: #258348;
        }

        /* TANGGAPAN ADMIN */

        .response-title {
            margin: 0 0 18px;
            color: #171717;
            font-size: 19px;
            font-weight: 500;
            line-height: 1.6;
        }

        .response-box {
            min-height: 220px;
            padding: 20px;
            background: #fcf5f4;
            color: #555;
            font-size: 13px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .response-empty {
            color: #a5a0a0;
        }

        .response-author {
            margin-top: 18px;
            color: #777;
            font-size: 11px;
            line-height: 1.8;
        }

        .response-history {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 16px;
        }

        .response-history h3 {
            margin-bottom: 12px;
            color: #333;
            font-size: 13px;
        }

        .response-item {
            padding: 12px 0;
            border-bottom: 1px solid #f0eeee;
        }

        .response-item p {
            color: #555;
            font-size: 12px;
            line-height: 1.8;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .response-item small {
            display: block;
            margin-top: 6px;
            color: #999;
            font-size: 10px;
        }

        /* TOMBOL KEMBALI */

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 22px;
            padding: 10px 16px;
            border-radius: 7px;
            background: var(--primary-light);
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .back-link:hover {
            background: var(--primary);
        }

        .dashboard-footer {
            margin-top: auto;
            padding: 20px 25px;
            text-align: center;
            border-top: 1px solid #dfeaf5;
            color: #71839b;
            font-size: 10px;
            line-height: 1.8;
        }

        .sidebar-overlay {
            display: none;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .sidebar {
                width: 270px;
            }

            .main-content {
                margin-left: 270px;
            }

            .brand {
                gap: 8px;
                padding: 16px 12px;
            }

            .brand-image {
                width: 80px;
                height: 80px;
            }

            .brand-title {
                font-size: 22px;
            }

            .content-area {
                padding: 30px 25px;
            }

            .detail-grid {
                gap: 20px;
            }

            .detail-card {
                padding: 24px 20px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: min(300px, 85vw);
                transform: translateX(-100%);
                box-shadow: 5px 0 25px rgba(0, 0, 0, .12);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(12, 34, 60, .45);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: grid;
            }

            .content-area {
                padding: 24px 16px;
                align-items: flex-start;
            }

            .mobile-heading {
                align-items: flex-start;
                margin-bottom: 24px;
            }

            .page-heading h1 {
                font-size: 22px;
            }

            .page-heading p {
                font-size: 11px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .detail-card {
                min-height: 0;
                padding: 24px 20px;
            }

            .complaint-title {
                font-size: 17px;
            }

            .response-title {
                font-size: 18px;
            }

            .response-box {
                min-height: 150px;
                padding: 17px;
            }

            .dashboard-footer {
                padding: 17px 12px;
            }
        }
    </style>
</head>

<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo-siforawa.jpeg') }}"
             alt="Logo SIFORAWA"
             class="brand-image">

        <div>
            <div class="brand-title">SIFORAWA</div>
            <div class="brand-subtitle">Sistem Informasi Aduan Warga</div>
            <div class="brand-location">Kelurahan Cibaduyut</div>
        </div>
    </div>

    <div class="menu-label">MENU UTAMA</div>

    <nav class="sidebar-menu">
        <a href="{{ route('warga.dashboard') }}" class="menu-item">
            <i class="fa-solid fa-house"></i>
            <span>Beranda</span>
        </a>

        <a href="{{ route('warga.pengaduan.create') }}" class="menu-item">
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Buat Pengaduan</span>
        </a>

        <a href="{{ route('warga.pengaduan.index') }}"
           class="menu-item active"
           aria-current="page">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Cek Status Pengaduan</span>
        </a>

        <a href="{{ route('warga.profil') }}" class="menu-item">
            <i class="fa-solid fa-user"></i>
            <span>Profil Saya</span>
        </a>
    </nav>

    <div class="sidebar-illustration-wrapper">
        <img src="{{ asset('images/ilustrasi-sidebar.jpeg') }}"
             alt="Ilustrasi lingkungan perumahan"
             class="sidebar-illustration">
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

<main class="main-content">
    <section class="content-area">
        <div class="content-container">

            <div class="mobile-heading">
                <button class="sidebar-toggle"
                        id="sidebarToggle"
                        type="button"
                        aria-label="Buka menu"
                        aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="page-heading">
                    <h1>Detail Pengaduan</h1>
                    <p>Informasi dan perkembangan pengaduan Anda</p>
                </div>
            </div>

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

            @php
                $status = strtolower($pengaduan->status ?? '');

                $labelStatus = [
                    'diajukan' => 'Diajukan',
                    'diverifikasi' => 'Diverifikasi',
                    'diproses' => 'Diproses',
                    'ditanggapi' => 'Ditanggapi',
                    'selesai' => 'Selesai',
                ];

                $classStatus = [
                    'diajukan' => 'status-diajukan',
                    'diverifikasi' => 'status-diverifikasi',
                    'diproses' => 'status-diproses',
                    'ditanggapi' => 'status-ditanggapi',
                    'selesai' => 'status-selesai',
                ];

                $daftarTanggapan = $pengaduan->tanggapan
                    ->sortByDesc('created_at');
            @endphp

            <div class="detail-grid">

                <!-- INFORMASI PENGADUAN -->
                <article class="detail-card">
                    <span class="category">
                        {{ $pengaduan->jenis_pengaduan ?? 'Jenis tidak tersedia' }}
                    </span>

                    <h2 class="complaint-title">
                        {{ $pengaduan->judul ?? 'Tanpa judul' }}
                    </h2>

                    <div class="complaint-description">{{ $pengaduan->isi_pengaduan ?? '-' }}</div>

                    <div class="complaint-meta">
                        <div>
                            Diajukan oleh:
                            <strong>{{ $pengaduan->user->name ?? Auth::user()->name }}</strong>
                        </div>

                        <div>
                            RT/RW:
                            <strong>{{ $pengaduan->rw ?? '-' }}</strong>
                        </div>

                        <div>
                            Tanggal:
                            <strong>
                                {{ $pengaduan->created_at
                                    ? $pengaduan->created_at->locale('id')->translatedFormat('d F Y H:i')
                                    : '-' }}
                            </strong>
                        </div>

                        <div>
                            Lokasi:
                            <strong>{{ $pengaduan->lokasi_kejadian ?: '-' }}</strong>
                        </div>
                    </div>

                    <div class="status-row">
                        <div>Status Pengaduan</div>
                        <span class="status-badge {{ $classStatus[$status] ?? '' }}">
                            {{ $labelStatus[$status] ?? ucfirst($status ?: 'Belum tersedia') }}
                        </span>
                    </div>
                </article>

                <!-- TANGGAPAN ADMIN -->
                <article class="detail-card">
                    <h2 class="response-title">Tanggapan Admin</h2>

                    <div class="response-box">
                        @if ($tanggapanTerbaru ?? false)
                            {{ $tanggapanTerbaru->tanggapan }}
                        @elseif ($daftarTanggapan->isNotEmpty())
                            {{ $daftarTanggapan->first()->tanggapan }}
                        @else
                            <span class="response-empty">
                                Belum ada tanggapan dari admin. Silakan periksa kembali nanti.
                            </span>
                        @endif
                    </div>

                    @if (($tanggapanTerbaru ?? null) && $tanggapanTerbaru->user)
                        <div class="response-author">
                            Diberikan oleh: {{ $tanggapanTerbaru->user->name }}
                            @if ($tanggapanTerbaru->created_at)
                                <br>
                                {{ $tanggapanTerbaru->created_at->locale('id')->translatedFormat('d F Y H:i') }}
                            @endif
                        </div>
                    @endif

                    @if ($daftarTanggapan->count() > 1)
                        <div class="response-history">
                            <h3>Riwayat Tanggapan</h3>

                            @foreach ($daftarTanggapan as $itemTanggapan)
                                <div class="response-item">
                                    <p>{{ $itemTanggapan->tanggapan }}</p>

                                    <small>
                                        {{ $itemTanggapan->user->name ?? 'Admin' }}
                                        &bull;
                                        {{ $itemTanggapan->created_at
                                            ? $itemTanggapan->created_at->locale('id')->translatedFormat('d F Y H:i')
                                            : '-' }}
                                    </small>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </article>

            </div>

            <a href="{{ route('warga.pengaduan.index') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Daftar Pengaduan
            </a>

        </div>
    </section>

    <footer class="dashboard-footer">
        &copy; {{ date('Y') }} Kelurahan Cibaduyut.
        SIFORAWA — Sistem Informasi Aduan Warga.
    </footer>
</main>

<script>
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
</script>

</body>
</html>
