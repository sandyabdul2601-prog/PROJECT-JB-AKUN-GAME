GAME MARKET - MODUL TUGAS ORANG KE-4 (SELLER)
================================================

Isi:
- SellerController.php
- Model Product, Order, Wallet, Withdrawal
- Routes seller
- Blade dashboard seller
- CRUD produk
- Halaman pesanan + update status
- Wallet + pengajuan withdrawal
- CSS seller
- Migration products, orders, wallets, withdrawals

CARA PASANG
-----------

1. Extract ZIP ke folder project Laravel kamu.

2. Copy isi folder:
   app/Http/Controllers/
   app/Models/
   database/migrations/
   resources/views/
   public/css/

   ke folder project Laravel dengan struktur yang sama.

3. Buka routes/seller_routes.txt.
   COPY bagian kodenya ke routes/web.php.
   Jangan membuat file routes/seller_routes.txt menjadi route Laravel.

4. Pastikan User model kamu punya data login yang dipakai auth().
   Modul ini menggunakan user yang sedang login sebagai seller_id.

5. Jalankan:
   php artisan migrate

6. Bersihkan cache:
   php artisan optimize:clear

7. Jalankan:
   php artisan serve

8. Login sebagai user, lalu buka:
   /seller/dashboard

CATATAN PENTING
---------------

- Migration products/orders mungkin bentrok kalau project kamu SUDAH punya tabel products/orders.
  Kalau sudah ada, jangan jalankan migration duplikat. Gabungkan kolom yang dibutuhkan ke migration milik project kamu.
- Controller memakai Product::orders(), jadi relasi orders harus tersedia.
- Untuk akses seller yang lebih aman, tambahkan middleware role seller pada route jika project kamu sudah punya RoleMiddleware.
- Model Product di paket ini tidak memakai Game model supaya modul tetap bisa jalan walaupun Game belum dibuat.
  Kolom game_id tetap tersedia untuk integrasi marketplace.
- Modul ini tidak membuat account_data karena data login akun game sebaiknya dipisahkan dan tidak ditampilkan di marketplace publik.
- Proses payment/MM utama tetap menjadi bagian modul transaksi, bukan modul seller.

ROUTE UTAMA
-----------
GET  /seller/dashboard
GET  /seller/products
GET  /seller/products/create
POST /seller/products
GET  /seller/products/{product}/edit
PUT  /seller/products/{product}
DELETE /seller/products/{product}
GET  /seller/orders
GET  /seller/orders/{order}
PUT  /seller/orders/{order}/status
GET  /seller/wallet
POST /seller/wallet/withdraw
