@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="container py-4 flex justify-between">
        <div class="flex gap-3 items-center">
            <a href="/" class="text-primary text-base">
                <i class="fas fa-home"></i>
            </a>
            <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <p class="text-gray-600 font-medium">Products</p>
        </div>
    </div>
    <!-- breadcrum end -->
    <!-- shop wrapper -->
    <div class="container grid lg:grid-cols-4 gap-6 pt-4 pb-16 items-start relative">
        <!-- sidebar -->
        <div
            class="col-span-1 bg-white px-4 pt-4 pb-6 shadow rounded overflow-hidden absolute lg:static left-4 top-16 z-10 w-72 lg:w-full lg:block">
            <div class="divide-gray-200 divide-y space-y-5 relative">
                <!-- category filter -->
                <div class="relative">
                    <div class="lg:hidden text-gray-400 hover:text-primary text-lg absolute right-0 top-0 cursor-pointer">
                        <i class="fas fa-times"></i>
                    </div>
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Categories</h3>
                    <div class="space-y-2">
                        @foreach ($categoryList as $key => $cate)
                            <!-- single category -->
                            <div class="flex items-center">
                                <a href="/products/{{ $cate->name }}"
                                    class="text-gray-600 ml-3 cursor-pointer">{{ $cate->name }}</a>
                                <div class="ml-auto text-gray-600 text-sm">
                                    ({{ $cate->products_count }})
                                </div>
                            </div>
                            <!-- single category end -->
                        @endforeach
                    </div>
                </div>
                <!-- category filter end -->
                <!-- brand filter -->
                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Brands</h3>
                    <div class="space-y-2">
                        @foreach ($brandList as $key => $brands)
                            <!-- single brand name -->
                            <div class="flex items-center">
                                <a href="/products/{{ $brands->name }}"
                                    class="text-gray-600 ml-3 cursor-pointer">{{ $brands->name }}</a>
                                <div class="ml-auto text-gray-600 text-sm">
                                    ({{ $brands->products_count }})
                                </div>
                            </div>
                            <!-- single brand name end -->
                        @endforeach

                    </div>
                </div>
                <!-- brand filter end -->
                <!-- price filter -->
                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Price</h3>
                    <div class="mt-4 flex items-center">
                        <input type="text"
                            class="w-full border-gray-300 focus:ring-0 focus:border-primary px-3 py-1 text-gray-600 text-sm shadow-sm rounded"
                            placeholder="min">
                        <span class="mx-3 text-gray-500">-</span>
                        <input type="text"
                            class="w-full border-gray-300 focus:ring-0 focus:border-primary px-3 py-1 text-gray-600 text-sm shadow-sm rounded"
                            placeholder="max">
                    </div>
                </div>
                <!-- price filter end -->
                <!-- size filter -->
                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">size</h3>
                    <div class="flex items-center gap-2">
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-38">
                            <label for="size-38"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                38
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-39">
                            <label for="size-39"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                39
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-40" checked>
                            <label for="size-40"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                40
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-41">
                            <label for="size-41"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                41
                            </label>
                        </div>
                        <!-- single size end -->
                        <!-- single size -->
                        <div class="size-selector">
                            <input type="radio" name="size" class="hidden" id="size-42">
                            <label for="size-42"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">
                                42
                            </label>
                        </div>
                        <!-- single size end -->
                    </div>
                </div>
                <!-- size filter end -->
                <!-- color filter -->
                <div class="mt-4">
                    <h3 class="text-base text-gray-800 mb-1">Color</h3>
                    <div class="flex items-center gap-2">
                        <!-- single color -->
                        <div class="color-selector">
                            <input type="radio" name="color" class="hidden" id="color-white" value="white">
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
                            <input type="radio" name="color" class="hidden" id="color-blue" value="blue" checked>
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
                <!-- color filter end -->
            </div>
        </div>
        <!-- sidebar end -->

        @if (isset($productList))
            <!-- products -->
            <div class="col-span-3">
                <!-- sorting -->
                <div class="mb-4 flex items-center">
                    <button="showFilter=!showFilter"
                        class="bg-primary border border-primary text-white px-10 py-3 font-medium rounded uppercase hover:bg-transparent hover:text-primary transition lg:hidden text-sm mr-3 focus:outline-none">
                        Filter
                        </button>
                        <select
                            class="w-44 text-sm text-gray-600 px-4 py-3 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                            <option>Default sorting</option>
                            <option>Price low-high</option>
                            <option>Price high-low</option>
                            <option>Latest product</option>
                        </select>
                        <div class="flex gap-2 ml-auto">
                            <div
                                class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer">
                                <i class="fas fa-th"></i>
                            </div>
                            <div
                                class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                                <i class="fas fa-list"></i>
                            </div>
                        </div>
                </div>
                <!-- sorting end -->
                <!-- product wrapper -->
                <div class="grid lg:grid-cols-2 xl:grid-cols-3 sm:grid-cols-2 gap-6">
                    @foreach ($productList as $key => $products)
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
                                    <h4
                                        class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                        {{ $products->name }}
                                    </h4>
                                </a>
                                <div class="flex items-baseline mb-1 space-x-2">
                                    <p class="text-xl text-primary font-roboto font-semibold">
                                        {{ $products->promotion_price }}
                                        VNĐ</p>
                                    <p class="text-sm text-gray-400 font-roboto line-through">
                                        {{ $products->original_price }}
                                        VNĐ</p>
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
                <!-- products end -->
                <div>
                    {{ $productList->links() }}
                </div>
            </div>
            <!-- products -->
        @else
            <div class="col-span-3">
                <div>khong cos san pham nao la {{ $namesearch }}</div>
            </div>
        @endif

    </div>
    <!-- shop wrapper end -->
@endsection
