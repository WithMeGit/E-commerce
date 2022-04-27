<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {


        if (Auth::user()) {
            $wishlists = WishList::where('user_id', '=', Auth::user()->id)->get();
            $wishlistsMap = collect($wishlists)->map(function ($wishlist) {
                $product = Products::where('id', '=', $wishlist->product_id)->first();
                $wishlist->idProduct = $product->id;
                $wishlist->nameProduct = $product->name;
                $wishlist->imageProduct = $product->image;
                $wishlist->quantityProduct = $product->quantity;
                $wishlist->priceProduct = $product->promotion_price;
                return $wishlist;
            });
            $category = Category::all()->where('active', '=', 1);
        }

        return view("app.wishlist")->with(['wishlists' => $wishlists, 'categoryList' => $category]);
    }

    public function create(Request $request)
    {
        $wishlist = new WishList();

        $check_wishlist = WishList::where('product_id', '=', $request->product_id)->first();
        if ($check_wishlist) {
            return redirect('/wishlist');
        } else {
            $wishlist->user_id = Auth::user()->id;
            $wishlist->product_id = $request->product_id;
            $wishlist->save();
        }
        $wishlistCount = WishList::where('user_id', '=', Auth::user()->id)->count();
        $request->session()->put('wishlistCount', $wishlistCount);
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $wishlist = WishList::find($id);
        $wishlist->delete();

        $wishlistCount = WishList::where('user_id', '=', Auth::user()->id)->count();
        $request->session()->put('wishlistCount', $wishlistCount);
        return redirect('/wishlist');
    }
}