@extends('layouts.seller')

@section('title', 'Pesanan Seller')
@section('heading', 'Pesanan Seller')

@section('content')
<div class="panel">
    <div class="panel-header">
        <form class="search-form" method="GET" action="{{ route('seller.orders') }}">
            <select name="status">
                <option value="">Semua Status</option>
                @foreach(['pending','waiting_payment','payment_received','waiting_account','account_received','checking','completed','complaint','refund','cancelled'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
            <button class="btn secondary" type="submit">Filter</button>
        </form>
    </div>

    @if($orders->count())
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produk</th>
                    <th>Pembeli</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->product->title ?? 'Produk' }}</td>
                    <td>{{ $order->buyer->name ?? $order->buyer->username ?? 'Pembeli' }}</td>
                    <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                    <td><span class="badge">{{ str_replace('_', ' ', $order->status) }}</span></td>
                    <td><a href="{{ route('seller.orders.show', $order) }}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $orders->links() }}</div>
    @else
        <div class="empty">Belum ada pesanan.</div>
    @endif
</div>
@endsection
