<?php

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

Route::get('/', [\App\Http\Controllers\home\homecontroller::class, 'index']);
Route::get('/home', [\App\Http\Controllers\home\homecontroller::class, 'index']);
Route::get('/product', [\App\Http\Controllers\home\productcontroller::class, 'index']);
Route::get('/checkout', [\App\Http\Controllers\home\checkoutcontroller::class, 'index']);
Route::get('/order', [\App\Http\Controllers\home\ordercontroller::class, 'index']);
Route::get('/cart', [\App\Http\Controllers\home\cartcontroller::class, 'index']);
Route::get('/account', [\App\Http\Controllers\home\accountcontroller::class, 'index']);
Route::get('/wishlist', [\App\Http\Controllers\home\wishlistcontroller::class, 'index']);
Route::get('/detail', [\App\Http\Controllers\home\detailcontroller::class, 'index']);

Route::get('/admin/login', [\App\Http\Controllers\admin\accountcontroller::class, 'loginpage']);
Route::post('/admin/login', [\App\Http\Controllers\admin\accountcontroller::class, 'login']);
Route::get('/admin/register', [\App\Http\Controllers\admin\accountcontroller::class, 'registerpage']);
Route::post('/admin/register', [\App\Http\Controllers\admin\accountcontroller::class, 'register']);

Route::middleware(['admin'])->group(function (){
    Route::get('/admin', [\App\Http\Controllers\admin\accountcontroller::class, 'index']);
});
