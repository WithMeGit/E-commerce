@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="/" class="text-primary text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <p class="text-gray-600 font-medium uppercase">checkout</p>
    </div>
    <!-- breadcrum end -->

    <!-- checkout wrapper -->
    <div class="container lg:grid grid-cols-12 gap-6 items-start pb-16 pt-4">
        <!-- checkout form -->
        <div class="lg:col-span-8 border border-gray-200 px-4 py-4 rounded">
            <form action="/checkout" method="POST">
                @csrf()
                <h3 class="text-lg font-medium capitalize mb-4">
                    checkout
                </h3>
                @if (isset($shipping))
                    <div class="space-y-4">
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Full Name <span class="text-primary">*</span>
                            </label>
                            <input type="text" class="input-box" name="name" value="{{ $shipping->name }}" required>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Street Address <span class="text-primary">*</span>
                            </label>
                            <input type="text" class="input-box" name="address" value="{{ $shipping->address }}"
                                required>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Phone Number <span class="text-primary">*</span>
                            </label>
                            <input type="phone" class="input-box" name="phone" value="{{ $shipping->phone }}"
                                required>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Email Address <span class="text-primary">*</span>
                            </label>
                            <input type="text" class="input-box" name="email" value="{{ $shipping->email }}"
                                required>
                        </div>
                        <div>
                            <div class="mb-3 xl:w-96">
                                <select name="type"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example">
                                    <option value="ship tận nhà"
                                        {{ $shipping->type == 'ship tận nhà' ? 'selected' : '' }}>
                                        ship tận nhà</option>
                                    <option value="ship tận nhà"
                                        {{ $shipping->type == 'ship tới địa chỉ khác' ? 'selected' : '' }}>
                                        ship tới địa chỉ khác</option>
                                    <option value="ship tận nhà"
                                        {{ $shipping->type == 'ship hàng thu tiền hộ' ? 'selected' : '' }}>
                                        ship hàng thu tiền hộ</option>
                                </select>
                            </div>
                        </div>
                        @if (isset($payment))
                            <div>
                                <div class="mb-3 xl:w-96">
                                    <select name="method"
                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example">
                                        <option value="thanh toán khi nhận hàng"
                                            {{ $payment->method == 'thanh toán khi nhận hàng' ? 'selected' : '' }}>thanh
                                            toán
                                            khi nhận hàng</option>
                                        <option value="chuyển khoản"
                                            {{ $payment->method == 'chuyển khoản' ? 'selected' : '' }}>chuyển khoản
                                        </option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div>
                                <div class="mb-3 xl:w-96">
                                    <select name="method"
                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example">
                                        <option value="thanh toán khi nhận hàng" selected>thanh toán khi nhận hàng</option>
                                        <option value="chuyển khoản">chuyển khoản</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="mb-3 xl:w-96">
                            <label for="exampleFormControlTextarea1"
                                class="form-label inline-block mb-2 text-gray-700">Shipping
                                Order</label>
                            <textarea name="note" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="exampleFormControlTextarea1" rows="9"
                                placeholder="Notes about your order, Special Notes for Delivery">{{ $shipping->note }}</textarea>
                        </div>
                        <!-- checkout -->
                        <button type="submit"
                            class="bg-primary border border-primary text-white px-4 py-3 font-medium rounded-md uppercase hover:bg-transparent hover:text-primary transition text-sm w-full block text-center">
                            Place order
                        </button>
                        <!-- checkout end -->
                    </div>
                @else
                    <div class="space-y-4">
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Full Name <span class="text-primary">*</span>
                            </label>
                            <input type="text" class="input-box" name="name" required>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Street Address <span class="text-primary">*</span>
                            </label>
                            <input type="text" class="input-box" name="address" required>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Phone Number <span class="text-primary">*</span>
                            </label>
                            <input type="phone" class="input-box" name="phone" required>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Email Address <span class="text-primary">*</span>
                            </label>
                            <input type="text" class="input-box" name="email" required>
                        </div>
                        <div>
                            <div class="mb-3 xl:w-96">
                                <select name="type"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example">
                                    <option value="ship tận nhà" selected>ship tận nhà</option>
                                    <option value="ship tới địa chỉ khác">ship tới địa chỉ khác</option>
                                    <option value="ship hàng thu tiền hộ">ship hàng thu tiền hộ</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="mb-3 xl:w-96">
                                <select name="method"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example">
                                    <option value="thanh toán khi nhận hàng" selected>thanh toán khi nhận hàng</option>
                                    <option value="chuyển khoản">chuyển khoản</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 xl:w-96">
                            <label for="exampleFormControlTextarea1"
                                class="form-label inline-block mb-2 text-gray-700">Shipping
                                Order</label>
                            <textarea name="note" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="exampleFormControlTextarea1" rows="9"
                                placeholder="Notes about your order, Special Notes for Delivery"></textarea>
                        </div>
                        <!-- checkout -->
                        <button type="submit"
                            class="bg-primary border border-primary text-white px-4 py-3 font-medium rounded-md uppercase hover:bg-transparent hover:text-primary transition text-sm w-full block text-center">
                            Place order
                        </button>
                        <!-- checkout end -->
                    </div>
                @endif
            </form>
        </div>
        <!-- checkout form end -->

        <!-- order summary -->
        <div class="lg:col-span-4 border border-gray-200 px-4 py-4 rounded mt-6 lg:mt-0">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">ORDER SUMMARY</h4>
            @foreach ($carts as $key => $cart)
                <div class="space-y-2">
                    <div class="flex justify-between" v-for="n in 3" :key="n">
                        <div>
                            <h5 class="text-gray-800 font-medium">{{ $cart->name }}</h5>
                            <p class="text-sm text-gray-600">Size: {{ $cart->size }}</p>
                            <p class="text-sm text-gray-600">Color:</p>
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
                        <p class="text-gray-600">x {{ $cart->quantity }}</p>
                        <p class="text-gray-800 font-medium">{{ number_format($cart->subTotal) }} VNĐ</p>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between border-b border-gray-200 mt-1">
                <h4 class="text-gray-800 font-medium my-3 uppercase">Subtotal</h4>
                <h4 class="text-gray-800 font-medium my-3 uppercase">{{ number_format($total) }} VNĐ</h4>
            </div>
            <div class="flex justify-between border-b border-gray-200">
                <h4 class="text-gray-800 font-medium my-3 uppercase">Shipping</h4>
                <h4 class="text-gray-800 font-medium my-3 uppercase">free</h4>
            </div>
            <div class="flex justify-between">
                <h4 class="text-gray-800 font-semibold my-3 uppercase">Total</h4>
                <h4 class="text-gray-800 font-semibold my-3 uppercase">{{ number_format($total) }} VNĐ</h4>
            </div>
        </div>
        <!-- order summary end -->
    </div>
    <!-- checkout wrapper end -->
@endsection
