<?php

namespace App\Repositories\Coupon;

use App\Models\Coupon;

class CouponRepository implements CouponInterface
{
    public $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }
    public function getAll()
    {
        return $this->coupon->paginate(5);
    }

    public function store($request)
    {
        $this->coupon::create($request->all());
    }

    public function update($request, $id)
    {
        $coupon = $this->coupon->find($id);
        $coupon->code = $request->code;
        $coupon->value = $request->value;
        $coupon->quantity = $request->quantity;
        $coupon->save();
    }

    public function find($id)
    {
        return $this->coupon->find($id);
    }

    public function delete($id)
    {
        $this->coupon->find($id)->delete($id);
        return TRUE;
    }
}