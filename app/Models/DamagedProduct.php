<?php

namespace App\Models;

use App\Enums\DamagedProduct\DamagedProductStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DamagedProduct extends Model
{
    protected $fillable = [
        "product_id",
        "damaged_quantity",
        "refundable_quantity",
        "exchangeable_quantity",
        "non_exchangeable_non_refundable_quantity",
        "damaged_value",
        "status",
        "remarks",
    ];

   protected $casts = [
        'status' => DamagedProductStatus::class
   ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productExchanges(): BelongsTo
    {
        return $this->belongsTo(ProductExchange::class);
    }
}
