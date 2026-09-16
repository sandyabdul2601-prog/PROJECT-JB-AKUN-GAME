@extends('layouts.seller')

@section('title', 'Dashboard Seller')
@section('heading', 'Dashboard Seller')

@section('content')
<div class="cards">
    <div class="stat-card">
        <span>Total Produk</span>
        <strong>{{ $productCount }}</strong>
    </div>
    <div class="stat-card">
        <span>Produk Aktif</span>
        <strong>{{ $activeProductCount }}</strong>
    </div>
    <div class="stat-card">
        <span>Total Pesanan</span>
        <strong>{{ $orderCount }}</strong>
    </div>
    <div class="stat-card">
        <span>Pesanan Diproses</span>
        <strong>{{ $pendingOrderCount }}</strong>
    </div>
    <div class="stat-card">
        <span>Saldo Wallet</span>
        <strong>Rp {{ number_format($wallet->balance, 0, ',', '.') }}</strong>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <h2>Pesanan Terbaru</h2>
        <a class="btn" href="{{ route('seller.orders') }}">Lihat Semua</a>
    </div>

    @if($recentOrders->count())
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($recentOrders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->product->title ?? 'Produk' }}</td>
                        <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                        <td><span class="badge">{{ str_replace('_', ' ', $order->status) }}</span></td>
                        <td><a href="{{ route('seller.orders.show', $order) }}">Detail</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty">Belum ada pesanan.</div>
    @endif
</div>
@endsection
