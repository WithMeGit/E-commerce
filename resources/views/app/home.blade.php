@extends('app.layouts.header')
@section('content')
    <!-- banner -->
    <div class="bg-cover bg-no-repeat bg-center py-36 relative"
        style="background-image: url('https://res.cloudinary.com/carternguyen/image/upload/v1650472817/shop/banner_azit5n.jpg')">
        <div class="container">
            <!-- banner content -->
            <h1 class="xl:text-6xl md:text-5xl text-4xl text-white font-medium mb-4">
                Best Collection For <br class="hidden sm:block"> Home Decoration
            </h1>
            <p class="text-base text-white leading-6">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa <br class="hidden sm:block">
                assumenda aliquid inventore nihil laboriosam odio
            </p>
            <!-- banner button -->
            <div class="mt-12">
                <a href="/products"
                    class="bg-primary border border-primary text-white px-8 py-3 font-medium rounded-md uppercase hover:bg-transparent
               hover:text-primary transition">
                    Shop now
                </a>
            </div>
            <!-- banner button end -->
            <!-- banner content end -->
        </div>
    </div>
    <!-- banner end -->

    <!-- features -->
    <div class="container py-16">
        <div class="lg:w-10/12 grid md:grid-cols-3 gap-3 lg:gap-6 mx-auto justify-center">

            <!-- single feature -->
            <div class="border-primary border rounded-sm px-8 lg:px-3 lg:py-6 py-4 flex justify-center items-center gap-5">
                <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472727/shop/delivery-van_zhg8gr.svg"
                    class="lg:w-12 w-10 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">free shipping</h4>
                    <p class="text-gray-500 text-xs lg:text-sm">Order over $200</p>
                </div>
            </div>
            <!-- single feature end -->
            <!-- single feature -->
            <div class="border-primary border rounded-sm px-8 lg:px-3 lg:py-6 py-4 flex justify-center items-center gap-5">
                <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472727/shop/money-back_iqjs4h.svg"
                    class="lg:w-12 w-10 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Money returns</h4>
                    <p class="text-gray-500 text-xs lg:text-sm">30 Days money return</p>
                </div>
            </div>
            <!-- single feature end -->
            <!-- single feature -->
            <div class="border-primary border rounded-sm px-8 lg:px-3 lg:py-6 py-4 flex justify-center items-center gap-5">
                <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472727/shop/service-hours_nmibn3.svg"
                    class="lg:w-12 w-10 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">24/7 Support</h4>
                    <p class="text-gray-500 text-xs lg:text-sm">Customer support</p>
                </div>
            </div>
            <!-- single feature end -->

        </div>
    </div>
    <!-- features end -->

    <!-- categories -->
    <div class="container pb-16">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">shop by category</h2>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-3">
            @foreach ($categoryList as $key => $cate)
                <!-- single category -->
                <div class="relative group rounded-sm overflow-hidden">
                    <img src="{{ $cate->image }}" class="rounded-lg w-full">
                    <a href="/products/{{ $cate->name }}"
                        class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 flex items-center justify-center text-xl text-white
                    font-roboto font-medium tracking-wide transition">
                        {{ $cate->name }}
                    </a>
                </div>
                <!-- single category end -->
            @endforeach
        </div>
    </div>
    <!-- categories end -->

    <!-- top new arrival -->
    <div class="container pb-16">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">top new arrival</h2>
        <!-- product wrapper -->
        <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6">
            @foreach ($productTopNewArrival as $key => $products)
                <!-- single product -->
                <div class="group rounded bg-white shadow overflow-hidden">
                    <!-- product image -->
                    <div class="relative">
                        <img src="{{ $products->image }}" class="w-full">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="/products/detail/{{ $products->id }}"
                                class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                <i class="fas fa-search"></i>
                            </a>
                            <form action="/wishlist" method="post">
                                @csrf()
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <button type="submit"
                                    class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- product image end -->
                    <!-- product content -->
                    <div class="pt-4 pb-3 px-4">
                        <a href="/products/detail/{{ $products->id }}">
                            <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                {{ $products->name }}
                            </h4>
                        </a>
                        <div class="flex items-baseline mb-1 space-x-2">
                            <p class="text-xl text-primary font-roboto font-semibold">{{ $products->promotion_price }} VNĐ
                            </p>
                            <p class="text-sm text-gray-400 font-roboto line-through">{{ $products->original_price }} VNĐ
                            </p>
                        </div>
                        <div class="flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                            </div>
                            <div class="text-xs text-gray-500 ml-3">(150)</div>
                        </div>
                    </div>
                    <!-- product content end -->
                    <!-- product button -->
                    @if ($products->quantity <= 0)
                        <a
                            class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition cursor-not-allowed bg-opacity-8">
                            Hết Hàng</a>
                    @else
                        <form action="/carts" method="post">
                            @csrf()
                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="size" value="40">
                            <input type="hidden" name="color" value="white">
                            <button type="submit"
                                class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition ">
                                Add to Cart
                            </button>
                        </form>
                    @endif
                    <!-- product button end -->
                </div>
                <!-- single product end -->
            @endforeach
        </div>
        <!-- product wrapper end -->
    </div>
    <!-- top new arrival end -->

    <!-- ad section -->
    <div class="container pb-16">
        <a href="/products">
            <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472818/shop/banner_4_xge0hy.png"
                class="w-full">
        </a>
    </div>
    <!-- ad section end -->

    <!-- recomended for you -->
    <div class="container pb-16">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">recomended for you</h2>
        <!-- product wrapper -->
        <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6">
            @foreach ($productRecomended as $key => $products)
                <!-- single product -->
                <div class="group rounded bg-white shadow overflow-hidden">
                    <!-- product image -->
                    <div class="relative">
                        <img src="{{ $products->image }}" class="w-full">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="/products/detail/{{ $products->id }}"
                                class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                <i class="fas fa-search"></i>
                            </a>
                            <form action="/wishlist" method="post">
                                @csrf()
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <button type="submit"
                                    class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- product image end -->
                    <!-- product content -->
                    <div class="pt-4 pb-3 px-4">
                        <a href="/products/detail/{{ $products->id }}">
                            <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                {{ $products->name }}
                            </h4>
                        </a>
                        <div class="flex items-baseline mb-1 space-x-2">
                            <p class="text-xl text-primary font-roboto font-semibold">{{ $products->promotion_price }}
                                VNĐ
                            </p>
                            <p class="text-sm text-gray-400 font-roboto line-through">{{ $products->original_price }} VNĐ
                            </p>
                        </div>
                        <div class="flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                            </div>
                            <div class="text-xs text-gray-500 ml-3">(150)</div>
                        </div>
                    </div>
                    <!-- product content end -->
                    <!-- product button -->
                    @if ($products->quantity <= 0)
                        <a
                            class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition cursor-not-allowed bg-opacity-8">
                            Hết Hàng</a>
                    @else
                        <form action="/carts" method="post">
                            @csrf()
                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="size" value="40">
                            <input type="hidden" name="color" value="white">
                            <button type="submit"
                                class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
                                Add to Cart
                            </button>
                        </form>
                    @endif
                    <!-- product button end -->
                </div>
                <!-- single product end -->
            @endforeach
        </div>
        <!-- product wrapper end -->
    </div>
    <!-- recomended for you end -->
@endsection
