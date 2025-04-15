<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales_performance_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->decimal('total_sales', 10, 2)->default(0);
            $table->decimal('total_refunded', 10, 2)->default(0);
            $table->decimal('total_exchanged_value', 10, 2)->default(0);
            $table->decimal('non_refundable_loss', 10, 2)->default(0);
            $table->decimal('net_profit', 10, 2)->default(0);
            $table->date('report_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_performance_reports');
    }
};
