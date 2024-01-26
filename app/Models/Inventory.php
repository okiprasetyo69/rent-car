<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $fillable  = [
        'id',
        'code',
        'name',
        'price',
        'stock'
    ];

    public function purchase()
    {
        return $this->hasMany('App\Models\PurchaseDetail');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\SalesDetail');
    }
}
