<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundedProduct extends Model
{
    protected $fillable = [
        "damaged_product_id",
        "product_id",
        "quantity",
        "refunded_amount",
    ];
}
