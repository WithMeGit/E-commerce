<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_id',
        'shipping_id',
        'order_total',
        'order_status',
    ];

    public function OrderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}