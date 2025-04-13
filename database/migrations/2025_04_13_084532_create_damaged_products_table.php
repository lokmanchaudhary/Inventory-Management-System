<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('damaged_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('damaged_quantity');
            $table->integer('refundable_quantity')->default(0);
            $table->integer('exchangeable_quantity')->default(0);
            $table->integer('non_exchangeable_non_refundable_quantity')->default(0);
            $table->decimal('refunded_amount', 10, 2)->nullable();
            $table->decimal('exchanged_value', 10, 2)->nullable();
            $table->enum('status', ['pending', 'refunded', 'exchanged'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('damaged_products');
    }
};
