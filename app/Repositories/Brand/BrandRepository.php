<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Models\Category;
use App\Repositories\BaseRepository;

class BrandRepository extends BaseRepository implements BrandInterface
{
    public function __construct(Brand $model)
    {
        $this->model = $model;
    }

    public function getAllCategory()
    {
        return Category::all();
    }
}