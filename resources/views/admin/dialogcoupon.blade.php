@extends('admin.layouts.nav')
@section('content')
    <div class="max-w-[700px] mx-auto px-3 lg:px-6">
        <h2 class="text-3xl font-bold mb-12 text-blue-600">{{ $title }}</h2>
        @if (isset($coupon))
            <form action="/admin/coupons/{{ $coupon->id }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $coupon->id }}" />
                <div class="form-group mb-6">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="code" value="{{ $coupon->code }}" required placeholder="code" required>
                </div>
                <div class="form-group mb-6">
                    <div class="mb-3 xl:w-96">
                        <select name="value"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option value="10" {{ $coupon->value == '10' ? 'selected' : '' }}>giảm 10%</option>
                            <option value="15" {{ $coupon->value == '15' ? 'selected' : '' }}>giảm 15%</option>
                            <option value="20" {{ $coupon->value == '20' ? 'selected' : '' }}>giảm 20%</option>
                            <option value="30" {{ $coupon->value == '30' ? 'selected' : '' }}>giảm 30%</option>
                            <option value="50" {{ $coupon->value == '50' ? 'selected' : '' }}>giảm 50%</option>
                            <option value="75" {{ $coupon->value == '75' ? 'selected' : '' }}>giảm 75%</option>
                            <option value="100" {{ $coupon->value == '100' ? 'selected' : '' }}>giảm 100%</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-6">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="quantity" value="{{ $coupon->quantity }}" required placeholder="quantity" required>
                </div>
                <button type="submit"
                    class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{ $active }}</button>
                <div
                    class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/coupons" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @else
            <form action="/admin/coupons" method="post">
                @csrf
                <div class="form-group mb-6">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="code" required placeholder="code" required>
                </div>
                <div class="form-group mb-6">
                    <div class="mb-3 xl:w-96">
                        <select name="value"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option value="10" selected>giảm 10%</option>
                            <option value="15">giảm 15%</option>
                            <option value="20">giảm 20%</option>
                            <option value="30">giảm 30%</option>
                            <option value="50">giảm 50%</option>
                            <option value="75">giảm 75%</option>
                            <option value="100">giảm 100%</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-6">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="quantity" required placeholder="quantity" required>
                </div>
                <button type="submit"
                    class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{ $active }}</button>
                <div
                    class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/coupons" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @endif

    </div>
    @error('code')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror

    <div class="mb-72"></div>
@endsection
