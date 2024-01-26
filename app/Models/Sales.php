<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable  = [
        'id',
        'number',
        'date',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'user_id', 'id');
    }
    

}
