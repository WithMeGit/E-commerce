<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $productTopNewArrival = Products::all()->where('active', '=', 1)->random(4);
        $productRecomended = Products::all()->where('active', '=', 1)->random(8);
        $category = Category::all()->where('active', '=', 1);
        if (Auth::user()) {
            $orderCount = Order::where('user_id', '=', Auth::user()->id)->count();
            $request->session()->put('orderCount', $orderCount);
            $wishlistCount = WishList::where('user_id', '=', Auth::user()->id)->count();
            $request->session()->put('wishlistCount', $wishlistCount);
            $cartCount = Cart::where('user_id', '=', Auth::user()->id)->count();
            $request->session()->put('cartCount', $cartCount);
        }
        return view("app.home")->with([
            'productTopNewArrival' => $productTopNewArrival,
            'productRecomended' => $productRecomended, 'categoryList' => $category,
        ]);
    }

    public function searchAutocomplete(Request $request)
    {
        $data = Products::where("name", 'like', "%{$request->search_name}%")->select('id', 'name')->get();

        $output = '<ul class="z-50 absolute mt-12 w-9/12 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">';
        foreach ($data as $item) {
            $output .= '<li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600"><a href="/products/detail/' . $item->id . '">' . $item->name . '</a></li>';
        }
        $output .= '</ul>';

        echo $output;
    }
}