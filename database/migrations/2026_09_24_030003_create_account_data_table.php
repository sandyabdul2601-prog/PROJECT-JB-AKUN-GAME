<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_data', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke transaksi order (Orang 3)
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            // Relasi ke penjual yang menginput data (Orang 1 / Orang 4)
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            
            // Data Sensitif Akun Game
            $table->string('account_identifier'); // Email / Username Game
            $table->text('account_password');      // Password (bisa di-encrypt)
            $table->text('additional_notes')->nullable(); // Catatan login/Code 2FA/Recovery
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_data');
    }
};