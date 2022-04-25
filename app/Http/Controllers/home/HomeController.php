<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $productTopNewArrival = Products::all()->where('active', '=', 1)->random(4);
        $productRecomended = Products::all()->where('active', '=', 1)->random(8);
        $category = Category::all()->where('active', '=', 1);
        $cartCount = null;
        $wishlistCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', '=', Auth::user()->id)->count();
            $wishlistCount = WishList::where('user_id', '=', Auth::user()->id)->count();
        }

        return view("app.home")->with([
            'productTopNewArrival' => $productTopNewArrival,
            'productRecomended' => $productRecomended, 'categoryList' => $category,
            'cartCount' => $cartCount, 'wishlistCount' => $wishlistCount,
        ]);
    }
}