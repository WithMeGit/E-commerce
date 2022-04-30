<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::paginate(5);
        return view('admin.category')->with(['categoryList' => $category, 'title' => 'Category List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dialogcategory')->with(['title' => 'Create Category', 'active' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'shop'
        ])->getSecurePath();

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $uploadedFileUrl,
            'active' => $request->active,
        ]);
        $request->session()->flash('success', __('messages.create.success'));

        return redirect('/admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', '=', $id)->first();
        return view('admin.dialogcategory')->with(['title' => 'Edit Category', 'active' => 'Save', 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $cate = Category::find($id);
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

        $request->session()->flash('success', __('messages.update.success'));

        return redirect("/admin/category");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return TRUE;
    }
}