<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryRepository extends BaseRepository implements CategoryInterface
{

    function __construct(Category $model)
    {
        $this->model = $model;
    }
}