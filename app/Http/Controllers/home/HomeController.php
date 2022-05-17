<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productRepository;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }

    public function index()
    {
        $productTopNewArrival = $this->productRepository->getAllProductActiveRandom(4);
        $productRecomended = $this->productRepository->getAllProductActiveRandom(8);
        $category = $this->productRepository->getCategoryActive();
        if (Auth::user()) {
            $this->productRepository->countItem(request());
        }
        return view("app.home")->with([
            'productTopNewArrival' => $productTopNewArrival,
            'productRecomended' => $productRecomended, 'categoryList' => $category,
        ]);
    }

    public function searchAutocomplete(Request $request)
    {
        $data = $this->productRepository->searchProduct($request->search_name);

        $output = '<ul class="z-50 absolute mt-12 w-9/12 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">';
        foreach ($data as $item) {
            $output .= '<li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600"><a href="/products/detail/' . $item->id . '">' . $item->name . '</a></li>';
        }
        $output .= '</ul>';

        echo $output;
    }

    public function checkOrder(Request $request)
    {
        if (Auth::user()) {
            if ($request->user_id == Auth::user()->id) {
                return true;
            }
        }
        return false;
    }
}
