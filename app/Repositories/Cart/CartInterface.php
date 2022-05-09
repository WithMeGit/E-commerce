<?php

namespace App\Repositories\Cart;

use App\Repositories\RepositoryInterface;

interface CartInterface extends RepositoryInterface
{
    public function getAllUser();

    public function getCartWithuserLogged();

    public function getCartWithuserLoggedByProductName($product_name);

    public function getProductInCart($proudct_id);

    public function countCart();

    public function checkCoupon($name_coupon);
}