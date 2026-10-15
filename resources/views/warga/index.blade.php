<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cek Status Pengaduan - SIFORAWA</title>

    <!-- FONT POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>

        :root {
            --primary: #164b99;
            --primary-light: #315fbd;
            --purple: #4859c3;
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

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            text-decoration: none;
        }


        /* =====================================
           SIDEBAR
        ===================================== */

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
            cursor: pointer;
            transition: background .2s;
        }

        .logout-button:hover {
            background: #bb2534;
        }


        /* =====================================
           KONTEN UTAMA
        ===================================== */

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
        }

        .content-container {
            width: 100%;
            max-width: 1050px;
            margin: 0 auto;
        }


        /* =====================================
           JUDUL HALAMAN
        ===================================== */

        .page-heading {
            margin-bottom: 58px;
        }

        .page-heading h1 {
            margin-bottom: 9px;
            color: #4859c3;
            font-size: 28px;
            font-weight: 700;
            line-height: 1.4;
        }

        .page-heading p {
            color: #303b4b;
            font-size: 13px;
            line-height: 1.8;
        }


        /* =====================================
           NOTIFIKASI
        ===================================== */

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


        /* =====================================
           TABEL CEK STATUS PENGADUAN
        ===================================== */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .complaint-table {
            width: 100%;
            min-width: 760px;
            border-collapse: separate;
            border-spacing: 0 20px;
            table-layout: fixed;
        }

        .complaint-table thead th {
            background: #e6e3e4;
            color: #242424;
            padding: 10px 10px;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.5;
            text-align: left;
        }

        .complaint-table thead th:first-child {
            padding-left: 14px;
        }

        .complaint-table tbody td {
            background: #ffffff;
            color: #292929;
            padding: 15px 10px;
            font-size: 12px;
            font-weight: 400;
            line-height: 1.6;
            vertical-align: middle;
            overflow-wrap: break-word;
        }

        .complaint-table tbody td:first-child {
            padding-left: 14px;
            font-size: 19px;
            font-weight: 500;
        }

        .complaint-table tbody td:last-child {
            text-align: center;
        }

        .complaint-table tbody tr {
            transition: box-shadow .2s;
        }

        .complaint-table tbody tr:hover td {
            background: #fcfdff;
        }


        /* =====================================
           LEBAR MASING-MASING KOLOM
        ===================================== */

        .col-no {
            width: 10%;
        }

        .col-judul {
            width: 24%;
        }

        .col-jenis {
            width: 15%;
        }

        .col-status {
            width: 13%;
        }

        .col-tanggal {
            width: 16%;
        }

        .col-aksi {
            width: 22%;
        }


        /* =====================================
           LABEL STATUS
        ===================================== */

        .status {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.5;
        }

        .status-diajukan {
            color: #bf69c6;
        }

        .status-diverifikasi {
            color: #75a9c9;
        }

        .status-diproses {
            color: #d5aa3f;
        }

        .status-ditanggapi {
            color: #a99a58;
        }

        .status-selesai {
            color: #68c783;
        }


        /* =====================================
           TOMBOL LIHAT
        ===================================== */

        .btn-lihat {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 64px;
            min-height: 34px;
            padding: 7px 13px;
            border: none;
            border-radius: 22px;
            background: var(--orange);
            color: #ffffff;
            font-size: 11px;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .btn-lihat:hover {
            background: #d98225;
            transform: translateY(-1px);
        }


        /* =====================================
           TAMBAHAN TOMBOL AKSI
        ===================================== */

        .aksi-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            flex-wrap: wrap;
        }

        .btn-edit,
        .btn-hapus {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 52px;
            min-height: 34px;
            padding: 7px 10px;
            border: none;
            border-radius: 22px;
            color: #ffffff;
            font-size: 11px;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .btn-edit {
            background: #5578c9;
        }

        .btn-edit:hover {
            background: #3e62b4;
            transform: translateY(-1px);
        }

        .btn-hapus {
            background: #dc3545;
        }

        .btn-hapus:hover {
            background: #bb2534;
            transform: translateY(-1px);
        }

        .form-hapus {
            display: inline-flex;
            margin: 0;
            padding: 0;
        }


        /* =====================================
           DATA KOSONG
        ===================================== */

        .empty-state {
            padding: 45px 20px;
            background: #ffffff;
            text-align: center;
            border-radius: 4px;
        }

        .empty-state i {
            margin-bottom: 15px;
            color: #8db6d9;
            font-size: 42px;
        }

        .empty-state h2 {
            margin-bottom: 8px;
            color: #315fbd;
            font-size: 18px;
            font-weight: 600;
        }

        .empty-state p {
            margin-bottom: 20px;
            color: #71839b;
            font-size: 12px;
            line-height: 1.8;
        }

        .btn-buat {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 18px;
            border-radius: 7px;
            background: #315fbd;
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-buat:hover {
            background: #164b99;
        }


        /* =====================================
           PAGINATION
        ===================================== */

        .pagination-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            font-size: 12px;
        }

        .pagination-wrapper nav {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .pagination-wrapper nav div:first-child {
            color: #71839b;
        }

        .pagination-wrapper nav div:last-child > span,
        .pagination-wrapper nav div:last-child > a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-wrapper nav a,
        .pagination-wrapper nav span span {
            padding: 6px 10px;
            border: 1px solid #dce7f2;
            border-radius: 5px;
            background: #ffffff;
            color: #315fbd;
        }

        .pagination-wrapper nav span[aria-current="page"] span {
            background: #315fbd;
            color: #ffffff;
        }

        .pagination-wrapper svg {
            width: 16px;
            height: 16px;
        }


        /* =====================================
           FOOTER
        ===================================== */

        .dashboard-footer {
            margin-top: auto;
            padding: 20px 25px;
            text-align: center;
            border-top: 1px solid #dfeaf5;
            color: #71839b;
            font-size: 10px;
            line-height: 1.8;
        }


        /* =====================================
           SIDEBAR MOBILE
        ===================================== */

        .sidebar-overlay {
            display: none;
        }

        .sidebar-toggle {
            display: none;
        }


        /* =====================================
           TABLET
        ===================================== */

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
                padding: 30px 28px 25px;
            }

            .page-heading {
                margin-bottom: 42px;
            }

            .page-heading h1 {
                font-size: 25px;
            }

            .complaint-table {
                min-width: 760px;
            }

            .aksi-wrapper {
                gap: 4px;
            }

            .btn-lihat,
            .btn-edit,
            .btn-hapus {
                min-width: 50px;
                padding-left: 8px;
                padding-right: 8px;
            }
        }


        /* =====================================
           MOBILE
        ===================================== */

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

            .mobile-heading {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 28px;
            }

            .content-area {
                padding: 25px 18px 25px;
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

            .complaint-table {
                min-width: 760px;
                border-spacing: 0 14px;
            }

            .complaint-table thead th {
                padding: 10px 8px;
                font-size: 12px;
            }

            .complaint-table tbody td {
                padding: 12px 8px;
                font-size: 11px;
            }

            .complaint-table tbody td:first-child {
                padding-left: 12px;
                font-size: 16px;
            }

            .status {
                font-size: 11px;
            }

            .btn-lihat,
            .btn-edit,
            .btn-hapus {
                min-width: 48px;
                min-height: 32px;
                padding: 6px 8px;
                font-size: 10px;
            }

            .aksi-wrapper {
                gap: 4px;
            }

            .pagination-wrapper {
                justify-content: center;
            }

            .dashboard-footer {
                padding: 17px 15px;
                font-size: 9px;
            }
        }


        @media (min-width: 769px) {

            .mobile-heading {
                display: block;
            }
        }


        @media (max-width: 380px) {

            .content-area {
                padding: 22px 12px;
            }

            .page-heading h1 {
                font-size: 20px;
            }

            .page-heading p {
                font-size: 10px;
            }

            .mobile-heading {
                gap: 8px;
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


    <!-- OVERLAY SIDEBAR MOBILE -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>


    <!-- =====================================
         SIDEBAR SIFORAWA
    ====================================== -->

    <aside
        class="sidebar"
        id="sidebar"
    >

        <!-- LOGO DAN IDENTITAS -->

        <div class="brand">

            <img
                src="{{ asset('images/logo-siforawa.jpeg') }}"
                alt="Logo SIFORAWA"
                class="brand-image"
            >

            <div>

                <div class="brand-title">
                    SIFORAWA
                </div>

                <div class="brand-subtitle">
                    Sistem Informasi Aduan Warga
                </div>

                <div class="brand-location">
                    Kelurahan Cibaduyut
                </div>

            </div>

        </div>


        <!-- MENU -->

        <div class="menu-label">
            MENU UTAMA
        </div>


        <nav class="sidebar-menu">


            <!-- BERANDA -->

            <a
                href="{{ route('warga.dashboard') }}"
                class="menu-item"
            >

                <i class="fa-solid fa-house"></i>

                <span>
                    Beranda
                </span>

            </a>


            <!-- BUAT PENGADUAN -->

            <a
                href="{{ route('warga.pengaduan.create') }}"
                class="menu-item"
            >

                <i class="fa-solid fa-file-circle-plus"></i>

                <span>
                    Buat Pengaduan
                </span>

            </a>


            <!-- CEK STATUS PENGADUAN -->

            <a
                href="{{ route('warga.pengaduan.index') }}"
                class="menu-item active"
                aria-current="page"
            >

                <i class="fa-solid fa-clipboard-list"></i>

                <span>
                    Cek Status Pengaduan
                </span>

            </a>


            <!-- PROFIL -->

            <a
                href="{{ route('warga.profil') }}"
                class="menu-item"
            >

                <i class="fa-solid fa-user"></i>

                <span>
                    Profil Saya
                </span>

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

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </button>

            </form>

        </div>


    </aside>


    <!-- =====================================
         KONTEN UTAMA
    ====================================== -->

    <main class="main-content">


        <section class="content-area">


            <div class="content-container">


                <!-- JUDUL HALAMAN -->

                <div class="mobile-heading">


                    <!-- TOMBOL MENU MOBILE -->

                    <button
                        class="sidebar-toggle"
                        id="sidebarToggle"
                        type="button"
                        aria-label="Buka menu"
                        aria-expanded="false"
                    >

                        <i class="fa-solid fa-bars"></i>

                    </button>


                    <div class="page-heading">

                        <h1>
                            Cek Status Pengaduan
                        </h1>

                        <p>
                            Pantau perkembangan pengaduan Anda di sini
                        </p>

                    </div>


                </div>


                <!-- NOTIFIKASI BERHASIL -->

                @if (session('success'))

                    <div class="alert alert-success">

                        <i class="fa-solid fa-circle-check"></i>

                        {{ session('success') }}

                    </div>

                @endif


                <!-- NOTIFIKASI ERROR -->

                @if (session('error'))

                    <div class="alert alert-error">

                        <i class="fa-solid fa-circle-exclamation"></i>

                        {{ session('error') }}

                    </div>

                @endif


                <!-- =====================================
                     TABEL PENGADUAN
                ====================================== -->

                @if ($pengaduan->count() > 0)


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

                                    <th>
                                        No
                                    </th>

                                    <th>
                                        Judul Pengaduan
                                    </th>

                                    <th>
                                        Jenis
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Tanggal
                                    </th>

                                    <th>
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                                @foreach ($pengaduan as $item)


                                    @php

                                        $status = strtolower(
                                            $item->status ?? ''
                                        );

                                        $labelStatus = [

                                            'diajukan' =>
                                                'Diajukan',

                                            'diverifikasi' =>
                                                'Diverifikasi',

                                            'diproses' =>
                                                'Diproses',

                                            'ditanggapi' =>
                                                'Ditanggapi',

                                            'selesai' =>
                                                'Selesai',

                                        ];


                                        $classStatus = [

                                            'diajukan' =>
                                                'status-diajukan',

                                            'diverifikasi' =>
                                                'status-diverifikasi',

                                            'diproses' =>
                                                'status-diproses',

                                            'ditanggapi' =>
                                                'status-ditanggapi',

                                            'selesai' =>
                                                'status-selesai',

                                        ];

                                    @endphp


                                    <tr>


                                        <!-- NOMOR -->

                                        <td>

                                            {{ $pengaduan->firstItem() + $loop->index }}

                                        </td>


                                        <!-- JUDUL -->

                                        <td>

                                            {{ $item->judul }}

                                        </td>


                                        <!-- JENIS -->

                                        <td>

                                            {{ $item->jenis_pengaduan }}

                                        </td>


                                        <!-- STATUS -->

                                        <td>

                                            <span
                                                class="status {{ $classStatus[$status] ?? '' }}"
                                            >

                                                {{ $labelStatus[$status] ?? ucfirst($status) }}

                                            </span>

                                        </td>


                                        <!-- TANGGAL -->

                                        <td>

                                            @if ($item->created_at)

                                                {{ $item->created_at
                                                    ->locale('id')
                                                    ->translatedFormat('d F Y')
                                                }}

                                            @else

                                                -

                                            @endif

                                        </td>


                                        <!-- =====================================
                                             AKSI
                                        ====================================== -->

                                        <td>

                                            <div class="aksi-wrapper">


                                                <!-- LIHAT -->

                                                <a
                                                    href="{{ route('warga.pengaduan.show', $item->id) }}"
                                                    class="btn-lihat"
                                                >

                                                    Lihat

                                                </a>


                                                <!-- EDIT -->

                                                <a
                                                    href="{{ route('warga.pengaduan.edit', $item->id) }}"
                                                    class="btn-edit"
                                                >

                                                    Edit

                                                </a>


                                                <!-- HAPUS -->

                                                <form
                                                    action="{{ route('warga.pengaduan.destroy', $item->id) }}"
                                                    method="POST"
                                                    class="form-hapus"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini? Data pengaduan dan tanggapan terkait akan dihapus dari database.');"
                                                >

                                                    @csrf

                                                    @method('DELETE')


                                                    <button
                                                        type="submit"
                                                        class="btn-hapus"
                                                    >

                                                        Hapus

                                                    </button>


                                                </form>


                                            </div>

                                        </td>


                                    </tr>


                                @endforeach


                            </tbody>


                        </table>


                    </div>


                    <!-- PAGINATION -->

                    @if ($pengaduan->hasPages())

                        <div class="pagination-wrapper">

                            {{ $pengaduan->links() }}

                        </div>

                    @endif


                @else


                    <!-- =====================================
                         JIKA BELUM ADA PENGADUAN
                    ====================================== -->

                    <div class="empty-state">


                        <i class="fa-solid fa-clipboard-list"></i>


                        <h2>
                            Belum Ada Pengaduan
                        </h2>


                        <p>
                            Anda belum memiliki data pengaduan.
                            Silakan buat pengaduan terlebih dahulu.
                        </p>


                        <a
                            href="{{ route('warga.pengaduan.create') }}"
                            class="btn-buat"
                        >

                            <i class="fa-solid fa-plus"></i>

                            Buat Pengaduan

                        </a>


                    </div>


                @endif


            </div>


        </section>


        <!-- FOOTER -->

        <footer class="dashboard-footer">

            &copy; {{ date('Y') }} Kelurahan Cibaduyut.

            SIFORAWA — Sistem Informasi Aduan Warga.

        </footer>


    </main>


    <!-- =====================================
         JAVASCRIPT SIDEBAR MOBILE
    ====================================== -->

    <script>

        const sidebar =
            document.getElementById('sidebar');

        const sidebarToggle =
            document.getElementById('sidebarToggle');

        const sidebarOverlay =
            document.getElementById('sidebarOverlay');


        function bukaSidebar() {

            sidebar.classList.add('open');

            sidebarOverlay.classList.add('show');

            sidebarToggle.setAttribute(
                'aria-expanded',
                'true'
            );

            document.body.style.overflow =
                'hidden';

        }


        function tutupSidebar() {

            sidebar.classList.remove('open');

            sidebarOverlay.classList.remove('show');

            sidebarToggle.setAttribute(
                'aria-expanded',
                'false'
            );

            document.body.style.overflow =
                '';

        }


        sidebarToggle.addEventListener(
            'click',
            function () {

                if (
                    sidebar.classList.contains('open')
                ) {

                    tutupSidebar();

                } else {

                    bukaSidebar();

                }

            }
        );


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

    </script>


</body>

</html>