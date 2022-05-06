<?php

namespace App\Repositories\Product;

use App\Jobs\JobSendEmailNotification;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductRepository implements ProductInterface
{
    public $product;
    public function __construct(Products $product)
    {
        $this->product = $product;
    }
    public function getAll()
    {
        return $this->product->paginate(5);
    }

    public function getAllBrand()
    {
        return Brand::all();
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getAllCustomer()
    {
        return User::where('role', '=', 0)->get();
    }

    public function store($request)
    {
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'shop'
        ])->getSecurePath();

        $this->product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $uploadedFileUrl,
            'promotion_price' => $request->promotion_price,
            'original_price' => $request->original_price,
            'quantity' => $request->quantity,
            'active' => $request->active,
        ]);

        $userList = $this->getAllCustomer();

        foreach ($userList as $key => $user) {
            JobSendEmailNotification::dispatch($user->email);
        }
    }

    public function update($request, $id)
    {
        $product = $this->product->find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;

        if ($request->image != null) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'shop'
            ])->getSecurePath();
            $product->image = $uploadedFileUrl;
        }
        $product->promotion_price = $request->promotion_price;
        $product->original_price = $request->original_price;
        $product->quantity = $request->quantity;
        $product->active = $request->active;
        $product->save();
    }

    public function find($id)
    {
        return $this->product->find($id);
    }
    public function delete($id)
    {
        $this->product->find($id)->delete($id);
        return TRUE;
    }
}