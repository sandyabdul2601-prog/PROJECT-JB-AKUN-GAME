@extends('layouts.app')

@section('content')

<style>.hero {
    padding: 100px 0;

    background: white;

    text-align: center;
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 15px;
}

.hero p {
    font-size: 20px;
    margin-bottom: 30px;
}</style>

<section class="hero">

    <div class="container">

        <h1>Marketplace Akun Game</h1>

        <p>
            Tempat jual beli akun game dengan mudah.
        </p>

        <a href="/marketplace" class="btn">
            Jelajahi Marketplace
        </a>

    </div>

</section>


<section class="container">

    <h2>Game Populer</h2>

    <p>Mobile Legends</p>
    <p>Free Fire</p>
    <p>PUBG Mobile</p>
    <p>Valorant</p>

</section>

@endsection