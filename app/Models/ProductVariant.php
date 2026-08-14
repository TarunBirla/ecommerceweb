<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'sku', 'variant_name', 'price', 'sale_price',
        'stock', 'weight', 'dimensions', 'image', 'barcode', 'attributes_json', 'status'
    ];

    protected $casts = [
        'attributes_json' => 'array',
        'status' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getEffectivePriceAttribute()
    {
        return ($this->sale_price && $this->sale_price < $this->price) ? $this->sale_price : $this->price;
    }
}
