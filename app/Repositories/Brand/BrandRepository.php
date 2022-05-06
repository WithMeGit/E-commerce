<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Models\Category;

class BrandRepository implements BrandInterface
{
    public $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function getAll()
    {
        return $this->brand->paginate(5);
    }

    public function getAllCategory()
    {
        $category = Category::all();
        return $category;
    }

    public function store($request)
    {
        $this->brand::create($request->all());
    }

    public function update($request, $id)
    {
        $brand = $this->brand->find($id);
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;
        $brand->description = $request->description;
        $brand->active = $request->active;
        $brand->save();
    }

    public function find($id)
    {
        return $this->brand->find($id);
    }

    public function delete($id)
    {
        $this->brand->find($id)->delete($id);
        return TRUE;
    }
}