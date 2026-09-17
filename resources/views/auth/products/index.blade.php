<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Produk - JB Alwikobra</title>

    <link rel="stylesheet"
          href="{{ asset('css/home.css') }}">

    <style>

        .product-page {
            width: 80%;
            max-width: 1500px;
            margin: 35px auto;
        }

        .product-header {
            margin-bottom: 25px;
        }

        .product-header h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .product-header p {
            color: #9d9090;
        }

        .product-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 20px;

        }

        .product-card {

            overflow: hidden;

            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    #292426,
                    #211e20
                );

            border: 1px solid #3b3033;

            transition: .25s;

        }

        .product-card:hover {

            transform: translateY(-5px);

            border-color: #a94fba;

            box-shadow:
                0 10px 30px
                rgba(150, 50, 180, .12);

        }

        .product-image {

            height: 190px;

            background: #171518;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #8f8088;

        }

        .product-image img {

            width: 100%;
            height: 100%;

            object-fit: cover;

        }

        .product-content {

            padding: 16px;

        }

        .game-name {

            color: #d76a9e;

            font-size: 12px;

            margin-bottom: 7px;

        }

        .product-title {

            font-size: 16px;

            margin-bottom: 12px;

        }

        .product-price {

            color: #ff78b1;

            font-size: 19px;

            font-weight: bold;

        }

        .product-seller {

            margin-top: 10px;

            color: #8f8280;

            font-size: 12px;

        }

        @media(max-width: 1000px) {

            .product-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }

        @media(max-width: 600px) {

            .product-page {

                width: 92%;

            }

            .product-grid {

                grid-template-columns: 1fr;

            }

        }

    </style>

</head>


<body>

<header class="navbar">

    <div class="nav-left">

        <div class="logo">
            JB
        </div>

        <span class="brand">
            JB Alwikobra
        </span>

    </div>


    <nav class="nav-menu">

        <a href="{{ route('home') }}">
            Home
        </a>

        <a href="{{ route('products.index') }}">
            Produk
        </a>

        <a href="#">
            Rental
        </a>

        <a href="#">
            Flash Sale
        </a>

        <a href="#">
            Event
        </a>

        <a href="#">
            Komunitas
        </a>

        <a href="#">
            Bantuan
        </a>

    </nav>


</header>


<main class="product-page">

    <div class="product-header">

        <h1>
            Semua Akun Game
        </h1>

        <p>
            Temukan akun game sesuai kebutuhanmu
        </p>

    </div>


    <div class="product-grid">

        @forelse($products as $product)

            <div class="product-card">

                <div class="product-image">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->title }}"
                        >

                    @else

                        <span>
                            Tidak ada gambar
                        </span>

                    @endif

                </div>


                <div class="product-content">

                    <div class="game-name">

                        {{ $product->game->name }}

                    </div>


                    <h3 class="product-title">

                        {{ $product->title }}

                    </h3>


                    <div class="product-price">

                        Rp {{ number_format(
                            $product->buyer_price,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>


                    <div class="product-seller">

                        Seller:
                        {{ $product->user->name ?? 'User' }}

                    </div>

                </div>

            </div>

        @empty

            <p>
                Belum ada akun yang dijual.
            </p>

        @endforelse

    </div>


    <div style="margin-top:30px">

        {{ $products->links() }}

    </div>

</main>

</body>

</html>