<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchases';

    protected $fillable  = [
        'id',
        'number',
        'date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}
