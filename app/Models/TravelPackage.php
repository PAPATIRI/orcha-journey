<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    use HasFactory;
    protected $table = 'tbl_travel_package';
    protected $fillable = [
        'name',
        'price',
        'original_price',
        'discount_percentage',
        'is_best_choice',
        'destination_list'
    ];


    protected $casts = [
        'destination_list' => 'array',
    ];
}
