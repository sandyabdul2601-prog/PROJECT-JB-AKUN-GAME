<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller Dashboard') - Game Market</title>
    <link rel="stylesheet" href="{{ asset('css/seller.css') }}">
</head>
<body>
<div class="seller-layout">
    <aside class="sidebar">
        <div class="brand">GAME MARKET</div>
        <div class="seller-label">SELLER PANEL</div>

        <nav>
            <a href="{{ route('seller.dashboard') }}" class="{{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('seller.products') }}" class="{{ request()->routeIs('seller.products*') ? 'active' : '' }}">Produk Saya</a>
            <a href="{{ route('seller.orders') }}" class="{{ request()->routeIs('seller.orders*') ? 'active' : '' }}">Pesanan</a>
            <a href="{{ route('seller.wallet') }}" class="{{ request()->routeIs('seller.wallet') ? 'active' : '' }}">Wallet & Penarikan</a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ url('/') }}">Kembali ke Home</a>
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div>
                <h1>@yield('heading', 'Seller Dashboard')</h1>
                <p>Kelola produk dan pesanan kamu.</p>
            </div>
            <div class="user-badge">{{ auth()->user()->name ?? auth()->user()->username ?? 'Seller' }}</div>
        </header>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert error">
                <strong>Periksa input:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
