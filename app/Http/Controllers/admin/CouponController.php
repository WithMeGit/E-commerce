<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\Coupon\CouponInterface;

class CouponController extends Controller
{
    protected $couponRepository;

    public function __construct(CouponInterface $couponInterface)
    {
        $this->couponRepository = $couponInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->couponRepository->getAll();
        return view('admin.coupon')->with(['title' => 'Coupon List', 'couponList' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dialogcoupon')->with(['title' => 'Create Coupon', 'active' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCouponRequest $request)
    {
        $data = $request->all();
        $this->couponRepository->store($data);
        $request->session()->flash('success', __('messages.create.success'));

        return redirect('admin/coupons');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->couponRepository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);

        return view('admin.dialogcoupon')->with(['coupon' => $coupon, 'title' => 'Edit Coupon', 'active' => 'Save']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, $id)
    {
        $data = $request->all();
        $this->couponRepository->update($id, $data);

        $request->session()->flash('success', __('messages.update.success'));

        return redirect('admin/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->couponRepository->delete($id);
    }
}
