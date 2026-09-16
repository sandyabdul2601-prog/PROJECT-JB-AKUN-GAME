@extends('layouts.seller')

@section('title', 'Wallet Seller')
@section('heading', 'Wallet & Penarikan')

@section('content')
<div class="cards">
    <div class="stat-card">
        <span>Saldo Saat Ini</span>
        <strong>Rp {{ number_format($wallet->balance, 0, ',', '.') }}</strong>
    </div>
    <div class="stat-card">
        <span>Total Penjualan Selesai</span>
        <strong>Rp {{ number_format($completedSales, 0, ',', '.') }}</strong>
    </div>
</div>

<div class="panel narrow">
    <h2>Ajukan Penarikan</h2>
    <p class="muted">Minimal penarikan Rp 10.000.</p>

    <form method="POST" action="{{ route('seller.wallet.withdraw') }}">
        @csrf

        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="amount" min="10000" step="1000" value="{{ old('amount') }}" required>
        </div>

        <div class="form-group">
            <label>Metode</label>
            <select name="method" required>
                <option value="">Pilih metode</option>
                <option value="bank">Bank</option>
                <option value="e-wallet">E-Wallet</option>
            </select>
        </div>

        <div class="form-group">
            <label>Nomor Rekening / E-Wallet</label>
            <input type="text" name="account_number" value="{{ old('account_number') }}" required>
        </div>

        <div class="form-group">
            <label>Nama Pemilik</label>
            <input type="text" name="account_name" value="{{ old('account_name') }}" required>
        </div>

        <button class="btn" type="submit">Ajukan Penarikan</button>
    </form>
</div>

<div class="panel">
    <div class="panel-header">
        <h2>Riwayat Penarikan</h2>
    </div>

    @if($withdrawals->count())
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($withdrawals as $withdrawal)
                <tr>
                    <td>{{ $withdrawal->created_at->format('d/m/Y H:i') }}</td>
                    <td>Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                    <td>{{ $withdrawal->method }}</td>
                    <td>{{ $withdrawal->account_number }}<br><small>{{ $withdrawal->account_name }}</small></td>
                    <td><span class="badge">{{ $withdrawal->status }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $withdrawals->links() }}</div>
    @else
        <div class="empty">Belum ada riwayat penarikan.</div>
    @endif
</div>
@endsection
