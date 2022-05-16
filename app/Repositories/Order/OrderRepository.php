<?php

namespace App\Repositories\Order;

use App\Constants\PaymentStatusContant;
use App\Events\NotificationPusherEvent;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Products;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderInterface
{

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function getOrderWithUser()
    {
        return $this->model->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('orders.id', 'ASC')
            ->paginate(5);
    }

    public function getOrderWithUserLogged()
    {
        return $this->model->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->where('users.id', '=', Auth::user()->id)
            ->orderBy('orders.id', 'ASC')->paginate(5);
    }

    public function getAllUser()
    {
        return User::all();
    }

    public function getOrderWithShipping($id)
    {
        return $this->model->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
            ->where('orders.id', '=', $id)
            ->get();
    }

    public function getOrderWithShippingLogged($id)
    {
        return $this->model->join('shippings', 'orders.shipping_id', '=', 'shippings.id')
            ->where('orders.id', '=', $id)
            ->get();
    }

    public function getListOrderDetail($id)
    {
        return $this->model->join('order_details', 'orders.id', '=', 'order_details.order_id')
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

    public function getPaymentWithOrder($id)
    {
        return Payment::join('orders', 'payments.id', '=', 'orders.payment_id')
            ->select('payments.*')
            ->where('orders.id', '=', $id)
            ->get();
    }

    public function updateOrder($request, $id)
    {
        $order = $this->find($id);
        $order->order_status = $request->value;
        $order->save();
        if ($request->ok) {
            $orderdetail = $this->getOrderDetailWithOrder($id);
            $products = $this->getAllProduct();
            foreach ($orderdetail as $key => $order) {
                foreach ($products as $key => $product) {
                    if ($order->product_id == $product->id) {
                        $product->quantity = $product->quantity - $order->product_quantity;
                        $product->save();
                    }
                }
            }

            $payment = $this->getPaymentWithOrder($id);
            $payment->status = PaymentStatusContant::PAID_SUCCESSFULLY;
            $payment->save();
        }
        event(new NotificationPusherEvent($request->value, $order->user_id));
        return true;
    }

    public function countOrder()
    {
        return $this->model->where('user_id', '=', Auth::user()->id)->count();
    }
}
