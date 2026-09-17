<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 600px;">
        <!-- Alert Session -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0 fw-bold">Order #{{ $order->id }}</h4>
                <span class="badge bg-primary px-3 py-2 fs-6 text-uppercase rounded-pill">
                    {{ str_replace('_', ' ', $order->status) }}
                </span>
            </div>

            <!-- Rincian Biaya -->
            <div class="bg-light p-3 rounded-3 mb-3 border">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Harga Akun</span>
                    <strong>Rp {{ number_format($order->price, 0, ',', '.') }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-1 text-danger">
                    <span>Fee MM (5%)</span>
                    <strong>- Rp {{ number_format($order->fee_mm, 0, ',', '.') }}</strong>
                </div>
                <hr class="my-2">
                <div class="d-flex justify-content-between text-success fw-bold fs-6">
                    <span>Seller Diterima</span>
                    <span>Rp {{ number_format($order->seller_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Checklist Status -->
            <h6 class="fw-bold mb-3">Status Alur Transaksi:</h6>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item d-flex align-items-center bg-transparent border-0 px-0 py-1">
                    <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i> Order dibuat
                </li>
                
                <li class="list-group-item d-flex align-items-center bg-transparent border-0 px-0 py-1">
                    @if(in_array($order->status, ['payment_received', 'waiting_account', 'account_received', 'checking', 'completed']))
                        <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i> Pembayaran diterima MM
                    @else
                        <i class="bi bi-dash-circle text-muted me-2 fs-5"></i> Pembayaran diterima MM
                    @endif
                </li>

                <li class="list-group-item d-flex align-items-center bg-transparent border-0 px-0 py-1">
                    @if(in_array($order->status, ['account_received', 'checking', 'completed']))
                        <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i> Seller mengirim akun
                    @else
                        <i class="bi bi-dash-circle text-muted me-2 fs-5"></i> Seller mengirim akun
                    @endif
                </li>

                <li class="list-group-item d-flex align-items-center bg-transparent border-0 px-0 py-1">
                    @if(in_array($order->status, ['checking', 'completed']))
                        <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i> Pembeli mengecek akun
                    @else
                        <i class="bi bi-dash-circle text-muted me-2 fs-5"></i> Pembeli mengecek akun
                    @endif
                </li>

                <li class="list-group-item d-flex align-items-center bg-transparent border-0 px-0 py-1">
                    @if($order->status == 'completed')
                        <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i> Selesai (Dana ke seller)
                    @elseif($order->status == 'complaint')
                        <i class="bi bi-x-circle-fill text-danger me-2 fs-5"></i> Transaksi Dalam Komplain
                    @elseif($order->status == 'refund')
                        <i class="bi bi-arrow-counterclockwise text-warning me-2 fs-5"></i> Transaksi Di-Refund
                    @else
                        <i class="bi bi-dash-circle text-muted me-2 fs-5"></i> Selesai (Dana ke seller)
                    @endif
                </li>
            </ul>

            <!-- Informasi Data Akun Game -->
            @if(in_array($order->status, ['account_received', 'checking', 'completed']) && $order->accountData)
                <div class="alert alert-info border-0 shadow-sm mt-2">
                    <h6 class="alert-heading fw-bold mb-2"><i class="bi bi-key-fill me-1"></i> Data Akun Game:</h6>
                    <div class="bg-white p-2 rounded border">
                        <code>{{ $order->accountData->credentials }}</code>
                    </div>
                </div>
            @endif

            <!-- Notifikasi Khusus Status Komplain/Refund -->
            @if($order->status == 'complaint')
                <div class="alert alert-danger border-0 shadow-sm mt-2">
                    <i class="bi bi-exclamation-octagon-fill me-1"></i> Status: Dalam Penanganan Komplain
                </div>
            @elseif($order->status == 'refund')
                <div class="alert alert-warning border-0 shadow-sm mt-2">
                    <i class="bi bi-arrow-return-left me-1"></i> Status: Transaksi Di-Refund
                </div>
            @endif

            <hr class="my-3">

            <!-- Tombol Aksi Berdasarkan Status -->
            <div class="d-grid gap-2">
                @if($order->status == 'waiting_payment')
                    <form action="{{ route('payment.upload', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                            Upload Bukti Bayar (Pembeli)
                        </button>
                    </form>

                @elseif($order->status == 'payment_received')
                    <form action="{{ route('payment.confirm', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100 fw-bold py-2 text-dark">
                            Konfirmasi Pembayaran (MM/Admin)
                        </button>
                    </form>

                @elseif(in_array($order->status, ['account_received', 'checking']))
                    <form action="{{ route('order.complete', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 fw-bold py-2">
                            Konfirmasi Selesai & Kirim Uang ke Seller
                        </button>
                    </form>

                    <!-- Tombol Ajukan Komplain -->
                    <button class="btn btn-outline-danger w-100 mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#formComplaint">
                        Ajukan Komplain / Kendala
                    </button>

                    <div class="collapse mt-2" id="formComplaint">
                        <div class="card card-body bg-light border-danger">
                            <form action="{{ route('complaint.store', $order->id) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label fw-bold text-danger">Alasan Komplain:</label>
                                    <textarea name="reason" class="form-control" rows="3" placeholder="Jelaskan masalah akun..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold">Kirim Laporan Komplain</button>
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