<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - SIFORAWA</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #eaf7ff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .login-container {
            width: 1150px;
            max-width: 100%;
            min-height: auto;
            display: grid;
            grid-template-columns: 48% 52%;
            gap: 15px;
            align-items: center;
        }

        /* BAGIAN KIRI */
        .left-section {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 35px;
        }

        .intro-image,
        .banner-image {
            width: 100%;
            display: block;
            object-fit: contain;
        }

        /* BAGIAN KANAN */
        .right-section {
            background: #fffdfd;
            min-height: 600px;
            padding: 35px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.03);
            border-radius: 8px;
        }

        .title {
            font-size: 30px;
            font-weight: 700;
            font-style: italic;
            color: #1767b1;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 16px;
            color: #333;
            margin-bottom: 28px;
        }

        /* PILIH ROLE */
        .role-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }

        .role-button {
            border: 1px solid transparent;
            background: #fafafa;
            cursor: pointer;
            height: 160px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: 0.2s ease;
            border-radius: 6px;
        }

        .role-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .role-button.active {
            border: 2px solid #70b8df;
            background: #fff;
        }

        .role-name {
            font-size: 22px;
            font-weight: 700;
            font-style: italic;
            color: #28a2d4;
            margin-bottom: 15px;
        }

        .role-icon {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #e7e7e7;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            color: #777;
        }

        /* FORM */
        .login-form {
            width: 100%;
        }

        .input-group {
            width: 100%;
            min-height: 58px;
            background: #f8f4f4;
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 0 15px;
            border: 1px solid transparent;
            border-radius: 5px;
        }

        .input-group:focus-within {
            border-color: #70b8df;
        }

        .input-icon {
            width: 35px;
            flex-shrink: 0;
            font-size: 23px;
            color: #111;
            text-align: center;
        }

        .input-group input {
            flex: 1;
            min-width: 0;
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 16px;
            padding: 12px 10px;
            color: #333;
        }

        .input-group input::placeholder {
            color: #555;
            font-weight: 600;
        }

        /* TOMBOL MATA PASSWORD */
        .toggle-password {
            flex-shrink: 0;
            border: none;
            background: transparent;
            color: #555;
            cursor: pointer;
            font-size: 21px;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover {
            color: #1767b1;
        }

        .toggle-password:focus-visible {
            outline: 2px solid #1767b1;
            border-radius: 4px;
        }

        /* TOMBOL LOGIN */
        .login-button {
            width: 45%;
            min-width: 180px;
            height: 48px;
            display: block;
            margin: 25px auto 18px;
            border: none;
            border-radius: 5px;
            background: #70b8df;
            color: #111;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #4ea5d3;
            color: white;
        }

        /* REGISTER */
        .register-text {
            text-align: center;
            font-size: 15px;
            color: #333;
        }

        .register-text a {
            color: #258ec5;
            text-decoration: none;
            font-weight: 600;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        /* PESAN ERROR */
        .error-message {
            background: #ffe5e5;
            color: #c62828;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 14px;
            border-radius: 5px;
        }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            body {
                padding: 15px;
            }

            .login-container {
                grid-template-columns: 1fr;
                max-width: 700px;
                gap: 0;
            }

            .left-section {
                display: none;
            }

            .right-section {
                min-height: auto;
                padding: 40px 30px;
            }

            .title {
                font-size: 30px;
            }

            .role-container {
                gap: 20px;
            }
        }

        @media (max-width: 500px) {
            .right-section {
                padding: 30px 20px;
            }

            .role-container {
                gap: 10px;
            }

            .role-button {
                height: 140px;
            }

            .role-name {
                font-size: 18px;
            }

            .role-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }

            .login-button {
                width: 100%;
            }

            .subtitle {
                font-size: 16px;
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
<div class="login-container">

    <!-- BAGIAN KIRI -->
    <div class="left-section">
        <img
            src="{{ asset('images/siforawa-intro.jpeg') }}"
            class="intro-image"
            alt="SIFORAWA"
        >

        <img
            src="{{ asset('images/siforawa-banner.jpeg') }}"
            class="banner-image"
            alt="Ilustrasi SIFORAWA"
        >
    </div>

    <!-- BAGIAN KANAN -->
    <div class="right-section">

        <h1 class="title">Masuk Ke SIFORAWA</h1>
        <p class="subtitle">Pilih peran Anda untuk melanjutkan</p>

        <!-- PILIH WARGA / ADMIN -->
        <div class="role-container">

            <button
                type="button"
                class="role-button active"
                id="wargaButton"
                onclick="selectRole('warga')"
                aria-pressed="true"
            >
                <div class="role-name">Warga</div>
                <div class="role-icon">👤</div>
            </button>

            <button
                type="button"
                class="role-button"
                id="adminButton"
                onclick="selectRole('admin')"
                aria-pressed="false"
            >
                <div class="role-name">Admin</div>
                <div class="role-icon">👤</div>
            </button>

        </div>

        <!-- PESAN ERROR VALIDASI LARAVEL -->
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form
            action="{{ route('login.process') }}"
            method="POST"
            class="login-form"
        >
            @csrf

            <!-- ROLE YANG DIPILIH -->
            <input
                type="hidden"
                name="role"
                id="role"
                value="{{ old('role', 'warga') }}"
            >

            <!-- USERNAME -->
            <div class="input-group">
                <div class="input-icon" aria-hidden="true">👤</div>

                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    value="{{ old('username') }}"
                    autocomplete="username"
                    required
                >
            </div>

            <!-- NOMOR TELEPON -->
            <div class="input-group">
                <div class="input-icon" aria-hidden="true">☎</div>

                <input
                    type="text"
                    name="no_telepon"
                    placeholder="Nomor Telepon"
                    value="{{ old('no_telepon') }}"
                    inputmode="tel"
                    autocomplete="tel"
                    required
                >
            </div>

            <!-- PASSWORD + IKON MATA -->
            <div class="input-group">
                <div class="input-icon" aria-hidden="true">🔒</div>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password"
                    autocomplete="current-password"
                    required
                >

                <button
                    type="button"
                    class="toggle-password"
                    id="togglePassword"
                    aria-label="Tampilkan password"
                    aria-pressed="false"
                    title="Tampilkan password"
                >
                    <svg
                        id="eyeIcon"
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>

            <!-- TOMBOL LOGIN -->
            <button type="submit" class="login-button">
                Login
            </button>
        </form>

        <!-- REGISTER -->
        <p class="register-text">
            Belum punya akun?
            <a href="{{ route('register') }}">Register</a>
        </p>

    </div>
</div>

<script>
    // Memilih role Warga atau Admin
    function selectRole(role) {
        const roleInput = document.getElementById('role');
        const wargaButton = document.getElementById('wargaButton');
        const adminButton = document.getElementById('adminButton');

        roleInput.value = role;

        wargaButton.classList.toggle('active', role === 'warga');
        adminButton.classList.toggle('active', role === 'admin');

        wargaButton.setAttribute(
            'aria-pressed',
            role === 'warga' ? 'true' : 'false'
        );

        adminButton.setAttribute(
            'aria-pressed',
            role === 'admin' ? 'true' : 'false'
        );
    }

    // Menampilkan atau menyembunyikan password
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        if (!passwordInput || !toggleButton || !eyeIcon) {
            return;
        }

        const eyeOpen = `
            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z"/>
            <circle cx="12" cy="12" r="3"/>
        `;

        const eyeClosed = `
            <path d="M3 3l18 18"/>
            <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
            <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a15.7 15.7 0 0 1-4 4.8"/>
            <path d="M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7c1.3 0 2.5-.3 3.6-.8"/>
        `;

        toggleButton.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';

            eyeIcon.innerHTML = isHidden ? eyeClosed : eyeOpen;

            toggleButton.setAttribute(
                'aria-pressed',
                isHidden ? 'true' : 'false'
            );

            toggleButton.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan password' : 'Tampilkan password'
            );

            toggleButton.setAttribute(
                'title',
                isHidden ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });

        // Memulihkan role yang dipilih jika validasi gagal
        const savedRole = document.getElementById('role').value;

        if (savedRole === 'admin' || savedRole === 'warga') {
            selectRole(savedRole);
        }
    });
</script>

</body>
</html>