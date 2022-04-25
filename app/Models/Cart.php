<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'name',
        'image',
        'price',
        'size',
        'color',
        'quantity',
        'status',
    ];

    public function getPriceAttribute($value){
        return intval(str_replace('.','',$value));
    }
}
