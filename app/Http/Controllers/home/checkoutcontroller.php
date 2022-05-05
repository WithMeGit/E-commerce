<?php

namespace App\Http\Controllers\home;

use App\Constants\OrderStatusConstant;
use App\Constants\PaymentStatusContant;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceOrderRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index(Request $request)
    {
        if ($request->coupon) {
            $coupon = Coupon::where('code', '=', $request->coupon)->first();
            if ($coupon) {
                $carts = [];
                $sum = 0;
                $total = 0;
                $category = Category::all()->where('active', '=', 1);

                $shippings = Shipping::where('user_id', '=', Auth::user()->id)->first();

                $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
                $cartsMap = collect($carts)->map(function ($cart) use (&$sum) {
                    $cart->subTotal = $cart->price * $cart->quantity;
                    $sum += $cart->subTotal;
                    return $cart;
                });
                $total = $sum - ($sum * ($coupon->value / 100));
                if ($shippings) {
                    $payments = Payment::where('user_id', '=', Auth::user()->id)->first();

                    return view("app.checkout")
                        ->with(['carts' => $carts, 'total' => $total, 'coupon' => $coupon, 'sum' => $sum, 'categoryList' => $category, 'shipping' => $shippings, 'payment' => $payments]);
                } else {
                    return view("app.checkout")
                        ->with(['carts' => $carts, 'total' => $total, 'coupon' => $coupon, 'sum' => $sum, 'categoryList' => $category]);
                }
            } else {
                $request->session()->flash("coupon", "The discount code is incorrect");
                return redirect()->back();
            }
        }
        $carts = [];
        $sum = 0;
        $category = Category::all()->where('active', '=', 1);

        $shippings = Shipping::where('user_id', '=', Auth::user()->id)->first();

        $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
        $cartsMap = collect($carts)->map(function ($cart) use (&$sum) {
            $cart->subTotal = $cart->price * $cart->quantity;
            $sum += $cart->subTotal;
            return $cart;
        });
        if ($shippings) {
            $payments = Payment::where('user_id', '=', Auth::user()->id)->first();

            return view("app.checkout")->with(['carts' => $carts, 'sum' => $sum, 'categoryList' => $category, 'shipping' => $shippings, 'payment' => $payments]);
        } else {
            return view("app.checkout")->with(['carts' => $carts, 'sum' => $sum, 'categoryList' => $category]);
        }
    }

    public function placeOrder(PlaceOrderRequest $request)
    {
        $carts = [];
        $total = 0;
        $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
        $cartsMap = collect($carts)->map(function ($cart) use (&$total) {
            $cart->subTotal = $cart->price * $cart->quantity;
            $total += $cart->subTotal;
            return $cart;
        });

        if ($total == 0) {
            $request->session()->flash('placeorder', __('messages.placeorder.fail'));
            return redirect()->back();
        }

        $payment = Payment::where('user_id', '=', Auth::user()->id)->first();
        $shipping = Shipping::where('user_id', '=', Auth::user()->id)->first();
        if ($shipping) {
            $shipping->name = $request->name;
            $shipping->address = $request->address;
            $shipping->phone = $request->phone;
            $shipping->email = $request->email;
            $shipping->type = $request->type;
            $shipping->note = $request->note;
            $shipping->save();
            if ($payment) {
                $payment->method = $request->method;
                $payment->status = PaymentStatusContant::PENDDING_PAYMENT;
                $payment->save();
            } else {
                $payment = Payment::create([
                    'user_id' => Auth::user()->id,
                    'method' => $request->method,
                    'status' => PaymentStatusContant::PENDDING_PAYMENT,
                ]);
            }
            if ($request->coupon) {
                $coupon = Coupon::where('code', '=', $request->coupon)->first();
                $total_coupon = $total - ($total * ($coupon->value / 100));
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'payment_id' => $payment->id,
                    'shipping_id' => $shipping->id,
                    'order_total' => $total_coupon,
                    'order_status' => OrderStatusConstant::PENDDING,
                ]);
                $coupon->quantity = $coupon->quantity - 1;
                $coupon->save();
            } else {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'payment_id' => $payment->id,
                    'shipping_id' => $shipping->id,
                    'order_total' => $total,
                    'order_status' => OrderStatusConstant::PENDDING,
                ]);
            }
            foreach ($carts as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'product_price' => $item->price,
                    'product_quantity' => $item->quantity,
                    'product_size' => $item->size,
                    'product_color' => $item->color,
                ]);

                $del_cart = Cart::find($item->id);
                $del_cart->delete();
            }
            $request->session()->put('cartCount', 0);
            $orderCount = Order::where('user_id', '=', Auth::user()->id)->count();
            $request->session()->put('orderCount', $orderCount);

            return redirect("/order-complete");
        } else {

            $payment = Payment::create([
                'user_id' => Auth::user()->id,
                'method' => $request->method,
                'status' => PaymentStatusContant::PENDDING_PAYMENT,
            ]);

            $shipping = Shipping::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => $request->type,
                'note' => $request->note,
            ]);
            if ($request->coupon) {
                $coupon = Coupon::where('code', '=', $request->coupon)->first();
                $total_coupon = $total - ($total * ($coupon->value / 100));
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'payment_id' => $payment->id,
                    'shipping_id' => $shipping->id,
                    'order_total' => $total_coupon,
                    'order_status' => OrderStatusConstant::PENDDING,
                ]);
                $coupon->quantity = $coupon->quantity - 1;
                $coupon->save();
            } else {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'payment_id' => $payment->id,
                    'shipping_id' => $shipping->id,
                    'order_total' => $total,
                    'order_status' => OrderStatusConstant::PENDDING,
                ]);
            }

            foreach ($carts as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->name,
                    'product_price' => $item->price,
                    'product_quantity' => $item->quantity,
                    'product_size' => $item->size,
                    'product_color' => $item->color,
                ]);

                $del_cart = Cart::find($item->id);
                $del_cart->delete();
            }
            $request->session()->put('cartCount', 0);
            $orderCount = Order::where('user_id', '=', Auth::user()->id)->count();
            $request->session()->put('orderCount', $orderCount);

            return redirect("/order-complete");
        }
    }
}