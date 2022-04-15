<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::paginate(5);
        return view('admin.brands')->with(['title' => 'Brand List', 'brandlist' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.dialogbrands')->with(['title' => 'Create Brand', 'active' => 'Create','category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $check = Brand::where('name','=',$request->name)->first();
        if($check)
        {
            $request->session()->flash('error', 'Brand already exists');
            return redirect()->back();
        }else{
            Brand::create($request->all());
            $request->session()->flash('success', 'Created Successfully ');
        }

        return redirect('admin/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return $brand;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::where('id', '=', $id)->first();
        $category = Category::all();
        return view('admin.dialogbrands')->with(['brand' => $brand,'category' => $category, 'title' => 'Edit Brand','active' => 'Save']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;
        $brand->description = $request->description;
        $brand->content = $request['content'];
        $brand->active = $request->active;
        $brand->save();
        $request->session()->flash('success', 'Edited Successfully');

        return redirect('admin/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if(!$brand)
        {
            Response('Category does not exist.', 404);
        }
        $brand->delete();
        return TRUE;
    }
}
