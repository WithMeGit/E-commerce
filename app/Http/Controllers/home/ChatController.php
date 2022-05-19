<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userInterface)
    {
        $this->userRepository = $userInterface;
    }
    public function index()
    {
        $category = $this->userRepository->getCategoryActive();
        return view('app.chat')->with(['categoryList' => $category]);
    }
}
