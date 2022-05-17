<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }

    public function getAllProduct()
    {
        return $this->productRepository->getAllProductActive(6);
    }

    public function getProductByID($id)
    {
        return $this->productRepository->find($id);
    }

    public function searchProduct(Request $request)
    {
        $check_name_product = $this->productRepository->checkProductByName($request->search_name);
        if ($check_name_product) {
            return $this->productRepository->searchProduct($request->search_name);
        } else {
            return response()->json('not found');
        }
    }
}
