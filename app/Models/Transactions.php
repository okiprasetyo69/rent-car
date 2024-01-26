<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable  = [
        'id',
        'user_id',
        'item_id',
        'qty',
        'price'
    ];

    public function item(){
        return $this->belongsTo(Items::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
