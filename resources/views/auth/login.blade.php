<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - JB Alwikobra</title>

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

        .remember {

            display: flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 20px;

            color: #9c8e96;

            font-size: 13px;

        }

        .remember input {

            width: auto;

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
        Selamat Datang
    </h1>

    <div class="subtitle">
        Login ke akun JB Alwikobra kamu.
    </div>


    @if ($errors->any())

        <div class="error">

            @foreach ($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    <form
        action="{{ route('login.store') }}"
        method="POST"
    >

        @csrf


        <div class="form-group">

            <label>
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="email@gmail.com"
                required
            >

        </div>


        <div class="form-group">

            <label>
                Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

        </div>


        <label class="remember">

            <input
                type="checkbox"
                name="remember"
            >

            Ingat saya

        </label>


        <button
            type="submit"
            class="btn"
        >
            LOGIN
        </button>

    </form>


    <div class="bottom">

        Belum punya akun?

        <a href="{{ route('register') }}">
            Daftar sekarang
        </a>

    </div>


</div>


</body>

</html>