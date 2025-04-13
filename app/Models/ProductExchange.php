<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductExchange extends Model
{
    protected $fillable = [
        "damaged_product_id",
        "exchanged_product_id",
        "quantity",
        "value",
    ];

    public function damagedProduct(): BelongsTo
    {
        return $this->belongsTo(DamagedProduct::class);
    }

    public function exchangedProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'exchanged_product_id');
    }
}
