<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class accountcontroller extends Controller
{
    public function index(){
        return view("admin.home");
    }

    public function loginpage(){
        return view("admin.login");
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $loginData = User::where('email','=',$request->email)->first();

        if(!$loginData){
            return redirect() -> back()->with('fail','Email dose not exist');
        }else{
            if(Hash::check($request->password,$loginData->password)){
                auth::login($loginData,true);
                return redirect('admin');
            }else{
                return redirect()->back()->with('fail', 'Incorrect password');
            }
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

    public function registerpage(){
        return view("admin.register");
    }

    public function register(Request $request){
        $input = $request->all();

        $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $input['role'] = 1;
        $input['password'] = hash::make( $input['password']);
        $user = User::create($input);
        auth::login($user, true);
        return view('admin.home');

    }

}
