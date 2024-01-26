<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name', 
        'model', 
        'plat_number', 
        'price_rent',
        'is_available'
    ];
}
