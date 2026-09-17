<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Jual Akun - JB Alwikobra</title>

    <link rel="stylesheet"
          href="{{ asset('css/home.css') }}">

    <style>

        .sell-container {
            width: 70%;
            max-width: 900px;
            margin: 40px auto;
        }

        .sell-header {
            margin-bottom: 25px;
        }

        .sell-header h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .sell-header p {
            color: #9e9090;
        }

        .sell-card {
            padding: 30px;

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #292426,
                    #201d1f
                );

            border: 1px solid #3b3033;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: bold;
        }

        .form-control {
            width: 100%;

            padding: 14px 15px;

            border-radius: 10px;

            border: 1px solid #403438;

            outline: none;

            background: #151315;

            color: white;

            font-size: 14px;
        }

        .form-control:focus {
            border-color: #a34fc0;
        }

        textarea.form-control {
            min-height: 150px;

            resize: vertical;
        }

        .price-box {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 15px;
        }

        .price-result {
            padding: 18px;

            margin-top: 10px;

            border-radius: 12px;

            background:
                rgba(145, 65, 180, .10);

            border: 1px solid #633775;
        }

        .price-result small {
            display: block;

            color: #9d8d98;

            margin-bottom: 6px;
        }

        .buyer-price {
            font-size: 24px;

            font-weight: bold;

            color: #ff75b0;
        }

        .btn-submit {
            width: 100%;

            padding: 15px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(
                    90deg,
                    #e52d91,
                    #7939dc
                );

            color: white;

            font-size: 15px;

            font-weight: bold;

            cursor: pointer;
        }

        .btn-submit:hover {
            opacity: .9;
        }

        .error-box {
            padding: 15px;

            margin-bottom: 20px;

            border-radius: 10px;

            background: rgba(255, 50, 70, .1);

            border: 1px solid #8d3038;

            color: #ff8d98;
        }

        @media(max-width: 700px) {

            .sell-container {
                width: 92%;
            }

            .price-box {
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

        <a href="{{ route('products.create') }}">
            Jual Akun
        </a>

    </nav>

</header>



<main class="sell-container">


    <div class="sell-header">

        <h1>
            Jual Akun
        </h1>

        <p>
            Jual akun game kamu dengan mudah dan aman.
        </p>

    </div>



    <div class="sell-card">


        @if ($errors->any())

            <div class="error-box">

                <strong>
                    Ada kesalahan:
                </strong>

                <ul style="margin-top: 8px; padding-left: 20px;">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        <form
            action="{{ route('products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- GAME --}}

            <div class="form-group">

                <label>
                    Game
                </label>

                <select
                    name="game_id"
                    class="form-control"
                    required
                >

                    <option value="">
                        -- Pilih Game --
                    </option>

                    @foreach ($games as $game)

                        <option
                            value="{{ $game->id }}"
                            {{ old('game_id') == $game->id ? 'selected' : '' }}
                        >
                            {{ $game->name }}
                        </option>

                    @endforeach

                </select>

            </div>



            {{-- JUDUL --}}

            <div class="form-group">

                <label>
                    Judul Akun
                </label>

                <input
                    type="text"
                    name="title"
                    class="form-control"
                    placeholder="Contoh: Akun FF Sultan 150 Skin"
                    value="{{ old('title') }}"
                    required
                >

            </div>



            {{-- HARGA --}}

            <div class="form-group">

                <label>
                    Harga yang kamu inginkan
                </label>

                <input
                    type="number"
                    name="seller_price"
                    id="seller_price"
                    class="form-control"
                    placeholder="200000"
                    value="{{ old('seller_price') }}"
                    min="1000"
                    required
                >

            </div>



            {{-- PERHITUNGAN --}}

            <div class="price-box">


                <div class="price-result">

                    <small>
                        Harga Seller
                    </small>

                    <strong id="sellerDisplay">
                        Rp0
                    </strong>

                </div>



                <div class="price-result">

                    <small>
                        Biaya Platform
                    </small>

                    <strong>
                        Rp5.000
                    </strong>

                </div>


            </div>



            <div class="price-result"
                 style="margin-bottom: 22px;">

                <small>
                    Harga yang tampil ke pembeli
                </small>

                <div class="buyer-price"
                     id="buyerPrice">

                    Rp0

                </div>

            </div>



            {{-- DESKRIPSI --}}

            <div class="form-group">

                <label>
                    Deskripsi Akun
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    placeholder="Jelaskan detail akun seperti level, skin, rank, item, dan informasi lainnya..."
                    required
                >{{ old('description') }}</textarea>

            </div>



            {{-- GAMBAR --}}

            <div class="form-group">

                <label>
                    Foto Akun
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small style="color:#8f8180;">
                    Maksimal 2MB. Format JPG, PNG atau WEBP.
                </small>

            </div>



            <button
                type="submit"
                class="btn-submit"
            >
                TERBITKAN AKUN
            </button>


        </form>


    </div>


</main>



<script>

    const sellerPrice =
        document.getElementById('seller_price');

    const sellerDisplay =
        document.getElementById('sellerDisplay');

    const buyerPrice =
        document.getElementById('buyerPrice');


    function formatRupiah(number) {

        return 'Rp' +
            new Intl.NumberFormat('id-ID')
                .format(number);

    }


    function calculatePrice() {

        let price =
            parseInt(sellerPrice.value) || 0;

        let fee = 5000;

        let total = price + fee;


        sellerDisplay.textContent =
            formatRupiah(price);

        buyerPrice.textContent =
            formatRupiah(total);

    }


    sellerPrice.addEventListener(
        'input',
        calculatePrice
    );


    calculatePrice();

</script>


</body>

</html>