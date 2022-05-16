<?php

namespace App\Http\Controllers\home;

use App\Constants\OrderStatusConstant;
use App\Constants\PaymentStatusContant;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceOrderRequest;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Coupon\CouponInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Orderdetail\OrderdetailInterface;
use App\Repositories\Payment\PaymentInterface;
use App\Repositories\Shipping\ShippingInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    protected $orderRepository;
    protected $orderdetailRepository;
    protected $cartRepository;
    protected $couponRepository;
    protected $shippingRepository;
    protected $paymentRepository;

    public function __construct(
        OrderInterface $orderInterface,
        OrderdetailInterface $orderdetailInterface,
        CartInterface $cartInterface,
        CouponInterface $couponInterface,
        ShippingInterface $shippingInterface,
        PaymentInterface $paymentInterface
    ) {
        $this->orderRepository = $orderInterface;
        $this->orderdetailRepository = $orderdetailInterface;
        $this->cartRepository = $cartInterface;
        $this->couponRepository = $couponInterface;
        $this->shippingRepository = $shippingInterface;
        $this->paymentRepository = $paymentInterface;
    }
    public function index(Request $request)
    {
        $carts = [];
        $sum = 0;
        $total = 0;
        $category = $this->orderRepository->getCategoryActive();
        if (Auth::user()) {
            $this->orderRepository->countItem(request());
        }
        $shippings = $this->shippingRepository->getShippingWithUserLogged();
        $payments = $this->paymentRepository->getPaymentWithUserLogged();
        $carts = $this->cartRepository->getCartWithuserLogged();

        collect($carts)->map(function ($cart) use (&$sum) {
            $cart->subTotal = $cart->price * $cart->quantity;
            $sum += $cart->subTotal;
            return $cart;
        });

        if ($request->coupon) {
            $coupon = $this->couponRepository->getCouponByName($request->coupon);
            if ($coupon && $coupon->quantity > 0) {
                $total = $sum - ($sum * ($coupon->value / 100));
                if ($shippings) {

                    return view("app.checkout")
                        ->with([
                            'carts' => $carts, 'total' => $total, 'coupon' => $coupon,
                            'sum' => $sum, 'categoryList' => $category, 'shipping' => $shippings,
                            'payment' => $payments
                        ]);
                } else {
                    return view("app.checkout")
                        ->with([
                            'carts' => $carts, 'total' => $total, 'coupon' => $coupon,
                            'sum' => $sum, 'categoryList' => $category
                        ]);
                }
            } else {
                $request->session()->flash("coupon", "The discount code is incorrect or unavailable");
                return redirect()->back();
            }
        }

        if ($shippings) {

            return view("app.checkout")->with([
                'carts' => $carts, 'sum' => $sum, 'categoryList' => $category,
                'shipping' => $shippings, 'payment' => $payments
            ]);
        } else {
            return view("app.checkout")->with(['carts' => $carts, 'sum' => $sum, 'categoryList' => $category]);
        }
    }

    public function placeOrder(PlaceOrderRequest $request)
    {
        $category = $this->cartRepository->getCategoryActive();
        $carts = [];
        $total = 0;
        $carts = $this->cartRepository->getCartWithuserLogged();

        $payment = $this->paymentRepository->getPaymentWithUserLogged();
        $shipping = $this->shippingRepository->getShippingWithUserLogged();

        collect($carts)->map(function ($cart) use (&$total) {
            $cart->subTotal = $cart->price * $cart->quantity;
            $total += $cart->subTotal;
            return $cart;
        });

        if ($total == 0) {
            $request->session()->flash('placeorder', __('messages.placeorder.fail'));
            return redirect()->back();
        }

        //payment
        $data_payment = [];
        $data_payment['user_id'] = Auth::user()->id;
        $data_payment['method'] = $request->method;
        $data_payment['status'] = PaymentStatusContant::PENDDING_PAYMENT;

        //shipping
        $data_shipping = [];
        $data_shipping['user_id'] = Auth::user()->id;
        $data_shipping['name'] = $request->name;
        $data_shipping['address'] = $request->address;
        $data_shipping['phone'] = $request->phone;
        $data_shipping['email'] = $request->email;
        $data_shipping['type'] = $request->type;
        $data_shipping['note'] = $request->note;

        if ($request->method == 200) {
            if ($request->coupon) {
                $coupon = $this->couponRepository->getCouponByName($request->coupon);
                $total_coupon = $total - ($total * ($coupon->value / 100));
                $request->session()->put('total', $total_coupon);
                return view('app.payment')->with(['categoryList' => $category, 'request' => $request->all()]);
            } else {
                $request->session()->put('total', $total);
                return view('app.payment')->with(['categoryList' => $category, 'request' => $request->all()]);
            }
        }
        if ($shipping) {
            $shipping->name = $request->name;
            $shipping->address = $request->address;
            $shipping->phone = $request->phone;
            $shipping->email = $request->email;
            $shipping->type = $request->type;
            $shipping->note = $request->note;
            $shipping->save();

            $payment = $this->paymentRepository->store($data_payment);

            $data_order = [];
            $data_order['user_id'] = Auth::user()->id;
            $data_order['payment_id'] = $payment->id;
            $data_order['shipping_id'] = $shipping->id;
            $data_order['order_status'] = OrderStatusConstant::PENDDING;

            if ($request->coupon) {
                $coupon = $this->couponRepository->getCouponByName($request->coupon);
                $total_coupon = $total - ($total * ($coupon->value / 100));

                $data_order['order_total'] = $total_coupon;
                $order = $this->orderRepository->store($data_order);
                $coupon->quantity = $coupon->quantity - 1;
                $coupon->save();
            } else {
                $data_order['order_total'] = $total;
                $order = $this->orderRepository->store($data_order);
            }
        } else {
            $payment = $this->paymentRepository->store($data_payment);
            $shipping = $this->shippingRepository->store($data_shipping);

            $data_order = [];
            $data_order['user_id'] = Auth::user()->id;
            $data_order['payment_id'] = $payment->id;
            $data_order['shipping_id'] = $shipping->id;
            $data_order['order_status'] = OrderStatusConstant::PENDDING;

            if ($request->coupon) {
                $coupon = $this->couponRepository->getCouponByName($request->coupon);
                $total_coupon = $total - ($total * ($coupon->value / 100));
                $data_order['order_total'] = $total_coupon;
                $order = $this->orderRepository->store($data_order);
                $coupon->quantity = $coupon->quantity - 1;
                $coupon->save();
            } else {
                $data_order['order_total'] = $total;
                $order = $this->orderRepository->store($data_order);
            }
        }

        foreach ($carts as $item) {
            $data_orderDetail = [];
            $data_orderDetail['order_id'] = $order->id;
            $data_orderDetail['product_id'] = $item->product_id;
            $data_orderDetail['product_name'] = $item->name;
            $data_orderDetail['product_price'] = $item->price;
            $data_orderDetail['product_quantity'] = $item->quantity;
            $data_orderDetail['product_size'] = $item->size;
            $data_orderDetail['product_color'] = $item->color;

            $this->orderdetailRepository->store($data_orderDetail);

            $this->cartRepository->delete($item->id);
        }

        $request->session()->put('cartCount', 0);
        $orderCount = $this->orderRepository->countOrder();
        $request->session()->put('orderCount', $orderCount);

        return redirect("/order-complete");
    }
}
