<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DamagedProduct extends Model
{
    protected $fillable = [
        "product_id",
        "damaged_quantity",
        "refundable_quantity",
        "exchangeable_quantity",
        "non_exchangeable_non_refundable_quantity",
        "refunded_amount",
        "exchanged_value",
        "status",
        "remarks",
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function exchanges(): HasMany
    {
        return $this->hasMany(ProductExchange::class);
    }
}
