<?php

namespace App\Models;

use App\Enums\Product\PackagingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "quantity",
        "date_of_manufacture",
        "date_of_expiry",
        "base_price",
        "display_price",
        "status",
        "packaging_type",
    ];

    protected $casts = [
        "packaging_type" => PackagingType::class,
    ];
    public function damagedProducts(): HasMany
    {
        return $this->hasMany(DamagedProduct::class);
    }

    public function exchanges(): HasMany
    {
        return $this->hasMany(ProductExchange::class, 'exchanged_product_id');
    }
//    public function profit(): HasOne
//    {
//        return $this->hasOne(ProfitReport::class, 'product_id');
//    }

}
