<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Pengaduan - SIFORAWA</title>

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
            --button: #4844ee;
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

        button, select, textarea {
            font: inherit;
        }

        a {
            text-decoration: none;
        }

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
            transition: background .2s;
        }

        .logout-button:hover {
            background: #bb2534;
        }

        .main-content {
            margin-left: 310px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-area {
            flex: 1;
            width: 100%;
            padding: 42px 42px 30px;
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
            margin-bottom: 46px;
        }

        .sidebar-toggle {
            display: none;
        }

        .heading-content {
            min-width: 0;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 120px;
            min-height: 28px;
            padding: 5px 16px;
            margin-bottom: 7px;
            border-radius: 20px;
            background: #dff5f8;
            color: #3977b6;
            font-size: 11px;
            font-weight: 600;
            transition: background .2s;
        }

        .back-button:hover {
            background: #c9ebf0;
        }

        .page-title {
            color: var(--purple);
            font-size: 29px;
            line-height: 1.4;
            font-weight: 700;
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 18px;
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

        .detail-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(280px, .95fr);
            gap: 26px;
            align-items: start;
        }

        .detail-card,
        .form-card {
            background: #ffffff;
        }

        .detail-card {
            min-height: 455px;
            padding: 25px 30px;
        }

        .category-label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 17px;
            padding: 5px 17px;
            background: #dff5f8;
            color: #3977b6;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            overflow-wrap: anywhere;
        }

        .complaint-title {
            margin-bottom: 17px;
            color: #161616;
            font-size: 21px;
            font-weight: 700;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .complaint-description {
            margin-bottom: 22px;
            color: #4a4a4a;
            font-size: 12px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .detail-meta {
            display: flex;
            flex-direction: column;
            gap: 13px;
            margin-top: 24px;
            color: #555;
            font-size: 12px;
            line-height: 1.8;
        }

        .detail-meta strong {
            color: #444;
            font-weight: 500;
        }

        .detail-meta i {
            width: 17px;
            color: #75a9c9;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 18px;
            min-width: 0;
        }

        .form-card {
            padding: 24px;
        }

        .form-card h2 {
            margin-bottom: 17px;
            color: #171717;
            font-size: 19px;
            font-weight: 600;
        }

        .status-select {
            display: block;
            width: 100%;
            min-height: 44px;
            margin-bottom: 20px;
            padding: 10px 13px;
            border: 1px solid transparent;
            border-radius: 4px;
            outline: none;
            background: #fcf4f3;
            color: #454545;
            font-size: 13px;
            cursor: pointer;
        }

        .status-select:focus {
            border-color: #8bb7e4;
        }

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 42px;
            padding: 9px 14px;
            border: none;
            border-radius: 0;
            background: var(--button);
            color: #ffffff;
            font-size: 17px;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: #3632d2;
        }

        .response-textarea {
            display: block;
            width: 100%;
            min-height: 100px;
            margin-bottom: 14px;
            padding: 14px;
            resize: vertical;
            border: 1px solid transparent;
            border-radius: 3px;
            outline: none;
            background: #fcf4f3;
            color: #454545;
            font-size: 12px;
            line-height: 1.7;
        }

        .response-textarea:focus {
            border-color: #8bb7e4;
        }

        .response-textarea::placeholder {
            color: #aaa;
        }

        .validation-message {
            margin-top: -8px;
            margin-bottom: 13px;
            color: #c62828;
            font-size: 11px;
        }

        .response-history {
            margin-top: 22px;
            padding-top: 17px;
            border-top: 1px solid #edf1f6;
        }

        .response-history h3 {
            margin-bottom: 12px;
            color: #292929;
            font-size: 14px;
            font-weight: 600;
        }

        .response-item {
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 5px;
            background: #f5f9fd;
        }

        .response-item p {
            color: #4b5563;
            font-size: 12px;
            line-height: 1.8;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .response-item .response-author {
            margin-bottom: 5px;
            color: #315fbd;
            font-size: 11px;
            font-weight: 600;
        }

        .response-item .response-date {
            margin-top: 7px;
            color: #8995a4;
            font-size: 10px;
        }

        .no-response {
            color: #8995a4;
            font-size: 11px;
            line-height: 1.8;
        }

        /* TAMBAHAN TOMBOL EDIT DAN HAPUS */
        .response-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .btn-edit,
        .btn-delete,
        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 7px 12px;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 11px;
            cursor: pointer;
        }

        .btn-edit {
            background: #e6a23c;
        }

        .btn-edit:hover {
            background: #c88722;
        }

        .btn-delete {
            background: #dc3545;
        }

        .btn-delete:hover {
            background: #bb2534;
        }

        .btn-cancel {
            width: 100%;
            margin-top: 8px;
            background: #718096;
        }

        .edit-indicator {
            display: none;
            margin-bottom: 10px;
            padding: 9px 11px;
            border-radius: 5px;
            background: #fff4d6;
            color: #805b10;
            font-size: 11px;
        }

        .edit-indicator.show {
            display: block;
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
                padding: 35px 24px 25px;
            }

            .detail-layout {
                grid-template-columns: minmax(0, 1fr) minmax(250px, .9fr);
                gap: 18px;
            }

            .detail-card {
                padding: 22px;
            }

            .form-card {
                padding: 20px;
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
                background: #ffffff;
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

            .detail-layout {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .detail-card {
                min-height: auto;
                padding: 22px;
            }

            .complaint-title {
                font-size: 19px;
            }

            .right-column {
                gap: 18px;
            }

            .form-card {
                padding: 20px;
            }

            .form-card h2 {
                font-size: 18px;
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

            .detail-card,
            .form-card {
                padding: 16px;
            }

            .complaint-title {
                font-size: 17px;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

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

            <a href="{{ route('admin.pengaduan.index') }}"
               class="menu-item active"
               aria-current="page">
                <i class="fa-solid fa-folder-open"></i>
                <span>Pengaduan</span>
            </a>

            <a href="{{ route('admin.riwayat.index') }}" class="menu-item">
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
                        <a href="{{ route('admin.pengaduan.index') }}"
                           class="back-button">
                            Kembali...
                        </a>
                        <h1 class="page-title">Detail Pengaduan</h1>
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

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Periksa kembali data berikut:</strong>
                        <ul style="padding-left: 20px; margin-top: 5px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="detail-layout">

                    <article class="detail-card">
                        <div class="category-label">
                            {{ $pengaduan->jenis_pengaduan }}
                        </div>

                        <h2 class="complaint-title">
                            {{ $pengaduan->judul }}
                        </h2>

                        <div class="complaint-description">{{ $pengaduan->isi_pengaduan }}</div>

                        <div class="detail-meta">
                            <div>
                                <i class="fa-solid fa-user"></i>
                                <strong>Diajukan oleh:</strong>
                                {{ $pengaduan->user?->name ?? 'Pengguna' }}
                            </div>

                            <div>
                                <i class="fa-solid fa-location-dot"></i>
                                <strong>RW:</strong>
                                {{ $pengaduan->rw ?? '-' }}
                            </div>

                            <div>
                                <i class="fa-regular fa-calendar"></i>
                                <strong>Tanggal:</strong>
                                @if ($pengaduan->created_at)
                                    {{ $pengaduan->created_at->locale('id')->translatedFormat('d F Y H:i') }}
                                @else
                                    -
                                @endif
                            </div>

                            <div>
                                <i class="fa-solid fa-map-location-dot"></i>
                                <strong>Lokasi:</strong>
                                {{ filled($pengaduan->lokasi_kejadian) ? $pengaduan->lokasi_kejadian : '-' }}
                            </div>

                            <div>
                                <i class="fa-solid fa-circle-info"></i>
                                <strong>Status saat ini:</strong>
                                {{ ucfirst($pengaduan->status ?? 'diajukan') }}
                            </div>
                        </div>
                    </article>

                    <div class="right-column">

                        <!-- FORM UBAH STATUS -->
                        <section class="form-card">
                            <h2>Ubah Status</h2>

                            <form
                                action="{{ route('admin.pengaduan.update', $pengaduan->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PATCH')

                                <select
                                    name="status"
                                    class="status-select"
                                    required
                                    aria-label="Pilih status pengaduan"
                                >
                                    @foreach ($statusPengaduan as $status)
                                        <option
                                            value="{{ $status }}"
                                            @selected(old('status', $pengaduan->status) === $status)
                                        >
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn-primary">
                                    Simpan
                                </button>
                            </form>
                        </section>

                        <!-- FORM TAMBAH DAN EDIT TANGGAPAN -->
                        <section class="form-card">
                            <h2 id="responseFormTitle">Tanggapan Admin</h2>

                            <div class="edit-indicator" id="editIndicator">
                                <i class="fa-solid fa-pen"></i>
                                Mode edit tanggapan. Ubah isi di bawah, lalu klik Simpan Perubahan.
                            </div>

                            <form
                                id="responseForm"
                                action="{{ route('admin.pengaduan.tanggapan.store', $pengaduan->id) }}"
                                method="POST"
                            >
                                @csrf
                                <input type="hidden" name="_method" id="responseMethod" value="POST">

                                <textarea
                                    id="responseTextarea"
                                    name="tanggapan"
                                    class="response-textarea"
                                    placeholder="Tulis tanggapan untuk warga..."
                                    required
                                    rows="4"
                                >{{ old('tanggapan') }}</textarea>

                                @error('tanggapan')
                                    <div class="validation-message">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <button type="submit" class="btn-primary" id="responseSubmitButton">
                                    Kirim Tanggapan
                                </button>

                                <button
                                    type="button"
                                    class="btn-cancel"
                                    id="cancelEditButton"
                                    style="display:none;"
                                    onclick="batalEditTanggapan()"
                                >
                                    <i class="fa-solid fa-xmark"></i>
                                    Batal Edit
                                </button>
                            </form>

                            <!-- RIWAYAT TANGGAPAN -->
                            <div class="response-history">
                                <h3>Riwayat Tanggapan</h3>

                                @php
                                    $daftarTanggapan = $pengaduan->daftarTanggapan
                                        ?? $pengaduan->tanggapan
                                        ?? collect();
                                @endphp

                                @forelse ($daftarTanggapan->sortByDesc('created_at') as $itemTanggapan)
                                    <div class="response-item">
                                        <div class="response-author">
                                            {{ $itemTanggapan->user?->name ?? 'Admin' }}
                                        </div>

                                        <p>{{ $itemTanggapan->tanggapan }}</p>

                                        <div class="response-date">
                                            @if ($itemTanggapan->created_at)
                                                {{ $itemTanggapan->created_at->locale('id')->translatedFormat('d F Y H:i') }}
                                            @endif
                                        </div>

                                        <div class="response-actions">
                                            <button
                                                type="button"
                                                class="btn-edit"
                                                data-response="{{ $itemTanggapan->tanggapan }}"
                                                data-update-url="{{ route('admin.pengaduan.tanggapan.update', [$pengaduan->id, $itemTanggapan->id]) }}"
                                                onclick="editTanggapan(this)"
                                            >
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </button>

                                            <form
                                                action="{{ route('admin.pengaduan.tanggapan.destroy', [$pengaduan->id, $itemTanggapan->id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus tanggapan ini?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn-delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <p class="no-response">
                                        Belum ada tanggapan untuk pengaduan ini.
                                    </p>
                                @endforelse
                            </div>
                        </section>

                    </div>
                </div>
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

        /* TAMBAHAN: EDIT TANGGAPAN */
        const responseForm = document.getElementById('responseForm');
        const responseTextarea = document.getElementById('responseTextarea');
        const responseMethod = document.getElementById('responseMethod');
        const responseFormTitle = document.getElementById('responseFormTitle');
        const responseSubmitButton = document.getElementById('responseSubmitButton');
        const cancelEditButton = document.getElementById('cancelEditButton');
        const editIndicator = document.getElementById('editIndicator');

        const createResponseUrl = @json(route('admin.pengaduan.tanggapan.store', $pengaduan->id));

        function editTanggapan(button) {
            const isiTanggapan = button.dataset.response;
            const updateUrl = button.dataset.updateUrl;

            if (!updateUrl) {
                alert('URL edit tanggapan tidak ditemukan.');
                return;
            }

            responseForm.action = updateUrl;
            responseMethod.value = 'PUT';
            responseTextarea.value = isiTanggapan;

            responseFormTitle.textContent = 'Edit Tanggapan Admin';
            responseSubmitButton.innerHTML =
                '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan';

            cancelEditButton.style.display = 'flex';
            editIndicator.classList.add('show');

            responseTextarea.focus();
            responseForm.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function batalEditTanggapan() {
            responseForm.action = createResponseUrl;
            responseMethod.value = 'POST';
            responseTextarea.value = '';

            responseFormTitle.textContent = 'Tanggapan Admin';
            responseSubmitButton.textContent = 'Kirim Tanggapan';

            cancelEditButton.style.display = 'none';
            editIndicator.classList.remove('show');
        }
    </script>

</body>
</html>
