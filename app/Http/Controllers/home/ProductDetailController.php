<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use Illuminate\Support\Facades\Auth;

class ProductDetailController extends Controller
{

    protected $productRepository;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }
    public function index($id)
    {
        if (Auth::user()) {
            $this->productRepository->countItem(request());
        }

        $products = $this->productRepository->find($id);
        $productRelated = $this->productRepository->getAllProductActiveRandom(4);
        $brand = $this->productRepository->getBrandWithProductByID($id);
        $category = $this->productRepository->getCategoryWithProductByID($id);
        $categorylist = $this->productRepository->getCategoryActive();

        return view('app.detail')->with([
            'products' => $products, 'brand' => $brand,
            'category' => $category, 'productRelated' => $productRelated,
            'categoryList' => $categorylist,
        ]);
    }
}