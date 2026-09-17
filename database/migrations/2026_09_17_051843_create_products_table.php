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
    Schema::create('products', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->foreignId('game_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('title');

        $table->string('slug')->unique();

        $table->text('description');

        $table->decimal('seller_price', 15, 2);

        $table->decimal('platform_fee', 15, 2)->default(0);

        $table->decimal('buyer_price', 15, 2);

        $table->string('image')->nullable();

        $table->enum('status', [
            'available',
            'sold',
            'pending',
            'inactive'
        ])->default('available');

        $table->unsignedBigInteger('views')->default(0);

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
