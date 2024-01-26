<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_details';

    protected $fillable  = [
        'id',
        'sales_id',
        'inventory_id',
        'qty',
        'price',
    ];

    public function sales()
    {
        return $this->belongsTo('App\Models\Sales', 'id');
    }
    
    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory', 'id');
    }
}
