<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'stock',
        'description',
        'thumbnail',

    ];


    public function getImageUrlAttribute()
    {
        if ($this->thumbnail && str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        return $this->thumbnail
            ? asset('storage/' . $this->thumbnail)
            : 'https://via.placeholder.com/150';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // filter category
    public function scopeFilterCategory($query, $categoryId)
    {
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
    }

    // search
    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }
    }
}
