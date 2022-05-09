<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Wishlist\WishListInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartRepository;
    protected $productRepository;
    protected $wishlistRepository;

    public function __construct(
        CartInterface $cartInterface,
        ProductInterface $productInterface,
        WishListInterface $wishListInterface
    ) {
        $this->cartRepository = $cartInterface;
        $this->productRepository = $productInterface;
        $this->wishlistRepository = $wishListInterface;
    }
    public function index()
    {
        if (Auth::user()) {
            $this->cartRepository->countItem(request());
        }

        $total = 0;
        $carts = $this->cartRepository->getCartWithuserLogged();
        collect($carts)->map(function ($cart) use (&$total) {
            $product = $this->cartRepository->getProductInCart($cart->product_id);
            $cart->quantityProduct = $product->quantity;
            $cart->subTotal = $cart->price * $cart->quantity;
            $total += $cart->subTotal;
            return $cart;
        });

        $category = $this->cartRepository->getCategoryActive();

        return view("app.carts")->with(['cartList' => $carts, 'total' => $total, 'categoryList' => $category]);
    }

    public function create(Request $request)
    {

        $product = $this->productRepository->find($request->product_id);

        $check_cart = $this->cartRepository->getCartWithuserLoggedByProductName($product->name);

        if ($check_cart) {
            $check_cart->size = $request->size;
            $check_cart->color = $request->color;
            $check_cart->quantity = $request->quantity;
            if ($check_cart->quantity > $product->quantity) {
                $check_cart->quantity = $product->quantity;
            }
            $check_cart->save();
            return redirect('/carts');
        } else {
            $cart = [];
            $cart['user_id'] = Auth::user()->id;
            $cart['product_id'] = $product->id;
            $cart['name'] = $product->name;
            $cart['price'] = $product->promotion_price;
            $cart['image'] = $product->image;
            $cart['status'] = 0;
            $cart['size'] = $request->size;
            $cart['color'] = $request->color;
            $cart['quantity'] = $request->quantity;
            $this->cartRepository->store($cart);
        }

        if ($request->check_wishlist == true) {
            if ($this->wishlistRepository->delete($request->wishlist_id == true)) {
                $wishlistCount = $this->wishlistRepository->CountWishList();
                $request->session()->put('wishlistCount', $wishlistCount);
            }
        }
        $cartCount = $this->cartRepository->countCart();
        $request->session()->put('cartCount', $cartCount);

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if ($this->cartRepository->delete($id) == true) {
            $cartCount = $this->cartRepository->countCart();
            $request->session()->put('cartCount', $cartCount);

            return redirect('/carts');
        }
    }

    public function applyCoupon(Request $request)
    {
        return $this->cartRepository->checkCoupon($request->coupon);
    }
}