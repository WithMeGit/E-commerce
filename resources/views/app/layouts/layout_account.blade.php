@extends('app.layouts.header')
@section('content')
    <!-- breadcrum -->
    <div class="py-4 container flex gap-3 items-center">
        <a href="/" class="text-primary text-base">
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
                    <a href="/accounts/profile" class="hover:text-primary transition capitalize block">Profile
                        information</a>
                    <a href=" /accounts/manage-address" class="hover:text-primary transition capitalize block">Manage
                        address</a>
                    <a href="/accounts/change-password" class="hover:text-primary transition capitalize block">change
                        password</a>
                </div>
                <!-- single link end -->

                <!-- single link -->
                <div class="pl-8 pt-4">
                    <a href="/wishlist"
                        class="relative medium capitalize text-gray-800 font-medium hover:text-primary transition block">
                        my wishlist
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="far fa-heart"></i>
                        </span>
                    </a>
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
        @yield('contents')
    </div>
    <!-- account wrapper end -->
@endsection
