@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="/account" class="text-primary text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-400"><i class="fas fa-chevron-right"></i></span>
        <p class="text-gray-600 font-medium uppercase">My Account</p>
    </div>
    <!-- breadcrum end -->

    <!-- account wrapper -->
    <div class="container lg:grid grid-cols-12 items-start gap-6 pt-4 pb-16">
        <!-- sidebar -->
        <div class="col-span-3">
            <!-- account profile -->
            <div class="px-4 py-3 shadow flex items-center gap-4">
                <div class="flex-shrink-0">
                    <img src="https://res.cloudinary.com/carternguyen/image/upload/v1650472727/shop/logo_user_feipcw.svg"
                        class="rounded-full w-14 h-14 p-1 border border-gray-200 object-cover">
                </div>
                <div>
                    <p class="text-gray-600">Hello,</p>
                    <h4 class="text-gray-800 capitalize font-medium">
                        @if (Auth::user())
                            {{ Auth::user()->name }}
                        @endif
                    </h4>
                </div>
            </div>
            <!-- account profile end -->

            <!-- profile links -->
            <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
                <!-- single link -->
                <div class="space-y-1 pl-8">
                    <a href="/accounts"
                        class="relative text-base font-medium capitalize hover:text-primary transition block">
                        Manage account
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="far fa-address-card"></i>
                        </span>
                    </a>
                    <a href="profile-info.html" class="hover:text-primary transition capitalize block">Profile
                        information</a>
                    <a href="manage-address.html" class="hover:text-primary transition capitalize block">Manage
                        address</a>
                    <a href="change-password.html" class="hover:text-primary transition capitalize block">change
                        password</a>
                </div>
                <!-- single link end -->

                <!-- single link -->
                <div class="pl-8 pt-4">
                    <a class="relative medium capitalize text-gray-800 font-medium hover:text-primary transition block"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        logout
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        <input type="hidden" name="redirect" value="/">
                        @csrf()
                    </form>
                </div>
                <!-- single link end -->
            </div>
            <!-- profile links end -->
        </div>
        <!-- sidebar end -->

        <!-- account content -->
        <div class="col-span-9 mt-6 lg:mt-0 space-y-4">
            @foreach ($wishlists as $key => $wishlist)
                <!-- single wishlist -->
                <div
                    class="flex items-center md:justify-between gap-4 md:gap-6 p-4 border border-gray-200 rounded flex-wrap md:flex-nowrap">
                    <!-- cart image -->
                    <div class="w-28 flex-shrink-0">
                        <img src="{{ $wishlist->imageProduct }}" class="w-full">
                    </div>
                    <!-- cart image end -->
                    <!-- cart content -->
                    <div class="md:w-1/3 w-full">
                        <h2 class="text-gray-800 mb-1 xl:text-xl textl-lg font-medium uppercase">
                            {{ $wishlist->nameProduct }}
                        </h2>
                        <p class="text-gray-500 text-sm">Availability:
                            @if ($wishlist->quantityProduct <= 0)
                                <span class="text-red-600">Out of Stock</span>
                            @else
                                <span class="text-green-600">In Stock</span>
                            @endif
                        </p>
                    </div>
                    <!-- cart content end -->
                    <div class="">
                        <p class="text-primary text-lg font-semibold">{{ $wishlist->priceProduct }} VNĐ</p>
                    </div>
                    @if ($wishlist->quantityProduct <= 0)
                        <a
                            class="ml-auto md:ml-0 block px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded
                            uppercase font-roboto font-medium cursor-not-allowed bg-opacity-80">
                            Add to cart
                        </a>
                    @else
                        <form action="/carts" method="post">
                            @csrf()
                            <input type="hidden" name="product_id" value="{{ $wishlist->idProduct }}">
                            <input type="hidden" name="check_wishlist" value="1">
                            <input type="hidden" name="wishlist_id" value="{{ $wishlist->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="size" value="40">
                            <input type="hidden" name="color" value="white">
                            <button type="submit"
                                class="ml-auto md:ml-0 block px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                                Add to cart
                            </button>
                        </form>
                    @endif
                    <div class="text-gray-600 hover:text-primary cursor-pointer">
                        <form action="/wishlist/{{ $wishlist->id }}" method="post">
                            @csrf()
                            @method('DELETE')
                            <button type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                <!-- single wishlist end -->
            @endforeach
        </div>
        <!-- account content end -->
    </div>
    <!-- account wrapper end -->
@endsection
