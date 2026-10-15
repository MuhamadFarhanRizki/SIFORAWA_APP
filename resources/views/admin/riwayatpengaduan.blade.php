<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Riwayat Pengaduan - SIFORAWA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary: #164b99;
            --purple: #4859c3;
            --sidebar-bg: #c5e0f1;
            --page-bg: #eff7ff;
            --text: #183c68;
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

        button,
        input {
            font: inherit;
        }

        a {
            text-decoration: none;
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
            flex-shrink: 0;
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

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
            padding: 18px 12px;
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
            margin-top: auto;
            width: 100%;
            min-height: 175px;
            overflow: hidden;
            flex-shrink: 0;
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
            flex-shrink: 0;
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

        /* KONTEN UTAMA */
        .main-content {
            margin-left: 310px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-area {
            flex: 1;
            width: 100%;
            padding: 42px 30px 30px 42px;
        }

        .content-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .mobile-heading {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 27px;
        }

        .sidebar-toggle {
            display: none;
        }

        .heading-content {
            min-width: 0;
        }

        .page-title {
            color: var(--purple);
            font-size: 29px;
            line-height: 1.4;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .page-description {
            font-size: 13px;
            color: #3e454e;
            line-height: 1.8;
        }

        /* PENCARIAN */
        .table-toolbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 14px;
        }

        .search-form {
            width: 225px;
            height: 43px;
            display: flex;
            align-items: center;
            background: #fff;
        }

        .search-form button {
            width: 47px;
            height: 100%;
            flex-shrink: 0;
            border: none;
            background: #fff;
            color: #080808;
            font-size: 26px;
            cursor: pointer;
        }

        .search-form input {
            width: 100%;
            min-width: 0;
            height: 100%;
            border: none;
            outline: none;
            padding: 0 9px 0 4px;
            font-family: inherit;
            font-size: 13px;
            background: transparent;
        }

        .search-form input:focus {
            outline: 2px solid #b9d8f4;
            outline-offset: -2px;
        }

        /* TABEL RIWAYAT */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .complaint-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 18px;
            table-layout: fixed;
        }

        .complaint-table thead th {
            background: #e4e0e1;
            padding: 7px 10px;
            font-size: 14px;
            font-weight: 500;
            text-align: left;
            line-height: 1.5;
        }

        .complaint-table thead th:first-child {
            width: 14%;
        }

        .complaint-table thead th:nth-child(2) {
            width: 26%;
        }

        .complaint-table thead th:nth-child(3) {
            width: 22%;
        }

        .complaint-table thead th:nth-child(4) {
            width: 19%;
        }

        .complaint-table thead th:nth-child(5) {
            width: 19%;
        }

        .complaint-table tbody td {
            background: #fff;
            padding: 15px 10px;
            font-size: 12px;
            line-height: 1.65;
            vertical-align: middle;
            overflow-wrap: anywhere;
        }

        .complaint-table tbody td:first-child {
            padding-left: 18px;
            font-size: 20px;
            font-weight: 400;
        }

        .complaint-table tbody td:nth-child(4) {
            color: #55b96b;
            font-weight: 700;
        }

        .complaint-table tbody td:last-child {
            white-space: nowrap;
            font-size: 11px;
        }

        /* PESAN JIKA BELUM ADA RIWAYAT */
        .empty-row td {
            padding: 0 !important;
            background: transparent !important;
        }

        .empty-state {
            background: #fff;
            border-radius: 8px;
            padding: 42px 20px;
            text-align: center;
            color: #637184;
        }

        .empty-state i {
            display: block;
            font-size: 42px;
            color: #77b7dc;
            margin-bottom: 15px;
        }

        .empty-state h2 {
            color: #28598a;
            font-size: 17px;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 13px;
            line-height: 1.8;
        }

        /* PAGINATION */
        .pagination-wrapper {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 6px;
            margin-top: 0;
        }

        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pagination-wrapper svg {
            width: 17px;
            height: 17px;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            min-width: 39px;
            height: 42px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d4d8dd;
            border-radius: 6px;
            background: #fff;
            color: #555;
            text-decoration: none;
            font-family: inherit;
            font-size: 17px;
        }

        .pagination-wrapper [aria-current="page"] span {
            border-color: #999;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .15);
            color: #222;
        }

        .pagination-wrapper [aria-disabled="true"] span {
            color: #aaa;
            background: #f9f9f9;
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

        /* TABLET */
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
                padding: 35px 24px 25px;
            }

            .menu-item {
                gap: 13px;
                font-size: 13px;
            }

            .complaint-table {
                min-width: 650px;
            }
        }

        /* MOBILE */
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
                width: 100%;
                margin-left: 0;
            }

            .sidebar-toggle {
                display: inline-grid;
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

            .content-area {
                padding: 25px 18px;
            }

            .mobile-heading {
                margin-bottom: 28px;
            }

            .page-title {
                font-size: 23px;
            }

            .table-toolbar {
                margin-top: 20px;
            }

            .search-form {
                width: 100%;
                max-width: 300px;
            }

            .complaint-table {
                min-width: 680px;
            }

            .pagination-wrapper {
                margin-top: 8px;
            }

            .dashboard-footer {
                padding: 17px 15px;
            }
        }

        @media (max-width: 380px) {
            .content-area {
                padding: 22px 12px;
            }

            .page-title {
                font-size: 20px;
            }

            .sidebar-toggle {
                width: 35px;
                height: 35px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

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

        <nav class="sidebar-menu">

            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>

            <a href="{{ route('admin.pengaduan.index') }}" class="menu-item">
                <i class="fa-solid fa-folder-open"></i>
                <span>Pengaduan</span>
            </a>

            <a href="{{ route('admin.riwayat.index') }}"
               class="menu-item active"
               aria-current="page">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Riwayat Pengaduan</span>
            </a>

            <a href="{{ route('admin.profil') }}" class="menu-item">
                <i class="fa-solid fa-user"></i>
                <span>Profil</span>
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

    <!-- KONTEN -->
    <main class="main-content">

        <section class="content-area">
            <div class="content-container">

                <div class="mobile-heading">

                    <button
                        class="sidebar-toggle"
                        id="sidebarToggle"
                        type="button"
                        aria-label="Buka menu"
                        aria-expanded="false"
                    >
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div class="heading-content">
                        <h1 class="page-title">Riwayat Pengaduan</h1>

                        <p class="page-description">
                            Berikut Riwayat Pengaduan Warga
                        </p>
                    </div>

                </div>

                <!-- PENCARIAN -->
                <div class="table-toolbar">

                    <form
                        action="{{ route('admin.riwayat.index') }}"
                        method="GET"
                        class="search-form"
                    >
                        <button type="submit" aria-label="Cari pengaduan">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                        <input
                            type="search"
                            name="search"
                            placeholder="Search..."
                            value="{{ $cari }}"
                            aria-label="Cari judul atau jenis pengaduan"
                        >
                    </form>

                </div>

                <!-- TABEL RIWAYAT PENGADUAN SELESAI -->
                <div class="table-wrapper">

                    <table class="complaint-table">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengajuan</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($pengaduan as $item)
                                <tr>
                                    <td>
                                        {{ $pengaduan->firstItem() + $loop->index }}
                                    </td>

                                    <td>{{ $item->judul }}</td>

                                    <td>{{ $item->jenis_pengaduan }}</td>

                                    <td>Selesai</td>

                                    <td>
                                        {{ $item->updated_at
                                            ? $item->updated_at->locale('id')->translatedFormat('d F Y')
                                            : ($item->created_at
                                                ? $item->created_at->locale('id')->translatedFormat('d F Y')
                                                : '-') }}
                                    </td>
                                </tr>

                            @empty
                                <tr class="empty-row">
                                    <td colspan="5">

                                        <div class="empty-state">
                                            <i class="fa-regular fa-clipboard"></i>

                                            <h2>Belum Ada Riwayat Pengaduan</h2>

                                            <p>
                                                Saat ini belum ada pengaduan yang selesai.
                                                Silakan pantau pengaduan yang sedang diproses.
                                            </p>
                                        </div>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                @if ($pengaduan->hasPages())
                    <div class="pagination-wrapper">
                        {{ $pengaduan->onEachSide(1)->links() }}
                    </div>
                @endif

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

            if (sidebarToggle) {
                sidebarToggle.setAttribute('aria-expanded', 'true');
            }

            document.body.style.overflow = 'hidden';
        }

        function tutupSidebar() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('show');

            if (sidebarToggle) {
                sidebarToggle.setAttribute('aria-expanded', 'false');
            }

            document.body.style.overflow = '';
        }

        sidebarToggle?.addEventListener('click', function () {
            if (sidebar.classList.contains('open')) {
                tutupSidebar();
            } else {
                bukaSidebar();
            }
        });

        sidebarOverlay?.addEventListener('click', tutupSidebar);

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
