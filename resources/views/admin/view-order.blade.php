@extends('admin.layouts.nav')
@section('content')
    <h1 class="flex justify-center font-medium leading-tight text-5xl mt-0 mb-2 text-blue-600">Shipping</h1>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Receiver Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Email
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Address
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Phone
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Method
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Note
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $order->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $order->email }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $order->address }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $order->phone }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        @if ($order->type == 100)
                                            Ship tận nhà
                                        @else
                                            @if ($order->order_status == 200)
                                                Ship tới địa chỉ khác
                                            @else
                                                Ship hàng thu tiền hộ
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $order->note }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h1 class="flex justify-center font-medium leading-tight text-5xl mt-10 mb-2 text-blue-600">Ordered Products</h1>
    <div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Product Name
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Product Price
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Product Quantity
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Product Size
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Product Color
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listorderdetails as $key => $order)
                                    <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $order->product_name }}</td>
                                        <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                            {{ number_format($order->product_price) }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                            {{ $order->product_quantity }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                            {{ $order->product_size }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                            {{ $order->product_color }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                            {{ number_format($order->total) }} VNĐ
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-52"></div>
@endsection
