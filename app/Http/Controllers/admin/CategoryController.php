<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\Category\CategoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryRepository = $categoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->categoryRepository->getAll();

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
        $this->categoryRepository->store($request);

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
        return $this->categoryRepository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
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
        $this->categoryRepository->update($request, $id);

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
        return $this->categoryRepository->delete($id);
    }
}