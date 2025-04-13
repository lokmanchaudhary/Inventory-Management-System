<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    protected $fillable =
    [
        "title",
        "slug",
        "category_id",
        "sequence",
        "status"
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
