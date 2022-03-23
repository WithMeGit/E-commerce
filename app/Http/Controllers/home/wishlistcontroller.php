<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class wishlistcontroller extends Controller
{
    public function index() {
        return view("app.wishlist");
    }
}

