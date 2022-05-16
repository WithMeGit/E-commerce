<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderInterface;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderRepository = $orderInterface;
    }

    public function index()
    {
        if (Auth::user()) {
            $this->orderRepository->countItem(request());
        }

        $orders = $this->orderRepository->getOrderWithUserLogged();
        $category = $this->orderRepository->getCategoryActive();

        return view("app.orders")->with(['orders' => $orders, 'categoryList' => $category]);
    }

    public function orderdetail($id)
    {
        $order = $this->orderRepository->getOrderWithShippingLogged($id);
        $listOrderdetail = $this->orderRepository->getListOrderDetail($id);
        $payment = $this->orderRepository->getPaymentWithOrder($id);
        $category = $this->orderRepository->getCategoryActive();

        return view("app.order-detail")->with([
            'listorderdetails' => $listOrderdetail,
            'orders' => $order,
            'categoryList' => $category,
            'payments' => $payment,
        ]);
    }
}
