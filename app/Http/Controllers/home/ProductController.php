<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::paginate(6);

        $category = Category::withCount('products')->where('active', '=', 1)->get();

        $brand = Brand::withCount('products')->where('active', '=', 1)->get();

        $cartCount = null;
        if (Auth::user()) {
            $cartCount = Cart::where('user_id', '=', Auth::user()->id)->count();
        }


        return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand, 'cartCount' => $cartCount]);
    }

    public function show($name)
    {
        $check_name_cate = Category::where('name', 'like', $name)->first();
        $check_name_brand = Brand::where('name', 'like', $name)->first();

        $category = Category::withCount('products')->where('active', '=', 1)->get();

        $brand = Brand::withCount('products')->where('active', '=', 1)->get();


        if ($check_name_cate) {
            $products = Category::with('products')
                ->where('name', '=', $name)
                ->first()
                ->products()
                ->paginate(6);

            return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
        }
        if ($check_name_brand) {
            $products = Brand::with('products')
                ->where('name', '=', $name)
                ->first()
                ->products()
                ->paginate(6);

            return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
        }
    }
}