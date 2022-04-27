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

        return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
    }

    public function show($name)
    {
        $check_name_cate = Category::where('name', '=', $name)->first();
        $check_name_brand = Brand::where('name', '=', $name)->first();

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

    public function searchProduct(Request $request)
    {
        $category = Category::withCount('products')->where('active', '=', 1)->get();

        $brand = Brand::withCount('products')->where('active', '=', 1)->get();

        $check_name_product = Products::where('name', 'like', "%{$request->search_name}%")->first();
        if ($check_name_product) {
            $products = Products::where('name', 'like', "%{$request->search_name}%")->paginate(6);
            return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
        } else {
            return view("app.products")->with(['namesearch' => $request->search_name, 'categoryList' => $category, 'brandList' => $brand]);
        }
    }
}