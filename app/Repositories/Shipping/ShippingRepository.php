<?php

namespace App\Repositories\Shipping;

use App\Models\Shipping;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class ShippingRepository extends BaseRepository implements ShippingInterface
{
    public function __construct(Shipping $model)
    {
        $this->model = $model;
    }

    public function getShippingWithUserLogged()
    {
        return Shipping::where('user_id', '=', Auth::user()->id)->first();
    }

    public function create($data_shipping)
    {
        return Shipping::create($data_shipping);
    }
}