<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Transaksi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 500px;">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-3">Form Transaksi Baru</h4>
            <form action="{{ route('order.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">ID Seller</label>
                    <input type="number" name="seller_id" class="form-control" value="2" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Produk / Listing</label>
                    <input type="number" name="listing_id" class="form-control" value="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" value="150000" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Beli Sekarang</button>
            </form>
        </div>
    </div>
</body>
</html>