<?php

use App\Enums\Product\PackagingType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('quantity');
            $table->date('date_of_manufacture');
            $table->date('date_of_expiry');
            $table->decimal('base_price',8,2);
            $table->decimal('display_price',8,2);
            $table->enum('packaging_type', [
                PackagingType::BOX->value,
                PackagingType::BUNDLE->value,
                PackagingType::STRIPE->value,
                PackagingType::PACKET->value,
                PackagingType::BOTTLE->value,
                PackagingType::CAN->value,
                PackagingType::JAR->value,
                PackagingType::POUCH->value,
                PackagingType::TUBE->value,
                PackagingType::ROLL->value,
                PackagingType::SACHET->value,
                PackagingType::CRATE->value,
                PackagingType::TRAY->value,
                PackagingType::CARTON->value,
                PackagingType::LOOSE->value,
            ])->default(PackagingType::BOX->value);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
