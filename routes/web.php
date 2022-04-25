<?php

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
Route::get('/home', [\App\Http\Controllers\home\homeController::class, 'index']);
Route::get('/products', [\App\Http\Controllers\home\ProductController::class, 'index']);
Route::get('/products/{name}', [\App\Http\Controllers\home\ProductController::class, 'show']);
Route::get('/products/detail/{id}', [\App\Http\Controllers\home\ProductDetailController::class, 'index']);
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [\App\Http\Controllers\home\checkoutcontroller::class, 'index']);

    //carts
    Route::get('/carts', [\App\Http\Controllers\home\CartController::class, 'index']);
    Route::post('/carts', [\App\Http\Controllers\home\CartController::class, 'create']);
    Route::post('/carts/{id}', [\App\Http\Controllers\home\CartController::class, 'update']);
    Route::delete('/carts/{id}', [\App\Http\Controllers\home\CartController::class, 'destroy']);

    //
    Route::get('/orders', [\App\Http\Controllers\home\ordercontroller::class, 'index']);
    Route::get('/accounts', [\App\Http\Controllers\home\accountcontroller::class, 'index']);

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
});