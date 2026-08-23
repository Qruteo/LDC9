<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .login-box {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .10);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
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
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .register {
            margin-top: 20px;
            text-align: center;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h2>Login</h2>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
                autofocus
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                id="password"
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
        </div>

        <button type="submit">
            Login
        </button>
    </form>

    <div class="register">
        Belum punya akun?
        <a href="{{ route('register') }}">Register</a>
    </div>

</div>

</body>
</html>