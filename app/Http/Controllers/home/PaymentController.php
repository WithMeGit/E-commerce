<?php

namespace App\Http\Controllers\home;

use App\Constants\OrderStatusConstant;
use App\Constants\PaymentStatusContant;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Coupon\CouponInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Orderdetail\OrderdetailInterface;
use App\Repositories\Payment\PaymentInterface;
use App\Repositories\Shipping\ShippingInterface;
use Illuminate\Support\Facades\Auth;
use Stripe;

class PaymentController extends Controller
{
    protected $orderRepository;
    protected $shippingRepository;
    protected $paymentRepository;
    protected $cartRepository;
    protected $orderdetailRepository;
    protected $couponRepository;

    public function __construct(
        OrderInterface $orderInterface,
        ShippingInterface $shippingInterface,
        PaymentInterface $paymentInterface,
        CartInterface $cartInterface,
        OrderdetailInterface $orderdetailInterface,
        CouponInterface $couponInterface
    ) {
        $this->orderRepository = $orderInterface;
        $this->shippingRepository = $shippingInterface;
        $this->paymentRepository = $paymentInterface;
        $this->cartRepository = $cartInterface;
        $this->orderdetailRepository = $orderdetailInterface;
        $this->couponRepository = $couponInterface;
    }
    public function payment(PaymentRequest $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $request->session()->get('total'),
            "currency" => "vnd",
            "source" => $request->stripeToken,
            "description" => "This is test payment",
        ]);

        $carts = $this->cartRepository->getCartWithuserLogged();
        $payment = $this->paymentRepository->getPaymentWithUserLogged();
        $shipping = $this->shippingRepository->getShippingWithUserLogged();

        //payment
        $data_payment = [];
        $data_payment['user_id'] = Auth::user()->id;
        $data_payment['method'] = $request->method;
        $data_payment['status'] = PaymentStatusContant::PAID_SUCCESSFULLY;

        //shipping
        $data_shipping = [];
        $data_shipping['user_id'] = Auth::user()->id;
        $data_shipping['name'] = $request->name;
        $data_shipping['address'] = $request->address;
        $data_shipping['phone'] = $request->phone;
        $data_shipping['email'] = $request->email;
        $data_shipping['type'] = $request->type;
        $data_shipping['note'] = $request->note;

        if ($request->coupon) {
            $coupon = $this->couponRepository->getCouponByName($request->coupon);
            $coupon->quantity = $coupon->quantity - 1;
            $coupon->save();
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
            $data_order['order_total'] = $request->session()->get('total');
            $data_order['order_status'] = OrderStatusConstant::PENDDING;
            $order = $this->orderRepository->store($data_order);
        } else {
            $payment = $this->paymentRepository->store($data_payment);
            $shipping = $this->shippingRepository->store($data_shipping);

            $data_order = [];
            $data_order['user_id'] = Auth::user()->id;
            $data_order['payment_id'] = $payment->id;
            $data_order['shipping_id'] = $shipping->id;
            $data_order['order_total'] = $request->session()->get('total');
            $data_order['order_status'] = OrderStatusConstant::PENDDING;
            $order = $this->orderRepository->store($data_order);
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
