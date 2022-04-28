@extends('admin.layouts.nav')
@section('content')
    <h1 class="flex justify-center font-medium leading-tight text-5xl mt-0 mb-2 text-blue-600">{{ $title }}</h1>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full ml-4">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    User Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Product Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Product Image
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Product Size
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Product Color
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Product Price
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Product Quantity
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Total
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartList as $key => $cart)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        @foreach ($userList as $key => $user)
                                            @if ($cart->user_id == $user->id)
                                                {{ $user->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $cart->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        <img class="rounded-lg w-32" src="{{ $cart->image }}">
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $cart->size }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $cart->color }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ number_format($cart->price) }} VNĐ
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ $cart->quantity }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                        {{ number_format($cart->price * $cart->quantity) }} VNĐ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-4">
                    {{ $cartList->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="mb-72"></div>
@endsection
