<?php

namespace App\Providers;

use App\Repositories\Brand\BrandInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Coupon\CouponInterface;
use App\Repositories\Coupon\CouponRepository;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Orderdetail\OrderdetailInterface;
use App\Repositories\Orderdetail\OrderdetailRepository;
use App\Repositories\Payment\PaymentInterface;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Shipping\ShippingInterface;
use App\Repositories\Shipping\ShippingRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\userRepository;
use App\Repositories\Wishlist\WishListInterface;
use App\Repositories\Wishlist\WishlistRepository;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        // $this->app->singleton(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(BrandInterface::class, BrandRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(CartInterface::class, CartRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(CouponInterface::class, CouponRepository::class);
        $this->app->bind(UserInterface::class, userRepository::class);
        $this->app->bind(WishListInterface::class, WishlistRepository::class);
        $this->app->bind(ShippingInterface::class, ShippingRepository::class);
        $this->app->bind(PaymentInterface::class, PaymentRepository::class);
        $this->app->bind(OrderdetailInterface::class, OrderdetailRepository::class);
    }
}