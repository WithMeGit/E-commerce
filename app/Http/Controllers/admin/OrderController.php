<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Products;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')->select('orders.*', 'users.name')->orderBy('orders.id', 'ASC')->paginate(5);
        $users = User::all();
        return view("admin.order")->with(['orderList' => $orders, 'users' => $users,  'title' => 'List Order']);
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_status = $request->value;
        $order->save();
        if ($request->ok) {
            $orders = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')
                ->select('orders.*', 'order_details.*')->where('orders.id', '=', $id)
                ->get();
            $products = Products::all();
            foreach ($orders as $key => $order) {
                foreach ($products as $key => $product) {
                    if ($order->product_id == $product->id) {
                        $product->quantity = $product->quantity - $order->product_quantity;
                        $product->save();
                    }
                }
            }
        }
        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}