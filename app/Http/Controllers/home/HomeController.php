<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $productTopNewArrival = Products::all()->random(4)->where('active', '=' , 1);
        $productRecomended = Products::all()->random(8)->where('active', '=' , 1);
        $brand = Brand::all()->where('active','=',1);
        $category = Brand::all()->where('active','=',1);
        return view("app.home")->with(['productTopNewArrival' => $productTopNewArrival, 'productRecomended' => $productRecomended,'categorylist' => $category, 'brandlist' => $brand]);
    }
}
