<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Products::paginate(5);
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.products')->with(['title' => 'Products List', 'productlist' => $product, 'categorylist' => $category, 'brandlist' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.dialogproducts')->with(['title' => 'Create Product', 'active' => 'Create','category' => $category, 'brand' => $brand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required',
            'image' => 'required|| image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if($validator->fails()){
            $request->session()->flash('error', 'Fail!');
            return redirect()->back();
        }
        $check = Products::where('name','=',$request->name)->first();
        if($check){
            $request->session()->flash('error','Product already exists');
            return redirect()->back();
        }else{
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(),[
                'folder' => 'shop'
            ])->getSecurePath();

            Products::create([
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'name' => $request->name,
                'description' => $request->description,
                'image' => $uploadedFileUrl,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'active' => $request->active,
            ]);
            $request->session()->flash('success', 'Created Successfully ');
        }
        return redirect('admin/products');
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);
        $category = Category::all();
        $brand = Brand::all();

        return view('admin.dialogproducts')->with(['title' => 'Detail Product', 'detailproduct' => $product, 'brandlist' => $brand, 'categorylist' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $brand = Brand::all();
        $category = Category::all();
        return view('admin.dialogproducts')->with(['editproduct' => $product, 'brandlist' => $brand, 'categorylist' => $category, 'title' => 'Edit Category', 'active' => 'Save']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            $request->session()->flash('error', 'Fail!');
            return redirect()->back();
        }else{
               $product = Products::find($id);

            if($request->image == null){

                $url = $product->image;

                $product->name = $request->name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->description = $request->description;
                $product->image = $url;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->active = $request->active;
                $product->save();

            }else{
                $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(),[
                    'folder' => 'shop'
                ])->getSecurePath();

                $product->name = $request->name;
                $product->category_id = $request->category_id;
                $product->brand_id = $request->brand_id;
                $product->description = $request->description;
                $product->image = $uploadedFileUrl;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->active = $request->active;

                $product->save();
            }
            $request->session()->flash('success', 'Created Successfully ');
        }
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
        $product = Products::find($id);
        if(!$product){
            Response('Category does not exist.', 404);
        }
        $product->delete();
        return TRUE;
    }
}
