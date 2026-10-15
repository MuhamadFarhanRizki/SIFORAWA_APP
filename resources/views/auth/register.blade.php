<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun Warga - SIFORAWA</title>

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
            padding: 24px;
        }

        /* PANEL UTAMA */
        .register-container {
            width: 100%;
            max-width: 1050px;
            background: #fffdfd;
            padding: 38px 55px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            border-radius: 5px;
        }

        /* JUDUL */
        .title {
            color: #3159bd;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #222;
            font-size: 18px;
            font-weight: 400;
            line-height: 1.5;
            margin-bottom: 38px;
        }

        /* FORM */
        .register-form {
            width: 100%;
        }

        .input-group {
            width: 100%;
            min-height: 58px;
            background: #faf2f4;
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            padding: 0 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .input-group:focus-within {
            border-color: #788bd4;
        }

        .input-icon {
            width: 42px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 25px;
            color: #111;
        }

        .input-group input {
            flex: 1;
            min-width: 0;
            width: 100%;
            height: 56px;
            border: none;
            outline: none;
            background: transparent;
            padding: 0 12px;
            font-size: 17px;
            color: #222;
        }

        .input-group input::placeholder {
            color: #555;
            opacity: 1;
        }

        /* IKON MATA PASSWORD */
        .toggle-password {
            flex-shrink: 0;
            width: 40px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: #555;
            cursor: pointer;
            border-radius: 4px;
        }

        .toggle-password:hover {
            color: #3159bd;
        }

        .toggle-password:focus-visible {
            outline: 2px solid #3159bd;
        }

        /* KETERANGAN PASSWORD */
        .password-info {
            text-align: center;
            color: #555;
            font-size: 14px;
            line-height: 1.5;
            margin: 2px 0 22px;
        }

        /* TOMBOL DAFTAR */
        .register-button {
            display: block;
            width: 300px;
            max-width: 100%;
            min-height: 46px;
            margin: 0 auto;
            border: none;
            border-radius: 4px;
            background: #788bd4;
            color: #111;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .register-button:hover {
            background: #6479ca;
            color: white;
        }

        /* PESAN ERROR */
        .error-box {
            background: #ffe5e5;
            color: #c62828;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
            border-radius: 4px;
        }

        .error-box div + div {
            margin-top: 4px;
        }

        /* PESAN BERHASIL */
        .success-box {
            background: #e4f7e8;
            color: #26733b;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 14px;
            border-radius: 4px;
        }

        /* RESPONSIVE TABLET */
        @media (max-width: 900px) {
            body {
                padding: 20px;
            }

            .register-container {
                max-width: 680px;
                padding: 32px;
            }

            .title {
                font-size: 27px;
            }

            .subtitle {
                font-size: 17px;
                margin-bottom: 30px;
            }
        }

        /* RESPONSIVE HP */
        @media (max-width: 500px) {
            body {
                padding: 12px;
                align-items: flex-start;
            }

            .register-container {
                padding: 25px 18px;
                margin: 12px 0;
            }

            .title {
                font-size: 24px;
            }

            .subtitle {
                font-size: 15px;
                margin-bottom: 25px;
            }

            .input-group {
                min-height: 54px;
                padding: 0 8px;
                margin-bottom: 15px;
            }

            .input-icon {
                width: 34px;
                font-size: 22px;
            }

            .input-group input {
                height: 52px;
                padding: 0 8px;
                font-size: 15px;
            }

            .toggle-password {
                width: 34px;
            }

            .password-info {
                font-size: 13px;
                margin-bottom: 18px;
            }

            .register-button {
                width: 100%;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <main class="register-container">

        <!-- JUDUL -->
        <h1 class="title">Daftar Akun Warga</h1>

        <p class="subtitle">
            Lengkapi data diri Anda untuk membuat akun SIFORAWA
        </p>

        <!-- ERROR VALIDASI LARAVEL -->
        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- PESAN BERHASIL -->
        @if (session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM REGISTER -->
        <form
            action="{{ route('register.process') }}"
            method="POST"
            class="register-form"
        >
            @csrf

            <!-- USERNAME -->
            <div class="input-group">
                <div class="input-icon" aria-hidden="true">👤</div>

                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    value="{{ old('username') }}"
                    maxlength="50"
                    autocomplete="username"
                    required
                >
            </div>

            <!-- NOMOR TELEPON -->
            <div class="input-group">
                <div class="input-icon" aria-hidden="true">☎</div>

                <input
                    type="tel"
                    name="no_telepon"
                    placeholder="Nomor Telepon"
                    value="{{ old('no_telepon') }}"
                    maxlength="20"
                    autocomplete="tel"
                    required
                >
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <div class="input-icon" aria-hidden="true">🔒</div>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password"
                    autocomplete="new-password"
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

            <!-- KETERANGAN PASSWORD -->
            <p class="password-info">
                Gunakan password yang kuat dan mudah Anda ingat.
            </p>

            <!-- TOMBOL DAFTAR -->
            <button type="submit" class="register-button">
                DAFTAR
            </button>

        </form>

    </main>

    <script>
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
                const showPassword = passwordInput.type === 'password';

                passwordInput.type = showPassword ? 'text' : 'password';
                eyeIcon.innerHTML = showPassword ? eyeClosed : eyeOpen;

                toggleButton.setAttribute(
                    'aria-pressed',
                    showPassword ? 'true' : 'false'
                );

                toggleButton.setAttribute(
                    'aria-label',
                    showPassword ? 'Sembunyikan password' : 'Tampilkan password'
                );

                toggleButton.setAttribute(
                    'title',
                    showPassword ? 'Sembunyikan password' : 'Tampilkan password'
                );
            });
        });
    </script>

</body>
</html>