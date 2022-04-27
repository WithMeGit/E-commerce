<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $category = Category::all()->where('active', '=', 1);
        return view("app.account")->with(['categoryList' => $category]);
    }
}