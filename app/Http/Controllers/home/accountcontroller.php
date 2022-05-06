<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManageAddressRequest;
use App\Http\Requests\UpdateChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Brand\BrandInterface;
use App\Repositories\User\UserInterface;

class AccountController extends Controller
{
    protected $userRepository;
    protected $brandRepository;

    public function __construct(UserInterface $userInterface, BrandInterface $brandInterface)
    {
        $this->userRepository = $userInterface;
        $this->brandRepository = $brandInterface;
    }

    public function index()
    {
        $cate = $this->brandRepository->getAllCategory();
        dd($cate);
        $category = $this->userRepository->getCategoryActive();

        $shipping = $this->userRepository->getShipping();
        $user = $this->userRepository->getUser();
        if ($shipping) {
            return view("app.account")->with(['categoryList' => $category, 'shipping' => $shipping, 'user' => $user]);
        }

        return view("app.account")->with(['categoryList' => $category, 'user' => $user]);
    }

    public function showManageAddress()
    {
        $shipping = $this->userRepository->getShipping();
        $category = $this->userRepository->getCategoryActive();
        if ($shipping) {
            return view("app.manage-address")->with(['categoryList' => $category, 'shipping' => $shipping]);
        }
        return view("app.manage-address")->with(['categoryList' => $category]);
    }

    public function updateManageAddress(ManageAddressRequest $request)
    {
        $this->userRepository->updateManageAddress($request);

        return redirect('/accounts');
    }

    public function showProfile()
    {
        $category = $this->userRepository->getCategoryActive();
        $userdetail = $this->userRepository->getUserDetail();
        if ($userdetail) {
            return view("app.profile")->with(['userdetail' => $userdetail, 'categoryList' => $category]);
        }

        return view("app.profile");
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->userRepository->updateProfile($request);

        return redirect('/accounts');
    }

    public function showChangePassword()
    {
        $category = $this->userRepository->getCategoryActive();
        return view("app.change-password")->with(['categoryList' => $category]);
    }
    public function updateChangePassword(UpdateChangePasswordRequest $request)
    {
        if ($this->userRepository->updateChangePassword($request) == TRUE) {
            $request->session()->flash('success', 'Change password successfully');
            return redirect('/accounts');
        } else {
            $request->session()->flash('fail', 'Current password incorrect');
            return redirect()->back();
        }
    }
}