<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('admin.category')->with(['categoryList'=> $category, 'title' => 'Category List']);
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
    public function store(CategoryRequest $request)
    {
        $check = Category::where('name','=',$request->name)->first();
        if($check)
        {
            $request->session()->flash('error', 'Category already exists');
            return redirect()->back();
        }else{
            Category::create($request->all());
            $request->session()->flash('success', 'Created Successfully ');
        }

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
    public function update(BrandRequest $request, $id)
    {
        $cate = Category::find($id);
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->content = $request['content'];
        $cate->active = $request->active;
        $cate->save();
        $request->session()->flash('success', 'Edited Successfully');

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

        if(!$category)
        {
            Response('Category does not exist.', 404);
        }
        $category->delete();
        return TRUE;
    }
}
