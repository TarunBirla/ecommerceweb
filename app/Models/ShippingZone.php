<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'pincodes', 'charge', 'status'];

    protected $casts = [
        'pincodes' => 'array',
        'status' => 'boolean',
    ];
}
