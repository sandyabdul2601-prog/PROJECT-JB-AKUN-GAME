<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Jual Beli Akun</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

</head>

<body>

    <div class="auth-container">

        <div class="auth-box">

            <h1>Login</h1>

            <p class="subtitle">
                Masuk ke akun kamu
            </p>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>Password</label>

                    <input
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

            <p class="bottom-text">

                Belum punya akun?

                <a href="{{ route('register') }}">
                    Daftar
                </a>

            </p>

        </div>

    </div>

</body>

</html>