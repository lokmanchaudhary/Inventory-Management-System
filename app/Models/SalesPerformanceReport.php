<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesPerformanceReport extends Model
{
    protected $fillable = [
        "product_id",
        "total_sales",
        "total_refunded",
        "total_exchanged_value",
        "non_refundable_loss",
        "net_profit",
        "report_date",
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productExchanges(): HasMany
    {
        return $this->hasMany(ProductExchange::class);
    }
}
