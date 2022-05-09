<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [\App\Http\Controllers\home\homeController::class, 'index']);
Route::post('/home', [\App\Http\Controllers\home\homeController::class, 'searchAutocomplete']);
Route::post('/checkorder', [\App\Http\Controllers\home\homeController::class, 'checkOrder']);
Route::get('/home', [\App\Http\Controllers\home\homeController::class, 'index']);
Route::get('/products', [\App\Http\Controllers\home\ProductController::class, 'index']);
Route::get('/products/{name}', [\App\Http\Controllers\home\ProductController::class, 'show']);
Route::post('/products', [\App\Http\Controllers\home\ProductController::class, 'searchProduct']);
Route::get('/products/detail/{id}', [\App\Http\Controllers\home\ProductDetailController::class, 'index']);
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [\App\Http\Controllers\home\CheckOutController::class, 'index']);
    Route::post('/checkout', [\App\Http\Controllers\home\CheckOutController::class, 'placeOrder']);

    Route::get('/order-complete', function () {
        $category = Category::all()->where('active', '=', 1);
        return view("app.order-complete")->with(['categoryList' => $category]);
    });
    Route::get('order/detail/{id}', [\App\Http\Controllers\home\OrderController::class, 'orderdetail']);

    //carts
    Route::get('/carts', [\App\Http\Controllers\home\CartController::class, 'index']);
    Route::post('/carts', [\App\Http\Controllers\home\CartController::class, 'create']);
    Route::delete('/carts/{id}', [\App\Http\Controllers\home\CartController::class, 'destroy']);
    Route::post('/applycoupon', [\App\Http\Controllers\home\CartController::class, 'applyCoupon']);

    //
    Route::get('/orders', [\App\Http\Controllers\home\OrderController::class, 'index']);
    Route::get('/accounts', [\App\Http\Controllers\home\AccountController::class, 'index']);
    Route::get('/accounts/manage-address', [\App\Http\Controllers\home\AccountController::class, 'showManageAddress']);
    Route::post('/accounts/manage-address', [\App\Http\Controllers\home\AccountController::class, 'updateManageAddress']);
    Route::get('/accounts/profile', [\App\Http\Controllers\home\AccountController::class, 'showProfile']);
    Route::post('/accounts/profile', [\App\Http\Controllers\home\AccountController::class, 'updateProfile']);
    Route::get('/accounts/change-password', [\App\Http\Controllers\home\AccountController::class, 'showChangePassword']);
    Route::post('/accounts/change-password', [\App\Http\Controllers\home\AccountController::class, 'updateChangePassword']);

    //wishlist
    Route::get('/wishlist', [\App\Http\Controllers\home\WishListController::class, 'index']);
    Route::post('/wishlist', [\App\Http\Controllers\home\WishListController::class, 'create']);
    Route::delete('/wishlist/{id}', [\App\Http\Controllers\home\WishListController::class, 'destroy']);
});


Route::get('/admin/login', [\App\Http\Controllers\admin\AccountController::class, 'loginpage']);
Route::post('/admin/login', [\App\Http\Controllers\admin\AccountController::class, 'login']);
Route::get('/admin/register', [\App\Http\Controllers\admin\AccountController::class, 'registerpage']);
Route::post('/admin/register', [\App\Http\Controllers\admin\AccountController::class, 'register']);
Route::get('/admin/logout', [\App\Http\Controllers\admin\AccountController::class, 'logout']);
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\admin\AccountController::class, 'index']);

    //users
    Route::resource('admin/users', \App\Http\Controllers\admin\UserController::class);
    Route::post('admin/users/{id}', [\App\Http\Controllers\admin\UserController::class, 'update']);

    //oder
    Route::resource('admin/orders', \App\Http\Controllers\admin\OrderController::class);
    Route::post('admin/orders/{id}', [\App\Http\Controllers\admin\OrderController::class, 'updateOrder']);

    //cart
    Route::resource('admin/carts', \App\Http\Controllers\admin\CartController::class);

    //category
    Route::resource('/admin/category', \App\Http\Controllers\admin\CategoryController::class);
    Route::post('admin/category/{id}', [\App\Http\Controllers\admin\CategoryController::class, 'update']);

    //brand
    Route::resource('/admin/brands', \App\Http\Controllers\admin\BrandController::class);
    Route::post('admin/brands/{id}', [\App\Http\Controllers\admin\BrandController::class, 'update']);

    //products
    Route::resource('/admin/products', \App\Http\Controllers\admin\ProductController::class);
    Route::post('admin/products/{id}', [\App\Http\Controllers\admin\ProductController::class, 'update']);

    //coupon
    Route::resource('/admin/coupons', \App\Http\Controllers\admin\CouponController::class);
    Route::post('/admin/coupons/{id}', [App\Http\Controllers\admin\CouponController::class, 'update']);
});