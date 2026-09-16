@extends('layouts.app')

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <h1>Buat Akun</h1>

        <p>Daftar untuk mulai menggunakan GameMarket.</p>

        @if ($errors->any())

            <div class="alert">

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

                <label>Nama</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
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


            <div class="form-group">

                <label>Konfirmasi Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                >

            </div>


            <button type="submit" class="btn btn-full">
                Daftar
            </button>

        </form>


        <p class="auth-footer">
            Sudah punya akun?
            <a href="/login">Login</a>
        </p>

    </div>

</div>

@endsection