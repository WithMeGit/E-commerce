<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderInterface extends RepositoryInterface
{
    public function create($data);

    public function getOrderWithUser();

    public function getOrderWithUserLogged();

    public function getAllUser();

    public function getOrderWithShipping($id);

    public function getOrderWithShippingLogged($id);

    public function getListOrderDetail($id);

    public function getOrderDetailWithOrder($id);

    public function getAllProduct();

    public function updateOrder($request, $id);

    public function countOrder();
}