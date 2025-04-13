<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profit_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->date('report_date');
            $table->decimal('sales_revenue', 10, 2)->nullable();
            $table->decimal('cost', 10, 2);
            $table->decimal('refunded', 10, 2);
            $table->decimal('damaged_loss', 10, 2);
            $table->decimal('total_profit', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profit_reports');
    }
};
