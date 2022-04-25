@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="/" class="text-primary text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <a href="/products" class="text-primary text-base font-medium uppercase">
            Shop
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <p class="text-gray-600 font-medium uppercase">{{ $products->name }}</p>
    </div>
    <!-- breadcrum end -->

    <!-- product view -->
    <div class="container pt-4 pb-6 grid lg:grid-cols-2 gap-6">
        <!-- product image -->
        <div>
            <div>
                <img id="main-img" src="{{ $products->image }}" class="w-full">
            </div>
        </div>
        <!-- product image end -->
        <!-- product content -->
        <div>
            <h2 class="md:text-3xl text-2xl font-medium uppercase mb-2">{{ $products->name }}</h2>
            <div class="flex items-center mb-4">
                <div class="flex gap-1 text-sm text-yellow-400">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                </div>
                <div class="text-xs text-gray-500 ml-3">(150 Reviews)</div>
            </div>
            <div class="space-y-2">
                <p class="text-gray-800 font-semibold space-x-2">
                    <span>Availability: </span>
                    @if ($products->quantity <= 0)
                        <span class="text-red-600">
                            out of stock
                        </span>
                    @else
                        <span class="text-green-600">
                            In Stock ({{ $products->quantity }})
                        </span>
                    @endif
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Brand: </span>
                    <span class="text-gray-600">{{ $brand->name }}</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Category: </span>
                    <span class="text-gray-600">{{ $category->name }}</span>
                </p>
            </div>
            <div class="mt-4 flex items-baseline gap-3">
                <span class="text-primary font-semibold text-xl">{{ $products->promotion_price }} VNĐ</span>
                <span class="text-gray-500 text-base line-through">{{ $products->original_price }} VNĐ</span>
            </div>
            <p class="mt-4 text-gray-600">
                {{ $brand->description }}
            </p>
            <form action="/carts" method="post">
                @csrf()
                <input type="hidden" name="product_id" value="{{ $products->id }}">
                <!-- size -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Size</h3>
                    <div class="flex items-center gap-2">
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-38" value="38">
                            <label for="size-38"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                38
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-39" value="39">
                            <label for="size-39"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                39
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-40" value="40" checked>
                            <label for="size-40"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                40
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-41" value="41">
                            <label for="size-41"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                41
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-42" value="42">
                            <label for="size-42"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                42
                            </label>
                        </div>
                        <!-- single size end -->
                    </div>
                </div>
                <!-- size end -->
                <!-- color -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Color</h3>
                    <div class="flex items-center gap-2">
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-white" value="white" checked>
                            <label for="color-white" style="background-color : #ffffff"
                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                            </label>
                        </div>
                        <!-- single color end -->
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-black" value="black">
                            <label for="color-black" style="background-color : #000"
                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                            </label>
                        </div>
                        <!-- single color end -->
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-red" value="red">
                            <label for="color-red" style="background-color : #f50707"
                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                            </label>
                        </div>
                        <!-- single color end -->
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-blue" value="blue">
                            <label for="color-blue" style="background-color : #24d1f8"
                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                            </label>
                        </div>
                        <!-- single color end -->
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-green" value="green">
                            <label for="color-green" style="background-color : #50dc0a"
                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                            </label>
                        </div>
                        <!-- single color end -->
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-yellow" value="yellow">
                            <label for="color-yellow" style="background-color : #fad520"
                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                            </label>
                        </div>
                        <!-- single color end -->
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-pink" value="pink">
                            <label for="color-pink" style="background-color : #de09ee"
                                class="text-xs border border-gray-200 rounded-sm h-5 w-5 flex items-center justify-center cursor-pointer shadow-sm">
                            </label>
                        </div>
                        <!-- single color end -->
                    </div>
                </div>
                <!-- color end -->
                <!-- quantity -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Quantity</h3>
                    <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                        <input type="button" onclick="decreaseValue()" value="-"
                            class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none" />
                        <input type="text" class="h-8 w-16 flex items-center justify-center" id="quantity" name="quantity"
                            value="1" readonly />
                        <input type="button" onclick="incrementValue({{ $products->quantity }})" value="+"
                            class="h-8 w-6 text-xl flex items-center justify-center cursor-pointer select-none" />
                    </div>
                </div>
                <!-- add to cart button -->
                <div class="flex gap-3 border-b border-gray-200 pb-5 mt-6">
                    @if ($products->quantity <= 0)
                        <a
                            class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase
                        hover:bg-transparent hover:text-primary transition text-sm flex items-center cursor-not-allowed bg-opacity-80">
                            Hết Hàng
                        </a>
                    @else
                        <button type="submit"
                            class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase
                        hover:bg-transparent hover:text-primary transition text-sm flex items-center">
                            <span class="mr-2"><i class="fas fa-shopping-bag"></i></span> Add to cart
                        </button>
                    @endif
                    <a onclick="addtowishlist({{ $products->id }})"
                        class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition text-sm">
                        <span class="mr-2"><i class="far fa-heart"></i></span> Wishlist
                    </a>
                </div>
            </form>
            <!-- add to cart button end -->
            <!-- product share icons -->
            <div class="flex space-x-3 mt-4">
                <a href="https://www.facebook.com/"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/?lang=vi"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com/"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            <!-- product share icons end -->
        </div>
        <!-- product content end -->
    </div>
    <!-- product view end -->

    <!-- product details and review -->
    <div class="container pb-16">
        <!-- detail buttons -->
        <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">
            Product Details
        </h3>
        <!-- details button end -->

        <!-- details content -->
        <div class="lg:w-4/5 xl:w-3/5 pt-6">
            <div class="space-y-3 text-gray-600">
                <p>
                    {{ $products->description }}
                </p>
                <p>
                    {{ $category->description }}
                </p>
            </div>
        </div>
        <!-- details content end -->
    </div>
    <!-- product details and review end -->

    <!-- related products -->
    <div class="container pb-16">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 uppercase mb-6">related products</h2>
        <!-- product wrapper -->
        <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-6">
            @foreach ($productRelated as $key => $products)
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
                            <a href="#"
                                class="text-white text-lg w-9 h-9 rounded-full bg-primary hover:bg-gray-800 transition flex items-center justify-center">
                                <i class="far fa-heart"></i>
                            </a>
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
                            <p class="text-sm text-gray-400 font-roboto line-through">{{ $products->original_price }}
                                VNĐ
                            </p>
                        </div>
                        <div class="flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                                <span:key="n"><i class="fas fa-star"></i></span>
                                    <span:key="n"><i class="fas fa-star"></i></span>
                                        <span:key="n"><i class="fas fa-star"></i></span>
                                            <span:key="n"><i class="fas fa-star"></i></span>
                                                <span:key="n"><i class="fas fa-star"></i></span>
                            </div>
                            <div class="text-xs text-gray-500 ml-3">(150)</div>
                        </div>
                    </div>
                    <!-- product content end -->
                    <!-- product button -->
                    @if ($products->quantity <= 0)
                        <a
                            class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">
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
    </div>
@endsection
