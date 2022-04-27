<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Products;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {

        $carts = [];
        $total = 0;
        $cartCount = null;
        $wishlistCount = null;

        if (Auth::user()) {
            $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
            $cartsMap = collect($carts)->map(function ($cart) use (&$total) {
                $product = Products::where('id', '=', $cart->product_id)->first();
                $cart->quantityProduct = $product->quantity;
                $cart->subTotal = $cart->price * $cart->quantity;
                $total += $cart->subTotal;
                return $cart;
            });
        }

        return view("app.carts")->with(['cartList' => $carts, 'total' => $total]);
    }

    public function create(Request $request)
    {

        $product = Products::find($request->product_id);

        $check_cart = Cart::where('user_id', Auth::user()->id)->where('name', $product->name)->first();
        $cart = new Cart();
        if ($check_cart) {
            $check_cart->size = $request->size;
            $check_cart->color = $request->color;
            $check_cart->quantity = $check_cart->quantity + $request->quantity;
            if ($check_cart->quantity > $product->quantity) {
                $check_cart->quantity = $product->quantity;
            }
            $check_cart->save();
        } else {
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $product->id;
            $cart->name = $product->name;
            $cart->price = $product->promotion_price;
            $cart->image = $product->image;
            $cart->status = 0;
            $cart->size = $request->size;
            $cart->color = $request->color;
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        if ($request->check_wishlist == true) {
            $wishlist = WishList::find($request->wishlist_id);
            $wishlist->delete();

            $wishlistCount = WishList::where('user_id', '=', Auth::user()->id)->count();
            $request->session()->put('wishlistCount', $wishlistCount);
        }
        $cartCount = Cart::where('user_id', '=', Auth::user()->id)->count();
        $request->session()->put('cartCount', $cartCount);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $request->quantity;
        $cart->save();

        return $cart;
    }

    public function destroy(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        $cartCount = Cart::where('user_id', '=', Auth::user()->id)->count();
        $request->session()->put('cartCount', $cartCount);

        return redirect('/carts');
    }
}