<?php

use App\Http\Controllers\api\BrandController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/product', [ProductController::class, 'getAllProduct']);
Route::get('/product/{id}', [ProductController::class, 'getProductByID']);
Route::post('/product', [ProductController::class, 'searchProduct']);

Route::get('/brand', [BrandController::class, "getAllBrand"]);
Route::get('/brand/{id}', [BrandController::class, "getBrandByID"]);
Route::post('/brand', [BrandController::class, "createBrand"]);

// Route::post('/product/create', [ProductController::class, 'createProduct']);
// Route::post('/proudct/create', [ProductController::class, 'createProduct']);
// Route::put('/proudct', [ProductController::class, 'updateProduct']);
// Route::delete('/proudct/{id}', [ProductController::class, 'deleteProduct']);
