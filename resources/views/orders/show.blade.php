<div class="card p-4">
    <h4>Order #{{ $order->id }}</h4>
    <p>Harga: Rp {{ number_format($order->price) }}</p>
    <p>Fee MM: Rp {{ number_format($order->fee_mm) }}</p>
    <p>Seller Diterima: Rp {{ number_format($order->seller_amount) }}</p>
    <hr>
    
    <h5>Status Alur Transaksi:</h5>
    <ul class="list-unstyled">
        <li>[ {{ $order->status != 'pending' ? '✓' : '✗' }} ] Order dibuat</li>
        <li>[ {{ in_array($order->status, ['payment_received', 'waiting_account', 'account_received', 'checking', 'completed']) ? '✓' : '✗' }} ] Pembayaran diterima MM</li>
        <li>[ {{ in_array($order->status, ['account_received', 'checking', 'completed']) ? '✓' : '✗' }} ] Seller mengirim akun</li>
        <li>[ {{ in_array($order->status, ['checking', 'completed']) ? '✓' : '✗' }} ] Pembeli mengecek akun</li>
        <li>[ {{ $order->status == 'completed' ? '✓' : '✗' }} ] Selesai (Dana ke seller)</li>
    </ul>

    @if($order->status == 'complaint')
        <div class="alert alert-danger">Status: Dalam Penanganan Komplain</div>
    @elseif($order->status == 'refund')
        <div class="alert alert-warning">Status: Transaksi Di-Refund</div>
    @endif
</div>