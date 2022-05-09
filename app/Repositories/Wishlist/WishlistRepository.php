<?php

namespace App\Repositories\Wishlist;

use App\Models\Products;
use App\Models\WishList;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class WishlistRepository extends BaseRepository implements WishListInterface
{

    public function __construct(WishList $model)
    {
        $this->model = $model;
    }

    public function getWishListWithUserLogged()
    {
        return WishList::where('user_id', '=', Auth::user()->id)->get();
    }

    public function getProductInWishlist($product_id)
    {
        return Products::where('id', '=', $product_id)->first();
    }

    public function CountWishList()
    {
        return WishList::where('user_id', '=', Auth::user()->id)->count();
    }

    public function checkProductInWishList($product_id)
    {
        $check_wishlist = WishList::where('product_id', '=', $product_id)->first();
        if ($check_wishlist) {
            return true;
        } else {
            return false;
        }
    }
}