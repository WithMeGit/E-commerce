<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Repositories\Brand\BrandInterface;

class BrandController extends Controller
{
    protected $brandRepository;
    public function __construct(BrandInterface $brandInterface)
    {
        $this->brandRepository = $brandInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = $this->brandRepository->getAll();
        return view('admin.brands')->with(['title' => 'Brand List', 'brandlist' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->brandRepository->getAllCategory();
        return view('admin.dialogbrands')->with(['title' => 'Create Brand', 'active' => 'Create', 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        $data = $request->all();
        $this->brandRepository->store($data);
        $request->session()->flash('success', __('messages.create.success'));

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
        return $this->brandRepository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brandRepository->find($id);
        $category = $this->brandRepository->getAllCategory();
        return view('admin.dialogbrands')->with([
            'brand' => $brand, 'category' => $category,
            'title' => 'Edit Brand', 'active' => 'Save'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $data = $request->all();
        $this->brandRepository->update($id, $data);
        $request->session()->flash('success', __('messages.update.success'));

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
        return $this->brandRepository->delete($id);
    }
}