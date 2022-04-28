@extends('admin.layouts.nav')
@section('content')
    <h1 class="flex justify-center font-medium leading-tight text-5xl mt-0 mb-2 text-blue-600">{{ $title }}</h1>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    User Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Order total
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Order status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderList as $key => $order)
                                <tr class="border-b">

                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $order->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ number_format($order->order_total) }} VNĐ
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $order->order_status }}
                                    </td>
                                    <td>
                                        @if ($order->order_status === 'Đang chờ xử lý')
                                            <button onclick="shipping('Vận chuyển','','/admin/orders/{{ $order->id }}')"
                                                class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">Vận
                                                chuyển</button>
                                        @endif
                                        @if ($order->order_status === 'Vận chuyển')
                                            <button onclick="shipping('Đã giao','Ok','/admin/orders/{{ $order->id }}')"
                                                class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">Đã
                                                giao hoàn tất</button>
                                        @endif
                                        <button
                                            class="px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-600 active:shadow-lg transition duration-150 ease-in-out"><i
                                                class="fas fa-eye fa-xs"></i></button>
                                        <button
                                            class="px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out "><i
                                                class="fas fa-trash fa-xs"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-4">
                    {{ $orderList->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="mb-52"></div>
@endsection
