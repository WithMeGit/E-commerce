<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Products;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $cartCount = null;
        $wishlistCount = null;

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

            $cartCount = Cart::where('user_id', '=', Auth::user()->id)->count();
            $wishlistCount = WishList::where('user_id', '=', Auth::user()->id)->count();
        }

        return view("app.wishlist")->with(['wishlists' => $wishlists, 'cartCount' => $cartCount, 'wishlistCount' => $wishlistCount]);
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
        return redirect('/wishlist');
    }

    public function destroy($id)
    {
        $wishlist = WishList::find($id);
        $wishlist->delete();
        return redirect('/wishlist');
    }
}