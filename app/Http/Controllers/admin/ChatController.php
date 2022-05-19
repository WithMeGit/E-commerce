<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public $userReository;

    public function __construct(UserInterface $userInterface)
    {
        $this->userReository = $userInterface;
    }

    public function index()
    {
        $users = $this->userReository->getAllUser();

        return view('admin.chat')->with(['userList' => $users]);
    }
}
