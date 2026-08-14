<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'cost', 'free_shipping_threshold', 'estimated_days', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
