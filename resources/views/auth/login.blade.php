<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Classsync</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            background: #bfdbf7;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 20px;
            color: #1f2937;
        }

        .login-wrapper {
            width: 100%;
            max-width: 450px;
        }

        /* ICON CHECK */
        .check-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #2864df;
            margin: 0 auto 27px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .check-icon::after {
            content: "";
            width: 22px;
            height: 12px;
            border-left: 5px solid white;
            border-bottom: 5px solid white;
            transform: rotate(-45deg);
            margin-top: -5px;
        }

        /* CARD */
        .login-card {
            background: #ffffff;
            border-radius: 11px;
            padding: 26px 32px 24px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.10);
        }

        /* TITLE */
        .login-title {
            text-align: center;
            color: #294b9b;
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-subtitle {
            text-align: center;
            color: #737b86;
            font-size: 14px;
            margin-bottom: 27px;
        }

        /* ROLE */
        .role-label {
            display: block;
            font-size: 14px;
            color: #374151;
            margin-bottom: 10px;
        }

        .role-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 11px;
            margin-bottom: 21px;
        }

        .role-option {
            position: relative;
        }

        .role-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .role-box {
            height: 82px;
            border: 1px solid #d1d5db;
            border-radius: 11px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            cursor: pointer;
            transition: 0.2s ease;
            background: #fff;
        }

        .role-box:hover {
            border-color: #2864df;
            background: #f8fbff;
        }

        .role-option input:checked + .role-box {
            border: 2px solid #2864df;
            background: #f5f9ff;
        }

        .role-icon {
            font-size: 27px;
            line-height: 1;
            margin-bottom: 8px;
        }

        .role-name {
            font-size: 14px;
            color: #111827;
        }

        /* FORM */
        .form-group {
            margin-bottom: 17px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            color: #374151;
            margin-bottom: 7px;
        }

        .form-input {
            width: 100%;
            height: 44px;

            border: 1px solid #d1d5db;
            border-radius: 9px;

            padding: 0 16px;
            font-size: 15px;
            color: #374151;
            outline: none;

            transition: 0.2s ease;
        }

        .form-input:focus {
            border-color: #2864df;
            box-shadow: 0 0 0 1px #2864df;
        }

        .form-input::placeholder {
            color: #8b929c;
        }

        /* OPTIONS */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1px;
            margin-bottom: 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;

            font-size: 14px;
            color: #737b86;
            cursor: pointer;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: #2864df;
            cursor: pointer;
        }

        .forgot-password {
            color: #2864df;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* BUTTON */
        .login-button {
            width: 100%;
            height: 43px;

            border: none;
            border-radius: 7px;

            background: #2864df;
            color: white;

            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;

            cursor: pointer;
            transition: 0.2s ease;
        }

        .login-button:hover {
            background: #1f56c5;
        }

        .login-button:active {
            transform: translateY(1px);
        }

        /* ERROR */
        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 11px 13px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .field-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }

        /* RESPONSIVE */
        @media (max-width: 480px) {
            body {
                padding: 20px 14px;
            }

            .login-card {
                padding: 24px 22px;
            }

            .login-title {
                font-size: 23px;
            }

            .role-container {
                gap: 7px;
            }

            .role-box {
                height: 78px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <!-- ICON CHECK -->
    <div class="check-icon"></div>

    <!-- LOGIN CARD -->
    <div class="login-card">

        <h1 class="login-title">
            Selamat Datang
        </h1>

        <p class="login-subtitle">
            Masuk ke sistem Classsync
        </p>

        {{-- Error login --}}
        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <!-- ROLE -->
            <label class="role-label">
                Masuk sebagai
            </label>

            <div class="role-container">

    {{-- ADMIN --}}
    <label class="role-option">
        <input
            type="radio"
            name="role"
            value="admin"
            {{ old('role', 'admin') === 'admin' ? 'checked' : '' }}
        >

        <div class="role-box">
            <div class="role-icon">🛡️</div>
            <div class="role-name">Admin</div>
        </div>
    </label>


    {{-- GURU --}}
    <label class="role-option">
        <input
            type="radio"
            name="role"
            value="guru"
            {{ old('role') === 'guru' ? 'checked' : '' }}
        >

        <div class="role-box">
            <div class="role-icon">👩‍🏫</div>
            <div class="role-name">Guru</div>
        </div>
    </label>


    {{-- SISWA --}}
    <label class="role-option">
        <input
            type="radio"
            name="role"
            value="siswa"
            {{ old('role') === 'siswa' ? 'checked' : '' }}
        >

        <div class="role-box">
            <div class="role-icon">🎓</div>
            <div class="role-name">Siswa</div>
        </div>
    </label>

</div>

            <!-- EMAIL -->
            <div class="form-group">

                <label class="form-label" for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    autocomplete="email"
                    required
                    autofocus
                >

                @error('email')
                    <div class="field-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <!-- PASSWORD -->
            <div class="form-group">

                <label class="form-label" for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Masukkan password Anda"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <div class="field-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <!-- OPTIONS -->
            <div class="form-options">

                <label class="remember">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    <span>Ingat saya</span>
                </label>

                <a href="#" class="forgot-password">
                    Lupa password?
                </a>

            </div>

            <!-- LOGIN BUTTON -->
            <button type="submit" class="login-button">
                MASUK
            </button>

        </form>

    </div>

</div>

</body>
</html>