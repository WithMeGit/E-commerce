<?php

namespace App\Repositories\Coupon;

use App\Models\Coupon;
use App\Repositories\BaseRepository;

class CouponRepository extends BaseRepository implements CouponInterface
{
    public function __construct(Coupon $model)
    {
        $this->model = $model;
    }

    public function getCouponByName($name_coupon)
    {
        return Coupon::where('code', '=', $name_coupon)->first();
    }
}