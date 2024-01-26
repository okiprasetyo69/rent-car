<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnCars extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'car_id', 
        'return_date', 
        'total_day_rent',
        'total_price_rent',
    ];

    public function cars(){
        return $this->belongsTo(Cars::class, 'id');
    }
}
