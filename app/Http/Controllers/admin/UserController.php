<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditAccountRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserInterface $userInterface)
    {
        $this->userRepository = $userInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->userRepository->getAll();

        return view('admin.users')->with(['userlist' => $user, 'title' => 'User List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dialogusers')->with(['title' => 'Create Users', 'active' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = hash::make($data['password']);
        $this->userRepository->store($data);
        $request->session()->flash('success', __('messages.carete.success'));
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return view('admin.dialogusers')->with(['user' => $user, 'title' => 'Edit User', 'active' => 'Save']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAccountRequest $request, $id)
    {

        $data = $request->all();
        $data['password'] = hash::make($data['password']);
        $this->userRepository->update($id, $data);

        $request->session()->flash('success', __('messages.update.success'));
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}