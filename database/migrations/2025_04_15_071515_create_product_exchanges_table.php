<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('quantity_exchanged');
            $table->decimal('exchanged_value', 10, 2);
            $table->foreignId('damaged_product_id')->constrained('damaged_products')->cascadeOnDelete();
            $table->text('reason')->nullable(); $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_exchanges');
    }
};
