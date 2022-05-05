<?php

namespace App\Http\Controllers\home;

use App\Constants\ShippingTypeContant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManageAddressRequest;
use App\Http\Requests\UpdateChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Category;
use App\Models\Shipping;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $category = Category::all()->where('active', '=', 1);

        $shipping = Shipping::where('user_id', '=', Auth::user()->id)->first();
        $user = User::where('id', '=', Auth::user()->id)->first();
        if ($shipping) {
            return view("app.account")->with(['categoryList' => $category, 'shipping' => $shipping, 'user' => $user]);
        }

        return view("app.account")->with(['categoryList' => $category, 'user' => $user]);
    }

    public function showManageAddress()
    {
        $shipping = Shipping::where('user_id', '=', Auth::user()->id)->first();
        $category = Category::all()->where('active', '=', 1);

        if ($shipping) {
            return view("app.manage-address")->with(['categoryList' => $category, 'shipping' => $shipping]);
        }
        return view("app.manage-address")->with(['categoryList' => $category]);
    }

    public function updateManageAddress(ManageAddressRequest $request)
    {
        $shipping = Shipping::where('user_id', '=', Auth::user()->id)->first();
        if ($shipping) {
            $shipping->name = $request->name;
            $shipping->email = $request->email;
            $shipping->phone = $request->phone;
            $shipping->address = $request->address;
            $shipping->save();
        } else {

            $shipping = Shipping::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'type' => ShippingTypeContant::HOME_DELIVERY,
            ]);
        }

        return redirect('/accounts');
    }

    public function showProfile()
    {
        $category = Category::all()->where('active', '=', 1);
        $userdetail = UserDetail::where('user_id', '=', Auth::user()->id)->first();
        if ($userdetail) {
            return view("app.profile")->with(['userdetail' => $userdetail, 'categoryList' => $category]);
        }

        return view("app.profile");
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        $userdetail = UserDetail::where('user_id', '=', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        if ($userdetail) {
            $userdetail->birthday = $request->birthday;
            $userdetail->gender = $request->gender;
            $userdetail->phone = $request->phone;
            $userdetail->save();
        } else {
            UserDetail::create([
                'user_id' => Auth::user()->id,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'phone' => $request->phone,
            ]);
        }
        return redirect('/accounts');
    }

    public function showChangePassword()
    {
        $category = Category::all()->where('active', '=', 1);
        return view("app.change-password")->with(['categoryList' => $category]);
    }
    public function updateChangePassword(UpdateChangePasswordRequest $request)
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        if (Hash::check($request->currentpassword, $user->password)) {
            $password = hash::make($request->password);
            $user->password = $password;
            $user->save();
            $request->session()->flash('success', 'Change password successfully');
            return redirect('/accounts');
        } else {
            $request->session()->flash('fail', 'Current password incorrect');
            return redirect()->back();
        }
    }
}