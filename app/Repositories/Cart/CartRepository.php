<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\User;

class CartRepository implements CartInterface
{
    public $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getAll()
    {
        return $this->cart->paginate(5);
    }

    public function getAllUser()
    {
        return User::all();
    }
}