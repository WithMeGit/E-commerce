<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Repositories\Wishlist\WishlistInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    protected $wishlistRepository;

    public function __construct(WishlistInterface $wishListInterface)
    {
        $this->wishlistRepository = $wishListInterface;
    }
    public function index()
    {
        $category = $this->wishlistRepository->getCategoryActive();
        if (Auth::user()) {
            $this->wishlistRepository->countItem(request());
        }

        $wishlists = $this->wishlistRepository->getWishListWithUserLogged();
        collect($wishlists)->map(function ($wishlist) {
            $product = $this->wishlistRepository->getProductInWishlist($wishlist->product_id);
            $wishlist->nameProduct = $product->name;
            $wishlist->imageProduct = $product->image;
            $wishlist->quantityProduct = $product->quantity;
            $wishlist->priceProduct = $product->promotion_price;
            return $wishlist;
        });


        return view("app.wishlist")->with(['wishlists' => $wishlists, 'categoryList' => $category]);
    }

    public function create(Request $request)
    {
        if ($this->wishlistRepository->checkProductInWishList($request->product_id) == true) {
            return redirect()->back();
        } else {
            $wishlist = [];
            $wishlist['user_id'] = Auth::user()->id;
            $wishlist['product_id'] = $request->product_id;
            $this->wishlistRepository->store($wishlist);
        }
        $wishlistCount = $this->wishlistRepository->CountWishList();
        $request->session()->put('wishlistCount', $wishlistCount);
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if ($this->wishlistRepository->delete($id) == true) {
            $wishlistCount = $this->wishlistRepository->CountWishList();
            $request->session()->put('wishlistCount', $wishlistCount);
            return redirect('/wishlist');
        }
    }
}
