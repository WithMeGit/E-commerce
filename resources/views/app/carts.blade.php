@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="/" class="text-primary text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <p class="text-gray-600 font-medium uppercase">Shopping Cart</p>
    </div>
    <!-- breadcrum end -->

    <!-- cart wrapper -->
    <div class="container lg:grid grid-cols-12 gap-6 items-start pb-16 pt-4">
        <!-- product cart -->
        <div class="xl:col-span-9 lg:col-span-8">
            <!-- cart title -->
            <div class="bg-gray-200 py-2 pl-12 pr-20 xl:pr-28 mb-4 hidden md:flex">
                <p class="text-gray-600 text-center">Product</p>
                <p class="text-gray-600 text-center ml-auto mr-16 xl:mr-24">Quantity</p>
                <p class="text-gray-600 text-center">Total</p>
            </div>
            <!-- cart title end -->

            <!-- shipping carts -->
            <div class="space-y-4">
                @foreach ($cartList as $key => $cart)
                    <!-- single cart -->
                    <div
                        class="flex items-center md:justify-between gap-4 md:gap-6 p-4 border border-gray-200 rounded flex-wrap md:flex-nowrap">
                        <!-- cart image -->
                        <div class="w-32 flex-shrink-0">
                            <img src="{{ $cart->image }}" class="w-full">
                        </div>
                        <!-- cart image end -->
                        <!-- cart content -->
                        <div class="md:w-1/3 w-full">
                            <h2 class="text-gray-800 mb-3 xl:text-xl textl-lg font-medium uppercase">
                                {{ $cart->name }}
                            </h2>
                            <p class="text-primary font-semibold">{{ number_format($cart->price) }} VNĐ</p>
                            <p class="text-gray-500">Size: {{ $cart->size }}</p>
                            <div class="mt-4">
                                <h3 class="text-base text-gray-800 mb-1">Color</h3>
                                <div class="flex items-center gap-2">
                                    <!-- single color -->
                                    @if ($cart->color == 'white')
                                        <div class="color-selector">
                                            <input type="radio" name="color" class="hidden" value="white">
                                            <label style="background-color : #ffffff"
                                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                            </label>
                                        </div>
                                    @endif
                                    @if ($cart->color == 'black')
                                        <div class="color-selector">
                                            <input type="radio" name="color" class="hidden" value="black">
                                            <label style="background-color : #000"
                                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                            </label>
                                        </div>
                                    @endif
                                    @if ($cart->color == 'red')
                                        <div class="color-selector">
                                            <input type="radio" name="color" class="hidden" value="red">
                                            <label style="background-color : #f50707"
                                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                            </label>
                                        </div>
                                    @endif
                                    @if ($cart->color == 'blue')
                                        <div class="color-selector">
                                            <input type="radio" name="color" class="hidden" value="blue">
                                            <label style="background-color : #24d1f8"
                                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                            </label>
                                        </div>
                                    @endif
                                    @if ($cart->color == 'green')
                                        <div class="color-selector">
                                            <input type="radio" name="color" class="hidden" value="green">
                                            <label style="background-color : #50dc0a"
                                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                            </label>
                                        </div>
                                    @endif
                                    @if ($cart->color == 'yellow')
                                        <div class="color-selector">
                                            <input type="radio" name="color" class="hidden" value="yellow">
                                            <label style="background-color : #fad520"
                                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                            </label>
                                        </div>
                                    @endif
                                    @if ($cart->color == 'pink')
                                        <div class="color-selector">
                                            <input type="radio" name="color" class="hidden" value="pink">
                                            <label style="background-color : #de09ee"
                                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                                            </label>
                                        </div>
                                    @endif
                                    <!-- single color end -->
                                </div>
                            </div>
                        </div>
                        <!-- cart content end -->
                        <!-- cart quantity -->
                        <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300">
                            <input type="button" onclick="decreaseQuantityCart({{ $cart->id }})" value="-"
                                class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none" />
                            <input type="text" class="h-8 w-16 flex items-center justify-center"
                                id="quantity_{{ $cart->id }}" name="quantity" value="{{ $cart->quantity }}"
                                readonly />
                            <input type="button"
                                onclick="incrementQuantityCart({{ $cart->id }},{{ $cart->quantityProduct }})"
                                value="+"
                                class="h-8 w-6 text-xl flex items-center justify-center cursor-pointer select-none" />
                        </div>
                        <!-- cart quantity end -->
                        <div class="ml-auto md:ml-0">
                            <p class="text-primary text-lg font-semibold">{{ number_format($cart->subTotal) }} VNĐ</p>
                        </div>
                        <div class="text-gray-600 hover:text-primary cursor-pointer">
                            <a href="/products/detail/{{ $cart->product_id }}"><i class="fas fa-edit"></i></a>
                        </div>
                        <div class="text-gray-600 hover:text-primary cursor-pointer">
                            <form action="/carts/{{ $cart->id }}" method="post">
                                @csrf()
                                @method('DELETE')
                                <button type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- single cart end -->
                @endforeach
            </div>
            <!-- shipping carts end -->
        </div>
        <!-- product cart end -->
        <!-- order summary -->
        <div class="xl:col-span-3 lg:col-span-4 border border-gray-200 px-4 py-4 rounded mt-6 lg:mt-0">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">ORDER SUMMARY</h4>
            <div class="space-y-1 text-gray-600 pb-3 border-b border-gray-200">
                <div class="flex justify-between font-medium">
                    <p>Subtotal</p>
                    <p>{{ number_format($total) }} VNĐ</p>
                </div>
                <div class="flex justify-between">
                    <p>Delivery</p>
                    <p>Free</p>
                </div>
                <div class="flex justify-between">
                    <p>Tax</p>
                    <p>Free</p>
                </div>
            </div>
            <div class="flex justify-between my-3 text-gray-800 font-semibold uppercase">
                <h4>Total</h4>
                <h4>{{ number_format($total) }} VNĐ</h4>
            </div>

            <!-- checkout -->
            <a href="/checkout"
                class="bg-primary border border-primary text-white px-4 py-3 font-medium rounded-md uppercase hover:bg-transparent
             hover:text-primary transition text-sm w-full block text-center">
                Process to checkout
            </a>
            <!-- checkout end -->
        </div>
        <!-- order summary end -->
    </div>
@endsection
