@extends('layouts.seller')

@section('title', 'Detail Pesanan')
@section('heading', 'Detail Pesanan #{{ $order->id }}')

@section('content')
<div class="panel narrow">
    <div class="detail-list">
        <div><span>Produk</span><strong>{{ $order->product->title ?? '-' }}</strong></div>
        <div><span>Pembeli</span><strong>{{ $order->buyer->name ?? $order->buyer->username ?? '-' }}</strong></div>
        <div><span>Harga</span><strong>Rp {{ number_format($order->price, 0, ',', '.') }}</strong></div>
        <div><span>Fee</span><strong>Rp {{ number_format($order->fee, 0, ',', '.') }}</strong></div>
        <div><span>Bagian Seller</span><strong>Rp {{ number_format($order->seller_amount, 0, ',', '.') }}</strong></div>
        <div><span>Status</span><strong>{{ str_replace('_', ' ', $order->status) }}</strong></div>
    </div>

    <hr>

    <h3>Update Status</h3>
    <form method="POST" action="{{ route('seller.orders.status', $order) }}">
        @csrf
        @method('PUT')

        <select name="status" required>
            @foreach(['waiting_account','account_received','checking','completed','cancelled'] as $status)
                <option value="{{ $status }}" @selected($order->status === $status)>
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>

        <button class="btn" type="submit">Simpan Status</button>
    </form>

    <div class="form-actions">
        <a class="btn secondary" href="{{ route('seller.orders') }}">Kembali</a>
    </div>
</div>
@endsection
