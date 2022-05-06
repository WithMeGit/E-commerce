<?php

namespace App\Repositories\Category;

use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryRepository implements CategoryInterface
{
    public $category;

    function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->paginate(5);
    }

    public function store($request)
    {
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'shop'
        ])->getSecurePath();

        $this->category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $uploadedFileUrl,
            'active' => $request->active,
        ]);
    }

    public function update($request, $id)
    {
        $cate = $this->category->find($id);
        if ($request->image == null) {
            $url = $cate->image;

            $cate->name = $request->name;
            $cate->description = $request->description;
            $cate->image = $url;
            $cate->active = $request->active;
            $cate->save();
        } else {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'shop'
            ])->getSecurePath();

            $cate->name = $request->name;
            $cate->description = $request->description;
            $cate->image = $uploadedFileUrl;
            $cate->active = $request->active;
            $cate->save();
        }
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function delete($id)
    {
        $this->category->find($id)->delete($id);
        return TRUE;
    }
}