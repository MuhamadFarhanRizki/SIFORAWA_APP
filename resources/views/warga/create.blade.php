<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ isset($pengaduan) ? 'Edit Pengaduan' : 'Buat Pengaduan' }} - SIFORAWA
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary: #164b99;
            --primary-light: #315fbd;
            --purple: #7f8ed7;
            --sidebar-bg: #c5e0f1;
            --page-bg: #eff7ff;
            --input-bg: #fffafa;
            --text: #183c68;
            --danger: #dc3545;
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

        button, input, select, textarea {
            font: inherit;
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
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
            position: absolute;
            inset: auto 10px 10px;
            padding: 8px;
            background: rgba(255, 255, 255, .87);
            border-radius: 8px;
            text-align: center;
            font-size: 10px;
            color: #174982;
        }

        .sidebar-caption i {
            color: #e95b69;
            margin-right: 4px;
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

        /* MAIN CONTENT */

        .main-content {
            margin-left: 310px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HAMBURGER MOBILE
           HANYA MUNCUL DI MOBILE */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 14px;
            left: 14px;
            z-index: 1002;
            width: 42px;
            height: 42px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: #ffffff;
            color: var(--primary);
            cursor: pointer;
            font-size: 19px;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(24, 60, 104, .08);
        }

        .sidebar-toggle:hover {
            background: #f3f8fd;
        }

        /* FORM PENGADUAN */

        .content-area {
            flex: 1;
            width: 100%;
            padding: 36px 48px 20px;
        }

        .form-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .form-heading h1 {
            margin-bottom: 9px;
            color: #4859c3;
            font-size: 28px;
            font-weight: 700;
        }

        .form-heading p {
            color: #45546a;
            font-size: 13px;
            line-height: 1.8;
        }

        .alert {
            padding: 13px 16px;
            margin-bottom: 20px;
            border-radius: 9px;
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

        .alert ul {
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-label {
            display: block;
            margin: 0 0 8px 4px;
            font-size: 12px;
            font-weight: 500;
            color: #35475e;
        }

        .form-control {
            width: 100%;
            min-height: 49px;
            padding: 13px 17px;
            border: 1px solid transparent;
            border-radius: 2px;
            background: var(--input-bg);
            color: #273648;
            font-size: 14px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control::placeholder {
            color: #7c7c7c;
            opacity: 1;
        }

        .form-control:focus {
            border-color: #8798e0;
            box-shadow: 0 0 0 3px rgba(127, 142, 215, .14);
        }

        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            padding-right: 48px;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: "\f078";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border: 1.5px solid #242424;
            border-radius: 5px;
            color: #222;
            font-size: 15px;
            pointer-events: none;
        }

        textarea.form-control {
            min-height: 145px;
            resize: vertical;
            line-height: 1.8;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .field-error {
            margin: 6px 4px 0;
            color: #d12e3e;
            font-size: 11px;
        }

        .form-actions {
            margin-top: 31px;
        }

        .submit-button {
            width: 100%;
            min-height: 53px;
            padding: 13px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: none;
            border-radius: 2px;
            background: var(--purple);
            color: #101d42;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .submit-button:hover {
            background: #6d7dce;
        }

        .submit-button:active {
            transform: scale(.99);
        }

        .submit-button:disabled {
            opacity: .7;
            cursor: wait;
        }

        /* TOMBOL BATAL EDIT */

        .cancel-button {
            width: 100%;
            min-height: 53px;
            margin-top: 12px;
            padding: 13px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: 1px solid #dce7f2;
            border-radius: 2px;
            background: #ffffff;
            color: #53677f;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, color .2s, border-color .2s;
        }

        .cancel-button:hover {
            background: #f3f7fb;
            color: #dc3545;
            border-color: #dc3545;
        }

        .form-note {
            margin-top: 12px;
            text-align: center;
            color: #78869b;
            font-size: 10px;
        }

        /* FOOTER */

        .dashboard-footer {
            margin-top: auto;
            padding: 20px 25px;
            text-align: center;
            border-top: 1px solid #dfeaf5;
            color: #71839b;
            font-size: 10px;
            line-height: 1.8;
        }

        /* OVERLAY MOBILE */

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
                padding: 30px 28px 20px;
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

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(12, 34, 60, .45);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            /* HAMBURGER HANYA DI MOBILE */
            .sidebar-toggle {
                display: flex;
            }

            .content-area {
                padding: 27px 18px 25px;
            }

            .form-heading {
                margin-bottom: 23px;
            }

            .form-heading h1 {
                font-size: 24px;
            }

            .form-heading p {
                font-size: 12px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-control {
                min-height: 47px;
                font-size: 13px;
            }

            textarea.form-control {
                min-height: 135px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .submit-button {
                min-height: 50px;
                font-size: 14px;
            }

            .cancel-button {
                min-height: 50px;
                font-size: 14px;
            }

            .dashboard-footer {
                padding: 17px 15px;
                font-size: 9px;
            }
        }

        @media (max-width: 380px) {

            .content-area {
                padding: 23px 13px;
            }

            .form-heading h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <!-- OVERLAY SIDEBAR MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- HAMBURGER MOBILE -->
    <button
        type="button"
        class="sidebar-toggle"
        id="sidebarToggle"
        aria-label="Buka menu"
        aria-expanded="false"
        aria-controls="sidebar"
    >
        <i class="fa-solid fa-bars"></i>
    </button>

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

        <div class="menu-label">MENU UTAMA</div>

        <nav class="sidebar-menu">

            <a href="{{ route('warga.dashboard') }}"
               class="menu-item">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>

            <a href="{{ route('warga.pengaduan.create') }}"
               class="menu-item active"
               aria-current="page">
                <i class="fa-solid fa-file-circle-plus"></i>
                <span>
                    {{ isset($pengaduan) ? 'Edit Pengaduan' : 'Buat Pengaduan' }}
                </span>
            </a>

            <a href="{{ route('warga.pengaduan.index') }}"
               class="menu-item">
                <i class="fa-solid fa-clipboard-list"></i>
                <span>Cek Status Pengaduan</span>
            </a>

            <a href="{{ route('warga.profil') }}"
               class="menu-item">
                <i class="fa-solid fa-user"></i>
                <span>Profil Saya</span>
            </a>

        </nav>

        <!-- ILUSTRASI PERUMAHAN -->
        <div class="sidebar-illustration-wrapper">
            <img
                src="{{ asset('images/ilustrasi-sidebar.jpeg') }}"
                alt="Ilustrasi lingkungan perumahan"
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

        <!-- FORM CONTENT -->
        <section class="content-area">

            <div class="form-container">

                <div class="form-heading">

                    <h1>
                        {{ isset($pengaduan) ? 'Edit Pengaduan' : 'Buat Pengaduan' }}
                    </h1>

                    <p>
                        {{ isset($pengaduan)
                            ? 'Perbarui informasi pengaduan kamu dengan benar dan lengkap.'
                            : 'Sampaikan laporan atau aduan dengan jelas dan lengkap serta sopan.'
                        }}
                    </p>

                </div>

                <!-- NOTIFIKASI BERHASIL -->
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- NOTIFIKASI VALIDASI -->
                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>
                            <i class="fa-solid fa-circle-exclamation"></i>
                            Pengaduan belum dapat dikirim.
                        </strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM PENGADUAN -->
                <form
                    action="{{ isset($pengaduan)
                        ? route('warga.pengaduan.update', $pengaduan)
                        : route('warga.pengaduan.store') }}"
                    method="POST"
                    id="formPengaduan"
                >

                    @csrf

                    @if (isset($pengaduan))
                        @method('PUT')
                    @endif

                    <!-- JENIS PENGADUAN -->
                    <div class="form-group">

                        <label
                            for="jenis_pengaduan"
                            class="form-label"
                        >
                            Jenis Pengaduan
                        </label>

                        <div class="select-wrapper">

                            <select
                                name="jenis_pengaduan"
                                id="jenis_pengaduan"
                                class="form-control"
                                required
                            >

                                <option value="" disabled
                                    {{ old('jenis_pengaduan', isset($pengaduan) ? $pengaduan->jenis_pengaduan : '') ? '' : 'selected' }}>
                                    Pilih Jenis Pengaduan
                                </option>

                                @foreach ($jenisPengaduan as $jenis)

                                    <option
                                        value="{{ $jenis }}"
                                        {{ old(
                                            'jenis_pengaduan',
                                            isset($pengaduan) ? $pengaduan->jenis_pengaduan : ''
                                        ) === $jenis ? 'selected' : '' }}
                                    >
                                        {{ $jenis }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        @error('jenis_pengaduan')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- JUDUL -->
                    <div class="form-group">

                        <label for="judul" class="form-label">
                            Judul Pengaduan
                        </label>

                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            class="form-control"
                            placeholder="Masukkan Judul Pengaduan"
                            value="{{ old('judul', isset($pengaduan) ? $pengaduan->judul : '') }}"
                            maxlength="255"
                            required
                        >

                        @error('judul')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- ISI PENGADUAN -->
                    <div class="form-group">

                        <label for="isi_pengaduan" class="form-label">
                            Isi Pengaduan
                        </label>

                        <textarea
                            name="isi_pengaduan"
                            id="isi_pengaduan"
                            class="form-control"
                            placeholder="Tulis Pengaduan Anda....."
                            required
                        >{{ old('isi_pengaduan', isset($pengaduan) ? $pengaduan->isi_pengaduan : '') }}</textarea>

                        @error('isi_pengaduan')
                            <div class="field-error">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- RW DAN LOKASI -->
                    <div class="form-row">

                        <!-- DROPDOWN RW -->
                        <div class="form-group">

                            <label for="rw" class="form-label">
                                RT/RW
                            </label>

                            <div class="select-wrapper">

                                <select
                                    name="rw"
                                    id="rw"
                                    class="form-control"
                                    required
                                >

                                    <option value="" disabled
                                        {{ old('rw', isset($pengaduan) ? $pengaduan->rw : '') ? '' : 'selected' }}>
                                        Pilih RT/RW
                                    </option>

                                    @foreach ($pilihanRW as $rw)

                                        <option
                                            value="{{ $rw }}"
                                            {{ old(
                                                'rw',
                                                isset($pengaduan) ? $pengaduan->rw : ''
                                            ) === $rw ? 'selected' : '' }}
                                        >
                                            {{ $rw }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            @error('rw')
                                <div class="field-error">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- LOKASI OPSIONAL -->
                        <div class="form-group">

                            <label
                                for="lokasi_kejadian"
                                class="form-label"
                            >
                                Lokasi/Kejadian (Opsional)
                            </label>

                            <input
                                type="text"
                                name="lokasi_kejadian"
                                id="lokasi_kejadian"
                                class="form-control"
                                placeholder="Contoh: Jl Cibaduyut No 26"
                                value="{{ old(
                                    'lokasi_kejadian',
                                    isset($pengaduan) ? $pengaduan->lokasi_kejadian : ''
                                ) }}"
                            >

                            @error('lokasi_kejadian')
                                <div class="field-error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                    <!-- TOMBOL -->
                    <div class="form-actions">

                        @if (isset($pengaduan))

                            <!-- TOMBOL SIMPAN PERUBAHAN -->
                            <button
                                type="submit"
                                class="submit-button"
                                id="submitButton"
                            >
                                <i class="fa-solid fa-floppy-disk"></i>
                                Simpan Perubahan
                            </button>

                            <!-- TOMBOL BATAL EDIT -->
                            <a
                                href="{{ route('warga.pengaduan.index') }}"
                                class="cancel-button"
                            >
                                <i class="fa-solid fa-xmark"></i>
                                Batal Edit
                            </a>

                            <p class="form-note">
                                Pastikan perubahan pengaduan yang kamu lakukan sudah benar.
                            </p>

                        @else

                            <button
                                type="submit"
                                class="submit-button"
                                id="submitButton"
                            >
                                <i class="fa-solid fa-paper-plane"></i>
                                Kirim Pengajuan
                            </button>

                            <p class="form-note">
                                Pastikan informasi pengaduan yang kamu isi sudah benar sebelum dikirim.
                            </p>

                        @endif

                    </div>

                </form>

            </div>

        </section>

        <!-- FOOTER COPYRIGHT -->
        <footer class="dashboard-footer">
            &copy; {{ date('Y') }} Kelurahan Cibaduyut.
            SIFORAWA — Sistem Informasi Aduan Warga.
        </footer>

    </main>

    <script>
        // SIDEBAR RESPONSIF MOBILE

        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function bukaSidebar() {

            if (!sidebarToggle) return;

            sidebar.classList.add('open');
            sidebarOverlay.classList.add('show');

            sidebarToggle.setAttribute(
                'aria-expanded',
                'true'
            );

            document.body.style.overflow = 'hidden';
        }

        function tutupSidebar() {

            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('show');

            if (sidebarToggle) {

                sidebarToggle.setAttribute(
                    'aria-expanded',
                    'false'
                );

            }

            document.body.style.overflow = '';
        }

        if (sidebarToggle) {

            sidebarToggle.addEventListener(
                'click',
                function () {

                    if (sidebar.classList.contains('open')) {

                        tutupSidebar();

                    } else {

                        bukaSidebar();

                    }

                }
            );

        }

        sidebarOverlay.addEventListener(
            'click',
            tutupSidebar
        );

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {
                    tutupSidebar();
                }

            }
        );

        window.addEventListener(
            'resize',
            function () {

                if (window.innerWidth > 768) {
                    tutupSidebar();
                }

            }
        );

        // PENCEGAHAN KLIK KIRIM BERULANG

        document.getElementById('formPengaduan')
            .addEventListener(
                'submit',
                function () {

                    const button =
                        document.getElementById('submitButton');

                    if (this.checkValidity()) {

                        button.disabled = true;

                        button.innerHTML =
                            @json(isset($pengaduan)
                                ? '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan Perubahan...'
                                : '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim Pengaduan...'
                            );
                    }

                }
            );
    </script>

</body>
</html>