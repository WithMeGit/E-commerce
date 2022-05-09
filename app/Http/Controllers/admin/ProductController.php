<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Jobs\JobSendEmailNotification;
use App\Repositories\Product\ProductInterface;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productRepository = $productInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->productRepository->getAll();
        $brand = $this->productRepository->getAllBrand();
        $category = $this->productRepository->getAllCategory();

        return view('admin.products')->with([
            'title' => 'Products List', 'productlist' => $product,
            'categorylist' => $category, 'brandlist' => $brand
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->productRepository->getAllCategory();
        $brand = $this->productRepository->getAllBrand();
        return view('admin.dialogproducts')->with([
            'title' => 'Create Product', 'active' => 'Create',
            'category' => $category, 'brand' => $brand
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'shop'
        ])->getSecurePath();
        $data['image'] = $uploadedFileUrl;
        $this->productRepository->store($data);

        $userList = $this->productRepository->getAllCustomer();

        foreach ($userList as $key => $user) {
            JobSendEmailNotification::dispatch($user->email);
        }

        $request->session()->flash('success', __('messages.create.success'));

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);
        $category = $this->productRepository->getAllCategory();
        $brand = $this->productRepository->getAllBrand();

        return view('admin.dialogproducts')->with([
            'title' => 'Detail Product', 'detailproduct' => $product,
            'brandlist' => $brand, 'categorylist' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $brand = $this->productRepository->getAllBrand();
        $category = $this->productRepository->getAllCategory();
        return view('admin.dialogproducts')->with([
            'editproduct' => $product, 'brandlist' => $brand,
            'categorylist' => $category, 'title' => 'Edit Category', 'active' => 'Save'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->all();
        if ($request->image != null) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'shop'
            ])->getSecurePath();
            $data['image'] = $uploadedFileUrl;
        }
        $this->productRepository->update($id, $data);

        $request->session()->flash('success', __('messages.update.success'));

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return  $this->productRepository->delete($id);
    }
}