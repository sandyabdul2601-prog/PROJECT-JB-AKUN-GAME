<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register - JB Alwikobra</title>

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

            background:
                radial-gradient(
                    circle at top right,
                    #351342,
                    #100e12 55%
                );

            color: white;
        }

        .auth-card {

            width: 420px;

            padding: 35px;

            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    #292326,
                    #1d191c
                );

            border: 1px solid #44353e;

            box-shadow:
                0 20px 60px
                rgba(0, 0, 0, .4);

        }

        .logo {

            width: 55px;
            height: 55px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #f00087,
                    #7535df
                );

            font-weight: bold;

            font-size: 20px;

            margin-bottom: 20px;

        }

        h1 {
            margin: 0 0 8px;
        }

        .subtitle {

            color: #9c8e96;

            margin-bottom: 30px;

        }

        .form-group {
            margin-bottom: 20px;
        }

        label {

            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: bold;

        }

        input {

            width: 100%;

            padding: 14px;

            border-radius: 10px;

            border: 1px solid #40343a;

            background: #121013;

            color: white;

            outline: none;

        }

        input:focus {
            border-color: #b54cd1;
        }

        .btn {

            width: 100%;

            padding: 14px;

            border: 0;

            border-radius: 10px;

            background:
                linear-gradient(
                    90deg,
                    #e62b91,
                    #7839dc
                );

            color: white;

            font-weight: bold;

            cursor: pointer;

        }

        .error {

            margin-bottom: 20px;

            padding: 12px;

            border-radius: 10px;

            background: #3a191d;

            border: 1px solid #80343d;

            color: #ff9ba4;

        }

        .bottom {

            margin-top: 25px;

            text-align: center;

            color: #91858b;

        }

        .bottom a {

            color: #ef68aa;

            text-decoration: none;

        }

    </style>

</head>

<body>

    <div class="auth-card">

        <div class="logo">
            JB
        </div>

        <h1>
            Buat Akun
        </h1>

        <div class="subtitle">
            Daftar untuk mulai jual dan beli akun game.
        </div>

        @if ($errors->any())

            <div class="error">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="/register" method="POST">

            @csrf

            <div class="form-group">

                <label for="name">
                    Nama
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Nama kamu"
                    required
                >

            </div>

            <div class="form-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Username kamu"
                    required
                >

            </div>

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email@gmail.com"
                    required
                >

            </div>

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 6 karakter"
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
                    placeholder="Ulangi password"
                    required
                >

            </div>

            <button type="submit" class="btn">
                DAFTAR
            </button>

        </form>

        <div class="bottom">

            Sudah punya akun?

            <a href="/login">
                Login
            </a>

        </div>

    </div>

</body>

</html>