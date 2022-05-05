@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="/" class="text-primary text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <p class="text-gray-600 font-medium uppercase">Your Order</p>
    </div>
    <!-- breadcrum end -->

    <div class="container lg:grid grid-cols-12 gap-6 items-start pb-16 pt-4">

        <div class="xl:col-span-9 lg:col-span-8">
            <div class="bg-gray-200 py-2 pl-12 pr-20 xl:pr-28 mb-4 hidden md:flex">
                <p class="text-gray-600 text-center">Customer Name</p>
                <p class="text-gray-600 text-center ml-20">Total Price</p>
                <p class="text-gray-600 text-center ml-48">Status</p>
            </div>
            @foreach ($orders as $key => $order)
                <div class="space-y-4">
                    <div
                        class="flex items-center md:justify-between gap-2 md:gap-4 p-4 border border-gray-200 rounded flex-wrap md:flex-nowrap">
                        <div>
                            {{ $order->name }}
                        </div>
                        <div>
                            {{ number_format($order->order_total) }} VNĐ
                        </div>
                        <div>
                            @if ($order->order_status == 100)
                                Đang chờ xử lý
                            @else
                                @if ($order->order_status == 200)
                                    Vận chuyển
                                @else
                                    Đã giao
                                @endif
                            @endif
                        </div>
                        <div class="text-gray-600 hover:text-primary cursor-pointer">
                            <a href="/order/detail/{{ $order->id }}"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
