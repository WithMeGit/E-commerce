<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userInterface)
    {
        $this->userRepository = $userInterface;
    }

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

        if ($this->userRepository->login($request) == 1) {
            return redirect("admin");
        } else if ($this->userRepository->login($request) == 2) {
            $request->session()->flash('fail', __('messages.fail.email'));
            return redirect()->back();
        } else {
            $request->session()->flash('fail', __('messages.fail.password'));
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        $this->userRepository->logout($request);

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
        $this->userRepository->register($request);

        return view('admin.home');
    }
}