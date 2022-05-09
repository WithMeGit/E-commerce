<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Products;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class CartRepository extends BaseRepository implements CartInterface
{

    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

    public function getAllUser()
    {
        return User::all();
    }

    public function getCartWithuserLogged()
    {
        return Cart::where('user_id', '=', Auth::user()->id)->get();
    }

    public function getCartWithuserLoggedByProductName($product_name)
    {
        return Cart::where('user_id', Auth::user()->id)->where('name', $product_name)->first();
    }

    public function getProductInCart($proudct_id)
    {
        return Products::where('id', '=', $proudct_id)->first();
    }

    public function countCart()
    {
        return Cart::where('user_id', '=', Auth::user()->id)->count();
    }

    public function checkCoupon($name_coupon)
    {
        $coupon = Coupon::select('code')->get();
        foreach ($coupon as $key => $item) {
            if ($name_coupon == $item->code) {
                return 1;
            }
        }
        return 0;
    }
}