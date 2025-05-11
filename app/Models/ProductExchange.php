<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductExchange extends Model
{
    protected $fillable = [
        "product_id",
        "quantity_exchanged",
        "exchanged_value",
        "damaged_product_id",
        "reason",
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function damagedProduct(): BelongsTo
    {
        return $this->belongsTo(DamagedProduct::class);
    }
}
