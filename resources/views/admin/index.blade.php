
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pengaduan Admin - SIFORAWA</title>

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

        button, input {
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
            box-shadow: 2px 0 12px rgba(24,60,104,.06);
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
            background: rgba(255,255,255,.45);
        }

        .menu-item.active {
            background: rgba(255,255,255,.58);
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
            padding: 60px 42px 30px;
        }

        .content-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-heading {
            margin-bottom: 26px;
        }

        .page-heading h1 {
            margin-bottom: 8px;
            color: var(--purple);
            font-size: 28px;
            font-weight: 700;
        }

        .page-heading p {
            color: #303b4b;
            font-size: 13px;
        }

        .mobile-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-toggle {
            display: none;
        }

        /* SEARCH */
        .table-toolbar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 14px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 240px;
            padding: 9px 12px;
            background: white;
            border: 1px solid #edf2f8;
        }

        .search-box i {
            color: #111;
            font-size: 20px;
        }

        .search-box input {
            width: 100%;
            min-width: 0;
            border: none;
            outline: none;
            background: transparent;
            color: #333;
            font-size: 12px;
        }

        /* TABEL */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .complaint-table {
            width: 100%;
            min-width: 690px;
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 0 20px;
        }

        .complaint-table th {
            padding: 10px;
            background: #e6e3e4;
            color: #242424;
            text-align: left;
            font-size: 13px;
            font-weight: 500;
        }

        .complaint-table td {
            padding: 14px 10px;
            background: white;
            color: #292929;
            font-size: 12px;
            line-height: 1.6;
            overflow-wrap: anywhere;
            vertical-align: middle;
        }

        .complaint-table tbody tr:hover td {
            background: #fcfdff;
        }

        .complaint-table td:first-child,
        .complaint-table th:first-child {
            padding-left: 14px;
        }

        .complaint-table td:first-child {
            font-size: 18px;
        }

        .complaint-table td:last-child,
        .complaint-table th:last-child {
            text-align: center;
        }

        .col-no { width: 7%; }
        .col-judul { width: 25%; }
        .col-jenis { width: 17%; }
        .col-status { width: 15%; }
        .col-tanggal { width: 19%; }
        .col-aksi { width: 17%; }

        .status {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
        }

        .status-diajukan { color: #bf69c6; }
        .status-diverifikasi { color: #75a9c9; }
        .status-diproses { color: #d5aa3f; }
        .status-ditanggapi { color: #a99a58; }
        .status-selesai { color: #36a960; }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 98px;
            min-height: 34px;
            padding: 7px 14px;
            border-radius: 22px;
            background: #b6dbe1;
            color: #164b99;
            font-size: 11px;
            font-weight: 700;
            transition: background .2s;
        }

        .btn-detail:hover {
            background: #9bcbd5;
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 16px;
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

        .empty-state {
            padding: 45px 20px;
            background: white;
            text-align: center;
        }

        .empty-state i {
            margin-bottom: 12px;
            color: #8db6d9;
            font-size: 38px;
        }

        .empty-state h2 {
            margin-bottom: 8px;
            color: var(--purple);
            font-size: 18px;
        }

        .empty-state p {
            color: #71839b;
            font-size: 12px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 8px;
            font-size: 12px;
        }

        .pagination-wrapper nav {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .pagination-wrapper nav a,
        .pagination-wrapper nav span span {
            display: inline-block;
            padding: 6px 10px;
            border: 1px solid #dce7f2;
            border-radius: 5px;
            background: white;
            color: #315fbd;
        }

        .pagination-wrapper nav span[aria-current="page"] span {
            background: #315fbd;
            color: white;
        }

        .pagination-wrapper svg {
            width: 16px;
            height: 16px;
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
                padding: 40px 24px 25px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: min(300px, 85vw);
                transform: translateX(-100%);
                box-shadow: 5px 0 25px rgba(0,0,0,.12);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(12,34,60,.45);
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
                background: white;
                color: var(--primary);
                cursor: pointer;
            }

            .content-area {
                padding: 25px 18px;
            }

            .page-heading {
                margin-bottom: 0;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .page-heading p {
                font-size: 11px;
            }

            .table-toolbar {
                margin-top: 20px;
            }

            .complaint-table {
                border-spacing: 0 14px;
            }

            .pagination-wrapper {
                justify-content: center;
            }

            .dashboard-footer {
                padding: 17px 15px;
            }
        }

        @media (max-width: 380px) {
            .content-area {
                padding: 22px 12px;
            }

            .page-heading h1 {
                font-size: 20px;
            }

            .sidebar-toggle {
                width: 35px;
                height: 35px;
            }

            .search-box {
                width: 100%;
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

        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>

            <a href="{{ route('admin.pengaduan.index') }}"
               class="menu-item active"
               aria-current="page">
                <i class="fa-solid fa-folder-open"></i>
                <span>Pengaduan</span>
            </a>

            {{-- Sesuaikan nama route ini dengan web.php jika berbeda --}}
            <a href="{{ route('admin.riwayat.index') }}" class="menu-item">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Riwayat Pengaduan</span>
            </a>

            {{-- Sesuaikan nama route ini dengan web.php jika berbeda --}}
            <a href="{{ route('admin.profil') }}" class="menu-item">
                <i class="fa-solid fa-user"></i>
                <span>Profil</span>
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
                        <h1>Pengaduan</h1>
                        <p>Lihat dan kelola pengajuan oleh warga.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="table-toolbar">
                    <label class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search"
                               id="searchPengaduan"
                               placeholder="Search..."
                               aria-label="Cari pengaduan">
                    </label>
                </div>

                @if ($pengaduan->count() > 0)
                    @php
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
                    @endphp

                    <div class="table-wrapper">
                        <table class="complaint-table">
                            <colgroup>
                                <col class="col-no">
                                <col class="col-judul">
                                <col class="col-jenis">
                                <col class="col-status">
                                <col class="col-tanggal">
                                <col class="col-aksi">
                            </colgroup>

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Pengajuan</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody id="daftarPengaduan">
                                @foreach ($pengaduan as $item)
                                    @php
                                        $status = strtolower($item->status ?? 'diajukan');
                                    @endphp

                                    <tr>
                                        <td>{{ $pengaduan->firstItem() + $loop->index }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->jenis_pengaduan }}</td>
                                        <td>
                                            <span class="status {{ $classStatus[$status] ?? '' }}">
                                                {{ $labelStatus[$status] ?? ucfirst($status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $item->created_at
                                                ? $item->created_at->locale('id')->translatedFormat('d F Y')
                                                : '-' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.pengaduan.show', $item->id) }}"
                                               class="btn-detail">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($pengaduan->hasPages())
                        <div class="pagination-wrapper">
                            {{ $pengaduan->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <h2>Belum Ada Pengaduan</h2>
                        <p>Belum ada pengaduan warga yang masuk ke sistem.</p>
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
            sidebar.classList.contains('open') ? tutupSidebar() : bukaSidebar();
        });

        sidebarOverlay.addEventListener('click', tutupSidebar);

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') tutupSidebar();
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) tutupSidebar();
        });

        // Pencarian pada data yang sedang tampil di tabel.
        const searchInput = document.getElementById('searchPengaduan');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();

            document.querySelectorAll('#daftarPengaduan tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(keyword)
                    ? ''
                    : 'none';
            });
        });
    </script>

</body>
</html>