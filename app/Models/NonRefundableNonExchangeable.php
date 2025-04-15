<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonRefundableNonExchangeable extends Model
{
    protected $fillable = [
        "damaged_product_id",
        "product_id",
        "quantity",
        "loss_value",
    ];
}
