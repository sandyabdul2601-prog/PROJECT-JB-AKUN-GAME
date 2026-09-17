<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Jual Beli Akun</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

    <div class="auth-container">

        <div class="auth-box">

            <h1>Daftar</h1>

            <p class="subtitle">
                Buat akun baru
            </p>

            {{-- Menampilkan error --}}
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form Register --}}
            <form method="POST" action="{{ route('register') }}">

                @csrf

                {{-- Nama --}}
                <div class="form-group">
                    <label for="name">Nama</label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama"
                        required
                        autofocus
                    >
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                    >
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label for="password_confirmation">
                        Konfirmasi Password
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                    >
                </div>

                {{-- Tombol --}}
                <button type="submit">
                    Daftar
                </button>

            </form>

            {{-- Link Login --}}
            <p class="bottom-text">
                Sudah punya akun?

                <a href="{{ route('login') }}">
                    Login
                </a>
            </p>

        </div>

    </div>

</body>

</html>