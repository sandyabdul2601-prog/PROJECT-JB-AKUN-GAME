<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 600px;">
        <!-- Alert Session -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Order #{{ $order->id }}</h4>
                <span class="badge bg-secondary fs-6 text-uppercase">{{ str_replace('_', ' ', $order->status) }}</span>
            </div>

            <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($order->price, 0, ',', '.') }}</p>
            <p class="mb-1"><strong>Fee MM:</strong> Rp {{ number_format($order->fee_mm, 0, ',', '.') }}</p>
            <p class="mb-3"><strong>Seller Diterima:</strong> Rp {{ number_format($order->seller_amount, 0, ',', '.') }}</p>
            <hr>
            
            <h5 class="mb-3">Status Alur Transaksi:</h5>
            <ul class="list-unstyled">
                <li class="mb-2">[ {{ $order->status != 'pending' ? '✓' : '✗' }} ] Order dibuat</li>
                <li class="mb-2">[ {{ in_array($order->status, ['payment_received', 'waiting_account', 'account_received', 'checking', 'completed']) ? '✓' : '✗' }} ] Pembayaran diterima MM</li>
                <li class="mb-2">[ {{ in_array($order->status, ['account_received', 'checking', 'completed']) ? '✓' : '✗' }} ] Seller mengirim akun</li>
                <li class="mb-2">[ {{ in_array($order->status, ['checking', 'completed']) ? '✓' : '✗' }} ] Pembeli mengecek akun</li>
                <li class="mb-2">[ {{ $order->status == 'completed' ? '✓' : '✗' }} ] Selesai (Dana ke seller)</li>
            </ul>

            <!-- Informasi Data Akun Game -->
            @if(in_array($order->status, ['account_received', 'checking', 'completed']) && $order->accountData)
                <div class="alert alert-info mt-3">
                    <h6 class="alert-heading fw-bold">Data Akun Game:</h6>
                    <p class="mb-1"><strong>Data Login:</strong> {{ $order->accountData->credentials }}</p>
                </div>
            @endif

            <!-- Notifikasi Khusus Status Komplain/Refund -->
            @if($order->status == 'complaint')
                <div class="alert alert-danger mt-3 mb-0">Status: Dalam Penanganan Komplain</div>
            @elseif($order->status == 'refund')
                <div class="alert alert-warning mt-3 mb-0">Status: Transaksi Di-Refund</div>
            @endif

            <hr>

            <!-- Tombol Aksi Berdasarkan Status Transaksi -->
            <div class="d-grid gap-2">
                @if($order->status == 'waiting_payment')
                    <form action="{{ route('payment.upload', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Upload Bukti Bayar (Pembeli)</button>
                    </form>

                @elseif($order->status == 'payment_received')
                    <form action="{{ route('payment.confirm', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100">Konfirmasi Pembayaran (MM/Admin)</button>
                    </form>

                @elseif(in_array($order->status, ['account_received', 'checking']))
                    <form action="{{ route('order.complete', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">Konfirmasi Selesai & Kirim Uang ke Seller</button>
                    </form>

                    <!-- Tombol Ajukan Komplain -->
                    <button class="btn btn-outline-danger w-100 mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#formComplaint">
                        Ajukan Komplain / Kendala
                    </button>

                    <div class="collapse mt-2" id="formComplaint">
                        <div class="card card-body">
                            <form action="{{ route('complaint.store', $order->id) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Alasan Komplain:</label>
                                    <textarea name="reason" class="form-control" rows="3" placeholder="Jelaskan masalah akun..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-sm w-100">Kirim Laporan Komplain</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>