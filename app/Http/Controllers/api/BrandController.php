<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Repositories\Brand\BrandInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandInterface $brandInterface)
    {
        $this->brandRepository = $brandInterface;
    }

    public function getAllBrand()
    {
        return BrandResource::collection($this->brandRepository->getAll());
    }

    public function getBrandByID($id)
    {
        return new BrandResource($this->brandRepository->find($id));
    }

    public function createBrand(CreateBrandRequest $request)
    {
        $data = [];
        $data = $request->all();
        $brand = new BrandResource($this->brandRepository->store($data));
        return response()->json([
            'status' => 201,
            'data' => $brand,
            'message' => 'Created Successfully',
        ]);
    }

    public function updateBrand(UpdateBrandRequest $request, $id)
    {
        $data = [];
        $data = $request->all();
        $brand = $this->brandRepository->update($id, $data);
    }
}
