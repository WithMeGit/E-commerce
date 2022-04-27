<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->where('users.id', '=', Auth::user()->id)
            ->orderBy('orders.id', 'ASC')->paginate(5);
        $category = Category::all()->where('active', '=', 1);

        return view("app.orders")->with(['orders' => $orders, 'categoryList' => $category]);
    }

    public function orderdetail($id)
    {
        $order = Order::join('shippings', 'orders.shipping_id', '=', 'shippings.id')->where('orders.id', '=', $id)->get();
        $listOrderdetail = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('order_details.*', DB::raw('order_details.product_price * order_details.product_quantity as total'))
            ->where('orders.id', '=', $id)
            ->orderBy('orders.id', 'ASC')->get();
        $category = Category::all()->where('active', '=', 1);

        return view("app.order-detail")->with([
            'listorderdetails' => $listOrderdetail,
            'orders' => $order,
            'categoryList' => $category
        ]);
    }
}