@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="/" class="text-primary text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <p class="text-gray-600 font-medium uppercase">Payment</p>
    </div>
    <!-- breadcrum end -->

    <!-- cart wrapper -->
    <div class="container lg:grid grid-cols-12 gap-6 items-start pb-16 pt-4">
        <div class="col-span-8 border border-gray-200 px-4 py-4 rounded">
            <form role="form" action="/payment" method="post" class="form-payment" data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                @csrf()
                @isset($request['coupon'])
                    <input type="hidden" name="coupon" value="{{ $request['coupon'] }}" />
                @endisset
                <input type="hidden" name="name" value="{{ $request['name'] }}" />
                <input type="hidden" name="address" value="{{ $request['address'] }}" />
                <input type="hidden" name="phone" value="{{ $request['phone'] }}" />
                <input type="hidden" name="email" value="{{ $request['email'] }}" />
                <input type="hidden" name="type" value="{{ $request['type'] }}" />
                <input type="hidden" name="method" value="{{ $request['method'] }}" />
                <input type="hidden" name="note" value="{{ $request['note'] }}" />
                <h3 class="text-lg font-medium capitalize mb-4">
                    Payment
                </h3>
                <div class="mb-4">
                    <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-5">
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Name on card <span class="text-primary">*</span>
                        </label>
                        <input type="text" id="nameoncard" class="input-box" name="nameoncard" required>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Card number <span class="text-primary">*</span>
                            </label>
                            <input type="text" id="cardnumber" class="input-box" name="cardnumber"
                                placeholder="0000 0000 0000 0000" required>
                        </div>
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Cvc <span class="text-primary">*</span>
                            </label>
                            <input type="text" id="cvc" class="input-box" name="cvc" placeholder="123" required>
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
                    <div class="mb-3 xl:w-96">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <button type="submit"
                        class="bg-primary border border-primary text-white px-4 py-3 font-medium rounded-md uppercase hover:bg-transparent hover:text-primary transition text-sm w-full block text-center">
                        Pay @if (Session::has('total'))
                            {{ number_format(Session::get('total')) }} VNĐ
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
