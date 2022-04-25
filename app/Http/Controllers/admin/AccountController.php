<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        return view("admin.home");
    }

    public function loginpage()
    {
        return view("admin.login");
    }

    public function login(LoginRequest $request)
    {

        $loginData = User::where('email', '=', $request->email)->first();

        if (!$loginData) {
            $request->session()->flash('fail', __('messages.fail.email'));
            return redirect()->back();
        } else {
            if (Hash::check($request->password, $loginData->password)) {
                auth::login($loginData, true);
                return redirect('admin');
            } else {
                $request->session()->flash('fail', __('messages.fail.password'));
                return redirect()->back();
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

    public function registerpage()
    {
        return view("admin.register");
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['role'] = 1;
        $input['password'] = hash::make($input['password']);
        $user = User::create($input);
        auth::login($user, true);
        return view('admin.home');
    }
}