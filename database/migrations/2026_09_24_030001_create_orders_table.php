<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (Orang 1)
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            
            // Relasi ke produk/listing (Orang 2)
            $table->unsignedBigInteger('listing_id'); 
            
            // Rincian Pembayaran Escrow
            $table->decimal('price', 12, 2);
            $table->decimal('fee_mm', 12, 2);
            $table->decimal('seller_amount', 12, 2);
            
            // Status Stepper Transaksi
            $table->enum('status', [
                'waiting_payment',  // Menunggu pembeli upload bukti bayar
                'payment_received', // Pembeli sudah upload, menunggu verifikasi Admin/MM
                'account_received', // Admin verifikasi & Seller kirim akun game
                'completed',        // Transaksi selesai & uang diteruskan ke Seller
                'complaint'         // Ada kendala/komplain dari Pembeli
            ])->default('waiting_payment');
            
            $table->string('payment_proof')->nullable(); // Path foto bukti transfer
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};