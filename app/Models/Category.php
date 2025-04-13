<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable =
    [
        "title",
        "slug",
        "status",
        'sequence',
    ];
    public function subcategories(): hasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
