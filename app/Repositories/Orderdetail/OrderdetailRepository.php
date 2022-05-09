<?php

namespace App\Repositories\Orderdetail;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;

class OrderdetailRepository extends BaseRepository implements OrderdetailInterface
{
    public function __construct(OrderDetail $model)
    {
        $this->model = $model;
    }
}