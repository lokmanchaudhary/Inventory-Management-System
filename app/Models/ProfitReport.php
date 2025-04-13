<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfitReport extends Model
{
    protected $fillable = [
        "product_id",
        "report_date",
        "sales_revenue",
        "cost",
        "refunded",
        "damaged_loss",
        "total_profit",
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
