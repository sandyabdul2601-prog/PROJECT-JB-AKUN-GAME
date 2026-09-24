<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
        }

        .navbar {
            background: #111827;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .container {
            padding: 40px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
        }

        .menu {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .menu a {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-decoration: none;
            color: #111827;
            font-weight: bold;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .menu a:hover {
            background: #e5e7eb;
        }
    </style>
</head>

<body>

    <div class="navbar">

        <h2>GAME MARKET - ADMIN</h2>

        <div>
            {{ auth()->user()->name }}
        </div>

    </div>

    <div class="container">

        <div class="welcome">
            <h1>Admin Dashboard</h1>

            <p>
                Selamat datang,
                <strong>{{ auth()->user()->name }}</strong>
            </p>
        </div>

        <div class="cards">

            <div class="card">
                <h3>Total User</h3>
                <p>0</p>
            </div>

            <div class="card">
                <h3>Total Produk</h3>
                <p>0</p>
            </div>

            <div class="card">
                <h3>Total Transaksi</h3>
                <p>0</p>
            </div>

            <div class="card">
                <h3>Komplain</h3>
                <p>0</p>
            </div>

        </div>

        <div class="menu">

            <a href="#">
                👤 Kelola Users
            </a>

            <a href="#">
                🎮 Kelola Games
            </a>

            <a href="#">
                🛒 Kelola Products
            </a>

            <a href="#">
                📦 Kelola Orders
            </a>

            <a href="#">
                💳 Kelola Payments
            </a>

            <a href="#">
                ⚠️ Kelola Complaints
            </a>

        </div>

    </div>

</body>
</html>