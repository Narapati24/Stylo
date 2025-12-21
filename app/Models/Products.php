<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'stock',
        'description',
        'thumbnail',

    ];

    // filter category
    public function scopeFilterCategory($query, $categoryId)
    {
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
    }
}
