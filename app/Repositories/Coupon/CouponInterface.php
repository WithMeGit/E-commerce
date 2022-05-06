<?php

namespace App\Repositories\Coupon;

interface CouponInterface
{
    public function getAll();

    public function store($request);

    public function update($request, $id);

    public function find($id);

    public function delete($id);
}