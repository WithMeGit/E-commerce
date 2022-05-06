<?php

namespace App\Repositories\Order;

use App\Events\NotificationPusherEvent;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderInterface
{
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function getOrderWithUser()
    {
        return $this->order->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('orders.id', 'ASC')
            ->paginate(5);
    }

    public function getAllUser()
    {
        return User::all();
    }

    public function getOrderWithShipping($id)
    {
        return $this->order->join('shippings', 'orders.shipping_id', '=', 'shippings.id')->where('orders.id', '=', $id)->get();
    }

    public function getListOrderDetail($id)
    {
        return $this->order->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('order_details.*', DB::raw('order_details.product_price * order_details.product_quantity as total'))
            ->where('orders.id', '=', $id)
            ->orderBy('orders.id', 'ASC')
            ->get();
    }

    public function getAllProduct()
    {
        return Products::all();
    }

    public function getOrderDetailWithOrder($id)
    {
        return OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')
            ->select('orders.*', 'order_details.*')
            ->where('orders.id', '=', $id)
            ->get();
    }

    public function updateOrder($request, $id)
    {
        $order = $this->order->find($id);
        $order->order_status = $request->value;
        $order->save();
        if ($request->ok) {
            $orders = $this->getOrderDetailWithOrder($id);
            $products = $this->getAllProduct();
            foreach ($orders as $key => $order) {
                foreach ($products as $key => $product) {
                    if ($order->product_id == $product->id) {
                        $product->quantity = $product->quantity - $order->product_quantity;
                        $product->save();
                    }
                }
            }
        }
        event(new NotificationPusherEvent($request->value, $order->user_id));
        return true;
    }

    public function find($id)
    {
        return $this->order->find($id);
    }
}