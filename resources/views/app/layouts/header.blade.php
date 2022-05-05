<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Tailwind Ecommerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</head>

<body>

    <!-- header -->
    <form action="/products" method="POST">
        @csrf()
        <header class="py-4 shadow-sm bg-pink-100 lg:bg-white">
            <div class="container flex items-center justify-between">
                <!-- logo -->
                <a href="/" class="block w-32">
                    <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472727/shop/logo_eb911i.svg"
                        alt="logo" class="w-full">
                </a>
                <!-- logo end -->

                <!-- searchbar -->
                <div class="w-full xl:max-w-xl lg:max-w-lg lg:flex relative hidden">
                    <span class="absolute left-4 top-3 text-lg text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <div id="nameProductList">
                    </div>
                    <input type="text" name="search_name" id="search_name" required
                        class="pl-12 w-9/12 border border-r-0 border-primary py-3 px-3 rounded-l-md focus:ring-primary focus:border-primary"
                        placeholder="search name product">
                    <button type="submit"
                        class="bg-primary border border-primary text-white px-8 font-medium rounded-r-md hover:bg-transparent hover:text-primary transition">
                        Search
                    </button>
                </div>

                <!-- searchbar end -->

                <!-- navicons -->
                <div class="space-x-4 flex items-center">
                    <a href="/wishlist" class="block text-center text-gray-700 hover:text-primary transition relative">
                        @if (Session::has('wishlistCount'))
                            <span
                                class="absolute -right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                                {{ Session::get('wishlistCount') }}
                            </span>
                        @endif
                        <div class="text-2xl">
                            <i class="far fa-heart"></i>
                        </div>
                        <div class="text-xs leading-3">Wish List</div>
                    </a>
                    <a href="/carts"
                        class="lg:block text-center text-gray-700 hover:text-primary transition hidden relative">
                        @if (Session::has('cartCount'))
                            <span
                                class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                                {{ Session::get('cartCount') }}
                            </span>
                        @endif
                        <div class="text-2xl">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="text-xs leading-3">Cart</div>
                    </a>
                    @if (Session::has('orderCount'))
                        <a href="/orders"
                            class="lg:block text-center text-gray-700 hover:text-primary transition hidden relative">
                            <div class="text-2xl">
                                <span
                                    class="absolute -right-2 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                                    {{ Session::get('orderCount') }}</span>
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="text-xs leading-3">Order</div>
                        </a>
                    @endif
                    @if (Auth::user())
                        <a class="lg:block text-center text-gray-700 hover:text-primary transition hidden relative"
                            id="dropdownNotification" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="text-2xl">
                                <span id="countNotification" data-count="0">
                                </span>
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="text-xs leading-3">Notifi</div>
                        </a>
                    @endif
                    <ul id="Notifications"
                        class="dropdown-menu min-w-max absolute hiddenbg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-gray-50 border-none"
                        aria-labelledby="dropdownNotification">
                    </ul>
                    <a href="/accounts" class="block text-center text-gray-700 hover:text-primary transition">
                        <div class="text-2xl">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="text-xs leading-3">Account</div>
                    </a>
                </div>
                <!-- navicons end -->
            </div>
        </header>
    </form>
    <!-- header end -->

    <!-- navbar -->
    <nav class="bg-gray-800 hidden lg:block">
        <div class="container">
            <div class="flex">
                <!-- all category -->
                <div class="px-8 py-4 bg-primary flex items-center cursor-pointer group relative">
                    <span class="text-white">
                        <i class="fas fa-bars"></i>
                    </span>
                    <span class="capitalize ml-2 text-white">All categories</span>

                    <div
                        class="absolute left-0 top-full w-full bg-white shadow-md py-3 invisible opacity-0 group-hover:opacity-100 group-hover:visible transition duration-300 z-50 divide-y divide-gray-300 divide-dashed">
                        <!-- single category -->
                        @if (isset($categoryList))
                            @foreach ($categoryList as $key => $cate)
                                <a href="/products/{{ $cate->name }}"
                                    class="px-6 py-3 flex items-center hover:bg-gray-100 transition">
                                    <span class="ml-6 text-gray-600 text-sm">{{ $cate->name }}</span>
                                </a>
                            @endforeach
                        @else
                        @endif
                        <!-- single category end -->
                    </div>
                </div>
                <!-- all category end -->

                <!-- nav menu -->
                <div class="flex items-center justify-between flex-grow pl-12">
                    <div class="flex items-center space-x-6 text-base capitalize">
                        <a href="/" class="text-gray-200 hover:text-white transition">Home</a>
                        <a href="/products" class="text-gray-200 hover:text-white transition">Shop</a>
                    </div>
                    @if (Route::has('login'))
                        @auth
                            <div class="flex items-center relative">
                                <h1 class="text-gray-200 mr-2">Hi {{ Auth::user()->name }}</h1>
                                <div class="dropdown relative">
                                    <a class="dropdown-toggle flex items-center hidden-arrow" href="#"
                                        id="dropdownMenuButton2" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472727/shop/logo_user_feipcw.svg"
                                            class="rounded-full bg-gray-200" style="height: 25px; width: 25px" alt=""
                                            loading="lazy" />
                                    </a>
                                    <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none left-auto right-0"
                                        aria-labelledby="dropdownMenuButton2">
                                        <li>
                                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                                href="{{ route('logout') }}"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            <input type="hidden" name="redirect" value="/">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            </div>
                            <!-- Right elements -->
                    </div>
                @else
                    <a href="/login" class="ml-auto justify-self-end text-gray-200 hover:text-white transition">
                        Login
                    </a>
                @endauth
                @endif
            </div>
            <!-- nav menu end -->

        </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- mobile menubar -->
    <div
        class="fixed w-full border-t border-gray-200 shadow-sm bg-white py-3 bottom-0 left-0 flex justify-around items-start px-6 lg:hidden z-40">
        <a href="javascript:void(0)" class="block text-center text-gray-700 hover:text-primary transition relative">
            <div class="text-2xl" id="menuBar">
                <i class="fas fa-bars"></i>
            </div>
            <div class="text-xs leading-3">Menu</div>
        </a>
        <a href="#" class="block text-center text-gray-700 hover:text-primary transition relative">
            <div class="text-2xl">
                <i class="fas fa-list-ul"></i>
            </div>
            <div class="text-xs leading-3">Category</div>
        </a>
        <a href="#" class="block text-center text-gray-700 hover:text-primary transition relative">
            <div class="text-2xl">
                <i class="fas fa-search"></i>
            </div>
            <div class="text-xs leading-3">Search</div>
        </a>
        <a href="/carts" class="text-center text-gray-700 hover:text-primary transition relative">
            <span
                class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">3</span>
            <div class="text-2xl">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="text-xs leading-3">Cart</div>
        </a>
    </div>
    <!-- mobile menu end -->

    <!-- mobile sidebar menu -->
    <div class="fixed left-0 top-0 w-full h-full z-50 bg-black bg-opacity-30 shadow hidden" id="mobileMenu">
        <div class="absolute left-0 top-0 w-72 h-full z-50 bg-white shadow">
            <div id="closeMenu" class="text-gray-400 hover:text-primary text-lg absolute right-3 top-3 cursor-pointer">
                <i class="fas fa-times"></i>
            </div>
            <!-- navlink -->
            <h3 class="text-xl font-semibold text-gray-700 mb-1 font-roboto pl-4 pt-4">Menu</h3>
            <div class="">
                <a href="/" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Home
                </a>
                <a href="/products" class="block px-4 py-2 font-medium transition hover:bg-gray-100">
                    Shop
                </a>
            </div>
            <!-- navlinks end -->
        </div>
    </div>
    <!-- mobile sidebar menu end -->

    @yield('content')

    <footer class="bg-white pt-16 pb-12 border-t border-gray-100">
        <div class="container">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <!-- footer text -->
                <div class="space-y-8 xl:col-span-1">
                    <img class="w-30"
                        src="https://res.cloudinary.com/carternguyen/image/upload/v1650472727/shop/logo_eb911i.svg"
                        alt="Company name">
                    <p class="text-gray-500 text-base">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio facere rem
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <!-- footer text end -->
                <!-- footer links -->
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Solutions
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Marketing
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Analytics
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Commerce
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Insights
                                </a>
                            </div>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Support
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Pricing
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Documentation
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Guides
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    API Status
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Company
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    About
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Blog
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Jobs
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Press
                                </a>
                            </div>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Legal
                            </h3>
                            <div class="mt-4 space-y-4">
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Claim
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Privacy
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Policy
                                </a>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">
                                    Terms
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer links end -->
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- copyright -->
    <div class="bg-gray-800 py-4">
        <div class="container flex items-center justify-between">
            <p class="text-white">© RAFCART - Developer by Carter GoldenOwl</p>
            <div>
                <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472817/shop/banner_3_gnoj3s.png"
                    class="h-5">
            </div>
        </div>
    </div>
</body>

</html>
