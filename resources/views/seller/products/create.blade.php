@extends('layouts.seller')

@section('title', 'Tambah Produk')
@section('heading', 'Tambah Produk')

@section('content')
<div class="panel narrow">
    <form method="POST" action="{{ route('seller.products.store') }}">
        @csrf
        @include('seller.products.form')

        <div class="form-actions">
            <a class="btn secondary" href="{{ route('seller.products') }}">Batal</a>
            <button class="btn" type="submit">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
