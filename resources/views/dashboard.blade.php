@extends('layouts.app')

@section('content')

<div class="container dashboard">

    <h1>Dashboard</h1>

    <div class="welcome-card">

        <h2>
            Halo, {{ auth()->user()->name }} 👋
        </h2>

        <p>
            Selamat datang di GameMarket.
        </p>

    </div>

</div>

@endsection