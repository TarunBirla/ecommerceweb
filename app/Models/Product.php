<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'sku', 'category_id', 'brand_id',
        'price', 'sale_price', 'cost_price', 'stock', 'min_stock_warning',
        'description', 'specifications', 'faqs',
        'is_active', 'is_featured', 'is_trending', 'is_new_arrival', 'has_variants',
        'rating_avg', 'reviews_count', 'warranty_info', 'return_policy_info',
        'seo_title', 'seo_description'
    ];

    protected $casts = [
        'specifications' => 'array',
        'faqs' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_trending' => 'boolean',
        'is_new_arrival' => 'boolean',
        'has_variants' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }

    public function getEffectivePriceAttribute()
    {
        return ($this->sale_price && $this->sale_price < $this->price) ? $this->sale_price : $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price && $this->sale_price < $this->price) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }
}
