<?php

use App\Enums\DamagedProductStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('damaged_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('damaged_quantity');
            $table->integer('refundable_quantity')->default(0);
            $table->integer('exchangeable_quantity')->default(0);
            $table->integer('non_exchangeable_non_refundable_quantity')->default(0);
            $table->decimal('damaged_value', 10, 2);
            $table->enum('status', [DamagedProductStatus::PENDING->value,DamagedProductStatus::REFUNDED->value, DamagedProductStatus::EXCHANGED->value])->default(DamagedProductStatus::PENDING->value);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('damaged_products');
    }
};
