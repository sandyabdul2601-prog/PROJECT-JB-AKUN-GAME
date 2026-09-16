@extends('layouts.seller')

@section('title', 'Edit Produk')
@section('heading', 'Edit Produk')

@section('content')
<div class="panel narrow">
    <form method="POST" action="{{ route('seller.products.update', $product) }}">
        @csrf
        @method('PUT')
        @include('seller.products.form')

        <div class="form-actions">
            <a class="btn secondary" href="{{ route('seller.products') }}">Batal</a>
            <button class="btn" type="submit">Update Produk</button>
        </div>
    </form>
</div>
@endsection
