@extends('layouts.seller')

@section('title', 'Produk Saya')
@section('heading', 'Produk Saya')

@section('content')
<div class="panel">
    <div class="panel-header">
        <form class="search-form" method="GET" action="{{ route('seller.products') }}">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk...">
            <button class="btn secondary" type="submit">Cari</button>
        </form>
        <a class="btn" href="{{ route('seller.products.create') }}">+ Tambah Produk</a>
    </div>

    @if($products->count())
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Level</th>
                    <th>Rank</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <strong>{{ $product->title }}</strong><br>
                        <small>{{ $product->server ?: '-' }}</small>
                    </td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->level ?? '-' }}</td>
                    <td>{{ $product->rank ?? '-' }}</td>
                    <td><span class="badge">{{ $product->status }}</span></td>
                    <td class="actions">
                        <a href="{{ route('seller.products.edit', $product) }}">Edit</a>
                        <form method="POST" action="{{ route('seller.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $products->links() }}</div>
    @else
        <div class="empty">Belum ada produk. Silakan tambah produk pertama kamu.</div>
    @endif
</div>
@endsection
