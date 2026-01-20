<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'nopol',
        'price_per_day',
        'transmission',
        'capacity',
        'image',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];
}
