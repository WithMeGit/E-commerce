<?php

namespace App\Repositories\Coupon;

use App\Repositories\RepositoryInterface;

interface CouponInterface extends RepositoryInterface
{
    public function getCouponByName($name_coupon);
}