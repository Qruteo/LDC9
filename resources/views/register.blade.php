<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-box {
            width: 100%;
            max-width: 430px;
            background: white;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        h1 {
            margin: 0 0 8px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #4f46e5;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            border: none;
            padding: 13px;
            border-radius: 8px;
            background: #4f46e5;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            opacity: .9;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
        }
    </style>
</head>

<body>

<div class="register-box">

    <h1>Register</h1>

    <div class="subtitle">
        Buat akun baru
    </div>

    @if ($errors->any())
        <div class="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="nis">NIS</label>

            <input
                type="text"
                id="nis"
                name="nis"
                value="{{ old('nis') }}"
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </div>

        <div class="form-group">
            <label for="password_confirmation">
                Konfirmasi Password
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
            >
        </div>

        <button type="submit">
            Register
        </button>
    </form>

    <div class="login-link">
        Sudah punya akun?
        <a href="{{ route('login') }}">
            Login
        </a>
    </div>

</div>

</body>
</html>