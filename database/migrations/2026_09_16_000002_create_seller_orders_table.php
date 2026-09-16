<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete();
            $table->decimal('price', 15, 2);
            $table->decimal('fee', 15, 2)->default(0);
            $table->decimal('seller_amount', 15, 2)->default(0);
            $table->enum('status', [
                'pending',
                'waiting_payment',
                'payment_received',
                'waiting_account',
                'account_received',
                'checking',
                'completed',
                'complaint',
                'refund',
                'cancelled'
            ])->default('pending');
            $table->timestamps();

            $table->index(['seller_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
