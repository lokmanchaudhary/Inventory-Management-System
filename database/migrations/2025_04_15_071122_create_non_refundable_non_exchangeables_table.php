<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('non_refundable_non_exchangeables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('damaged_product_id')->constrained('damaged_products')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('quantity')->default(0);
            $table->decimal('loss_value', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_refundable_non_exchangeables');
    }
};
