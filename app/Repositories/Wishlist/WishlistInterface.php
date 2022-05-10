<?php

namespace App\Repositories\Wishlist;

use App\Repositories\RepositoryInterface;

interface WishlistInterface extends RepositoryInterface
{
    public function getWishListWithUserLogged();

    public function getProductInWishlist($product_id);

    public function CountWishList();

    public function checkProductInWishList($product_id);
}
