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
    Schema::create('complaints', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
    $table->foreignId('user_id')->constrained('users');
    $table->text('reason');
    $table->string('evidence_image')->nullable();
    $table->enum('status', ['open', 'resolved_refund', 'resolved_rejected'])->default('open');
    $table->timestamps();
});
}
};
