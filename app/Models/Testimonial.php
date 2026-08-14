<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name', 'client_title', 'client_avatar', 'company_name',
        'content', 'rating', 'is_featured', 'status'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];
}
