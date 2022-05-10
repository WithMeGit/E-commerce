<?php

namespace App\Repositories\User;

use App\Constants\ShippingTypeContant;
use App\Models\Category;
use App\Models\Shipping;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UserDetail;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserInterface
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login($request)
    {
        $loginData = $this->model->where('email', '=', $request->email)->first();
        if (!$loginData) {
            return 2;
        } else {
            if (Hash::check($request->password, $loginData->password)) {
                Auth::login($loginData, true);
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function register($request)
    {
        $input = $request->all();
        $input['role'] = 1;
        $input['password'] = hash::make($input['password']);
        $user = $this->model->create($input);
        Auth::login($user, true);
    }

    public function logout($request)
    {
        Auth::logout();
    }

    public function getShipping()
    {
        return Shipping::where('user_id', '=', Auth::user()->id)->first();
    }

    public function getUser()
    {
        return User::where('id', '=', Auth::user()->id)->first();
    }

    public function getUserDetail()
    {
        return UserDetail::where('user_id', '=', Auth::user()->id)->first();
    }

    public function updateManageAddress($request)
    {
        $data = $request->all();
        $shipping = $this->getShipping();
        if ($shipping) {
            $shipping->update($data);
        } else {

            $data['user_id'] = Auth::user()->id;
            $data['type'] = ShippingTypeContant::HOME_DELIVERY;
            $shipping = Shipping::create($data);
        }
    }

    public function updateProfile($request)
    {
        $data = $request->all();
        $user = $this->getUser();
        $userdetail = $this->getUserDetail();
        $user->update($data);
        if ($userdetail) {
            $userdetail->update($data);
        } else {
            $data['user_id'] = Auth::user()->id;
            UserDetail::create($data);
        }
    }

    public function updateChangePassword($request)
    {
        $user = $this->getUser();;
        if (Hash::check($request->currentpassword, $user->password)) {
            $password = hash::make($request->password);
            $user->password = $password;
            $user->save();

            return TRUE;
        } else {

            return FALSE;
        }
    }
}