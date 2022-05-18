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
            <form id="form" ole="form" action="/checkout" method="POST" class="form-payment" data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                @csrf()
                @if (isset($coupon))
                    <input type="hidden" name="coupon" value="{{ $coupon->code }}" />
                @endif
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
                                    <option value="100" {{ $shipping->type == '100' ? 'selected' : '' }}>
                                        ship tận nhà</option>
                                    <option value="200" {{ $shipping->type == '200' ? 'selected' : '' }}>
                                        ship tới địa chỉ khác</option>
                                    <option value="300" {{ $shipping->type == '300' ? 'selected' : '' }}>
                                        ship hàng thu tiền hộ</option>
                                </select>
                            </div>
                        </div>
                        @if (isset($payment))
                            <div>
                                <div class="form-check">
                                    <input id="payment_off"
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="method" value="100"
                                        {{ $payment->method == '100' ? 'checked' : '' }}>
                                    <label class="form-check-label inline-block text-gray-800" for="method">
                                        thanh toán khi nhận hàng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="payment_onl"
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="method" value="200"
                                        {{ $payment->method == '200' ? 'checked' : '' }}>
                                    <label class="form-check-label inline-block text-gray-800" for="method">
                                        chuyển khoản
                                    </label>
                                </div>
                                @if (isset($users))
                                    <div id="payment_card">
                                        <div class="mb-4 mt-4">
                                            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                                class="h-5">
                                        </div>
                                        ************ {{ $users->pm_last_four }}
                                    </div>
                                @else
                                    <div id="payment_banking" style="display: none">
                                        <h3 class="text-lg font-medium capitalize mb-4">
                                            Payment
                                        </h3>
                                        <div class="mb-4">
                                            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                                class="h-5">
                                        </div>
                                        <div class="space-y-4">
                                            <div>
                                                <label class="text-gray-600 mb-2 block">
                                                    Name on card <span class="text-primary">*</span>
                                                </label>
                                                <input type="text" id="nameoncard" class="input-box" name="nameoncard">
                                            </div>
                                            <div class="grid sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Card number <span class="text-primary">*</span>
                                                    </label>
                                                    <input type="text" id="cardnumber" class="input-box"
                                                        name="cardnumber" ondrop="return false;" onpaste="return false;"
                                                        onkeypress="return event.charCode>=48 && event.charCode<=57"
                                                        placeholder="0000 0000 0000 0000">
                                                </div>
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Cvc <span class="text-primary">*</span>
                                                    </label>
                                                    <input type="text" id="cvc" class="input-box" name="cvc"
                                                        placeholder="123" maxlength="3" ondrop="return false;"
                                                        onpaste="return false;"
                                                        onkeypress="return event.charCode>=48 && event.charCode<=57">
                                                </div>

                                            </div>
                                            <div class="grid sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Expiration date
                                                    </label>
                                                    <select id="month" class="input-box" name="month">
                                                        <option value="01">01 - January</option>
                                                        <option value="02">02 - February</option>
                                                        <option value="03">03 - March</option>
                                                        <option value="04">04 - April</option>
                                                        <option value="05">05 - May</option>
                                                        <option value="06">06 - June</option>
                                                        <option value="07">07 - July</option>
                                                        <option value="08">08 - August</option>
                                                        <option value="09">09 - September</option>
                                                        <option value="10">10 - October</option>
                                                        <option value="11">11 - November</option>
                                                        <option value="12">12 - December</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Year
                                                    </label>
                                                    <select id="year" class="input-box" name="year">
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div>
                                <div class="form-check">
                                    <input id="payment_off"
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="method" value="100" checked>
                                    <label class="form-check-label inline-block text-gray-800" for="method">
                                        thanh toán khi nhận hàng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="payment_onl"
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="method" value="200">
                                    <label class="form-check-label inline-block text-gray-800" for="method">
                                        chuyển khoản
                                    </label>
                                </div>
                                @if (isset($users))
                                    <div id="payment_card">
                                        <div class="mb-4 mt-4">
                                            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                                class="h-5">
                                        </div>
                                        ************ {{ $users->pm_last_four }}
                                    </div>
                                @else
                                    <div id="payment_banking" style="display: none">
                                        <h3 class="text-lg font-medium capitalize mb-4">
                                            Payment
                                        </h3>
                                        <div class="mb-4">
                                            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                                class="h-5">
                                        </div>
                                        <div class="space-y-4">
                                            <div>
                                                <label class="text-gray-600 mb-2 block">
                                                    Name on card <span class="text-primary">*</span>
                                                </label>
                                                <input type="text" id="nameoncard" class="input-box" name="nameoncard">
                                            </div>
                                            <div class="grid sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Card number <span class="text-primary">*</span>
                                                    </label>
                                                    <input type="text" id="cardnumber" class="input-box"
                                                        name="cardnumber" ondrop="return false;" onpaste="return false;"
                                                        onkeypress="return event.charCode>=48 && event.charCode<=57"
                                                        placeholder="0000 0000 0000 0000">
                                                </div>
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Cvc <span class="text-primary">*</span>
                                                    </label>
                                                    <input type="text" id="cvc" class="input-box" name="cvc"
                                                        placeholder="123" maxlength="3" ondrop="return false;"
                                                        onpaste="return false;"
                                                        onkeypress="return event.charCode>=48 && event.charCode<=57">
                                                </div>

                                            </div>
                                            <div class="grid sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Expiration date
                                                    </label>
                                                    <select id="month" class="input-box" name="month">
                                                        <option value="01">01 - January</option>
                                                        <option value="02">02 - February</option>
                                                        <option value="03">03 - March</option>
                                                        <option value="04">04 - April</option>
                                                        <option value="05">05 - May</option>
                                                        <option value="06">06 - June</option>
                                                        <option value="07">07 - July</option>
                                                        <option value="08">08 - August</option>
                                                        <option value="09">09 - September</option>
                                                        <option value="10">10 - October</option>
                                                        <option value="11">11 - November</option>
                                                        <option value="12">12 - December</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="text-gray-600 mb-2 block">
                                                        Year
                                                    </label>
                                                    <select id="year" class="input-box" name="year">
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="mb-3 xl:w-96">
                            <label for="exampleFormControlTextarea1"
                                class="form-label inline-block mb-2 text-gray-700">Shipping
                                Order</label>
                            <textarea name="note" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="exampleFormControlTextarea1" rows="3"
                                placeholder="Notes about your order, Special Notes for Delivery">{{ $shipping->note }}</textarea>
                        </div>
                        <div class="mb-3 xl:w-96">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
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
                            <input type="email" class="input-box" name="email" required>
                        </div>
                        <div>
                            <div class="mb-3 xl:w-96">
                                <select name="type"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example">
                                    <option value="100" selected>ship tận nhà</option>
                                    <option value="200">ship tới địa chỉ khác</option>
                                    <option value="300">ship hàng thu tiền hộ</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="form-check">
                                <input id="payment_off"
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="method" value="100" checked>
                                <label class="form-check-label inline-block text-gray-800" for="method">
                                    thanh toán khi nhận hàng
                                </label>
                            </div>
                            <div class="form-check">
                                <input id="payment_onl"
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="method" value="200">
                                <label class="form-check-label inline-block text-gray-800" for="method">
                                    chuyển khoản
                                </label>
                            </div>
                            @if (isset($users))
                                <div id="payment_card">
                                    <div class="mb-4 mt-4">
                                        <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                            class="h-5">
                                    </div>
                                    ************ {{ $users->pm_last_four }}
                                </div>
                            @else
                                <div id="payment_banking" style="display: none">
                                    <h3 class="text-lg font-medium capitalize mb-4">
                                        Payment
                                    </h3>
                                    <div class="mb-4">
                                        <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                            class="h-5">
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-gray-600 mb-2 block">
                                                Name on card <span class="text-primary">*</span>
                                            </label>
                                            <input type="text" id="nameoncard" class="input-box" name="nameoncard">
                                        </div>
                                        <div class="grid sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="text-gray-600 mb-2 block">
                                                    Card number <span class="text-primary">*</span>
                                                </label>
                                                <input type="text" id="cardnumber" class="input-box" name="cardnumber"
                                                    ondrop="return false;" onpaste="return false;"
                                                    onkeypress="return event.charCode>=48 && event.charCode<=57"
                                                    placeholder="0000 0000 0000 0000">
                                            </div>
                                            <div>
                                                <label class="text-gray-600 mb-2 block">
                                                    Cvc <span class="text-primary">*</span>
                                                </label>
                                                <input type="text" id="cvc" class="input-box" name="cvc"
                                                    placeholder="123" maxlength="3" ondrop="return false;"
                                                    onpaste="return false;"
                                                    onkeypress="return event.charCode>=48 && event.charCode<=57">
                                            </div>

                                        </div>
                                        <div class="grid sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="text-gray-600 mb-2 block">
                                                    Expiration date
                                                </label>
                                                <select id="month" class="input-box" name="month">
                                                    <option value="01">01 - January</option>
                                                    <option value="02">02 - February</option>
                                                    <option value="03">03 - March</option>
                                                    <option value="04">04 - April</option>
                                                    <option value="05">05 - May</option>
                                                    <option value="06">06 - June</option>
                                                    <option value="07">07 - July</option>
                                                    <option value="08">08 - August</option>
                                                    <option value="09">09 - September</option>
                                                    <option value="10">10 - October</option>
                                                    <option value="11">11 - November</option>
                                                    <option value="12">12 - December</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="text-gray-600 mb-2 block">
                                                    Year
                                                </label>
                                                <select id="year" class="input-box" name="year">
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 xl:w-96">
                            <label for="exampleFormControlTextarea1"
                                class="form-label inline-block mb-2 text-gray-700">Shipping
                                Order</label>
                            <textarea name="note" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="exampleFormControlTextarea1" rows="3"
                                placeholder="Notes about your order, Special Notes for Delivery"></textarea>
                        </div>
                        <div class="mb-3 xl:w-96">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
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
                <h4 class="text-gray-800 font-medium my-3 uppercase">{{ number_format($sum) }} VNĐ</h4>
            </div>
            <div class="flex justify-between border-b border-gray-200">
                <h4 class="text-gray-800 font-medium my-3 uppercase">Shipping</h4>
                <h4 class="text-gray-800 font-medium my-3 uppercase">free</h4>
            </div>
            @if (isset($coupon))
                <div class="flex justify-between border-b border-gray-200">
                    <h4 class="text-gray-800 font-medium my-3 uppercase">{{ $coupon->code }}</h4>
                    <h4 class="text-gray-800 font-medium my-3 uppercase">Discount {{ $coupon->value }}%</h4>
                </div>
            @endif
            @if (isset($total))
                <div class="flex justify-between">
                    <h4 class="text-gray-800 font-semibold my-3 uppercase">Total</h4>
                    <h4 class="text-gray-800 font-semibold my-3 uppercase">{{ number_format($total) }} VNĐ</h4>
                </div>
            @else
                <div class="flex justify-between">
                    <h4 class="text-gray-800 font-semibold my-3 uppercase">Total</h4>
                    <h4 class="text-gray-800 font-semibold my-3 uppercase">{{ number_format($sum) }} VNĐ</h4>
                </div>
            @endif

        </div>
        <!-- order summary end -->
    </div>
    <!-- checkout wrapper end -->
    @error('phone')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('email')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('g-recaptcha-response')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @if (Session::has('placeorder'))
        <script>
            toastr.warning('{{ Session::get('placeorder') }}');
        </script>
    @endif

@endsection
