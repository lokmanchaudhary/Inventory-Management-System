<?php

use App\Enums\TaxInvoice\TaxInvoiceUnit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tax_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');

            $table->string('invoice_number')->unique();
            $table->date('invoice_date')->nullable();
            $table->string('payment_type')->nullable();

            // Common fields
            $table->string('product_name');
            $table->string('hs_code')->nullable();
            $table->enum('unit',[
                TaxInvoiceUnit::PCS->value,
                TaxInvoiceUnit::PKT->value,
                TaxInvoiceUnit::KG->value,
                TaxInvoiceUnit::G->value,
                TaxInvoiceUnit::BOX->value,
                TaxInvoiceUnit::CARTON->value,
                TaxInvoiceUnit::DOZEN->value,
                TaxInvoiceUnit::ROLL->value,
                TaxInvoiceUnit::SET->value
            ])->nullable();
            $table->integer('pack');
            $table->integer('pcs');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->string('type')->nullable();
            $table->decimal('amount', 8, 2)->nullable();

            // Totals
            $table->decimal('total_pack_quantity', 8, 2)->nullable();
            $table->decimal('sub_total', 8, 2);
            $table->decimal('discount_total', 8, 2);
            $table->decimal('ebf_vat_amount', 8, 2);
            $table->decimal('vat', 8, 2);
            $table->decimal('net_total', 8, 2);


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tax_invoices');
    }
};
