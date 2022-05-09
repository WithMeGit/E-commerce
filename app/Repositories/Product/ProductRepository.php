<?php

namespace App\Repositories\Product;

use App\Jobs\JobSendEmailNotification;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use App\Repositories\BaseRepository;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Products $model)
    {
        $this->model = $model;
    }

    public function getAllProductActive($number)
    {
        return $this->model->where('active', '=', 1)->paginate($number);
    }

    public function getAllProductActiveRandom($number)
    {
        return $this->model->all()->where('active', '=', 1)->random($number);
    }

    public function getAllBrand()
    {
        return Brand::all();
    }

    public function getBrandWithProductByID($id)
    {
        return Products::with('brand')
            ->where('id', '=', $id)
            ->first()
            ->brand;
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getCategoryWithProductByID($id)
    {
        return Products::with('category')
            ->where('id', '=', $id)
            ->first()
            ->category;
    }

    public function getAllCustomer()
    {
        return User::where('role', '=', 0)->get();
    }

    public function getBrandByName($name)
    {
        return Brand::where('name', '=', $name)->first();
    }

    public function getCategoryByName($name)
    {
        return Category::where('name', '=', $name)->first();
    }

    public function getProductByBrandName($name)
    {
        return Brand::with('products')
            ->where('name', '=', $name)
            ->first()
            ->products()
            ->paginate(6);
    }

    public function getProductByCategoryName($name)
    {
        return Category::with('products')
            ->where('name', '=', $name)
            ->first()
            ->products()
            ->paginate(6);
    }

    public function getProductByName($request)
    {
        return $this->model->where('name', 'like', "%{$request->search_name}%")->paginate(6);
    }

    public function checkProductByName($request)
    {
        return $this->model->where('name', 'like', "%{$request->search_name}%")->first();
    }

    public function countBrand()
    {
        return Brand::withCount('products')->where('active', '=', 1)->get();
    }

    public function countCategory()
    {
        return Category::withCount('products')->where('active', '=', 1)->get();
    }

    public function searchProduct($request)
    {
        return $this->model->where("name", 'like', "%{$request->search_name}%")
            ->select('id', 'name')
            ->get();
    }
}