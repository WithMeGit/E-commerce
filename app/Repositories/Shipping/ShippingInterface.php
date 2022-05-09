<?php

namespace App\Repositories\Shipping;

use App\Repositories\RepositoryInterface;

interface ShippingInterface extends RepositoryInterface
{
    public function getShippingWithUserLogged();

    public function create($data_shipping);
}