<?php

namespace App\Repositories\User;

use App\Constants\ShippingTypeContant;
use App\Models\Category;
use App\Models\Shipping;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;

class userRepository implements UserInterface
{

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->paginate(5);
    }

    public function store($request)
    {
        $input = $request->all();
        $input['password'] = hash::make($input['password']);
        $this->user::create($input);
    }

    public function update($request, $id)
    {
        $user = $this->user->find($id);
        $input = $request->all();
        $input['password'] = hash::make($input['password']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->role = $input['role'];

        $user->save();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function login($request)
    {
        $loginData = $this->user->where('email', '=', $request->email)->first();
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
        $user = $this->user->create($input);
        Auth::login($user, true);
    }

    public function logout($request)
    {
        Auth::logout();
    }

    public function getCategoryActive()
    {
        return Category::all()->where('active', '=', 1);
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
        $shipping = $this->getShipping();
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
    }

    public function updateProfile($request)
    {
        $user = $this->getUser();
        $userdetail = $this->getUserDetail();
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