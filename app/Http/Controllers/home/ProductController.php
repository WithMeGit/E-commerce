<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }
    public function index()
    {
        $products = $this->productRepository->getAllProductActive(6);

        $category = $this->productRepository->countCategory();

        if (Auth::user()) {
            $this->productRepository->countItem(request());
        }

        $brand = $this->productRepository->countBrand();

        return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
    }

    public function show($name)
    {
        $check_name_cate = $this->productRepository->getCategoryByName($name);
        $check_name_brand = $this->productRepository->getBrandByName($name);

        $category = $this->productRepository->countCategory();

        $brand = $this->productRepository->countBrand();


        if ($check_name_cate) {
            $products = $this->productRepository->getProductByCategoryName($name);

            return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
        }
        if ($check_name_brand) {
            $products = $this->productRepository->getProductByBrandName($name);

            return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
        }
    }

    public function searchProduct(Request $request)
    {
        $category = $this->productRepository->countCategory();

        $brand = $this->productRepository->countBrand();

        $check_name_product = $this->productRepository->checkProductByName($request->search_name);
        if ($check_name_product) {
            $products = $this->productRepository->getProductByName($request->search_name);
            return view("app.products")->with(['productList' => $products, 'categoryList' => $category, 'brandList' => $brand]);
        } else {
            return view("app.products")->with(['namesearch' => $request->search_name, 'categoryList' => $category, 'brandList' => $brand]);
        }
    }
}
