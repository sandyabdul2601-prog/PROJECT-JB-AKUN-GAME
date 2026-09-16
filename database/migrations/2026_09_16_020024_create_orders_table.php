<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('buyer_id')->constrained('users');
    $table->foreignId('seller_id')->constrained('users');
    $table->foreignId('listing_id'); // sesuaikan nama tabel produk
    $table->decimal('price', 12, 2);
    $table->decimal('fee_mm', 12, 2);
    $table->decimal('seller_amount', 12, 2);
    $table->enum('status', [
        'pending', 'waiting_payment', 'payment_received', 
        'waiting_account', 'account_received', 'checking', 
        'completed', 'complaint', 'refund', 'cancelled'
    ])->default('pending');
    $table->timestamps();
});
}
};
