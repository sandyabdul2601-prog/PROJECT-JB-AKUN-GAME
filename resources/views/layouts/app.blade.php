<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'GameMarket' }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<header class="navbar">

    <div class="container navbar-content">

        <a href="/" class="logo">
            GameMarket
        </a>

        <nav>

            <a href="/">Home</a>
            <a href="/marketplace">Marketplace</a>

            @auth
                <a href="/dashboard">Dashboard</a>

                <form action="/logout" method="POST" class="logout-form">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="/login">Login</a>
                <a href="/register" class="btn">Daftar</a>
            @endauth

        </nav>

    </div>

</header>


<main>

    @yield('content')

</main>


<footer>

    <p>© {{ date('Y') }} GameMarket</p>

</footer>

</body>
</html>