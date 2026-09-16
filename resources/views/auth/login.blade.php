@extends('layouts.app')

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <h1>Login</h1>

        <p>Masuk ke akun GameMarket.</p>


        @if ($errors->any())

            <div class="alert">

                @foreach ($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif


        <form action="/login" method="POST">

            @csrf

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    required
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    required
                >

            </div>


            <button type="submit" class="btn btn-full">
                Login
            </button>

        </form>


        <p class="auth-footer">

            Belum punya akun?

            <a href="/register">
                Daftar
            </a>

        </p>

    </div>

</div>

@endsection