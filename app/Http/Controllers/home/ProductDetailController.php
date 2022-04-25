<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        $products = Products::find($id);
        $productRelated = Products::all()->random(4);
        $brand = Products::with('brand')
            ->where('id', '=', $id)
            ->first()
            ->brand;
        $category = Products::with('category')
            ->where('id', '=', $id)
            ->first()
            ->category;
        $categorylist = Category::all()->where('active', '=', 1);

        return view('app.detail')->with([
            'products' => $products, 'brand' => $brand,
            'category' => $category, 'productRelated' => $productRelated,
            'categoryList' => $categorylist,
        ]);
    }
}