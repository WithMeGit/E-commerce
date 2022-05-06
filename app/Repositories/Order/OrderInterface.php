<?php

namespace App\Repositories\Order;

interface OrderInterface
{
    public function getOrderWithUser();

    public function getAllUser();

    public function getOrderWithShipping($id);

    public function getListOrderDetail($id);

    public function getOrderDetailWithOrder($id);

    public function getAllProduct();

    public function updateOrder($request, $id);

    public function find($id);
}