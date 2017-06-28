<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoresUser;
use App\Http\Requests\UpdatesUser;

class UserController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('check_if_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_users  = User::latest()->paginate(10);
        $deleted_users = User::onlyTrashed()->latest()->paginate(10);

        return view('content-management.users.index')
            ->with('active_users', $active_users)
            ->with('deleted_users', $deleted_users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content-management.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresUser $request)
    {
        $user = $request->store();
        flash('User created', 'success');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('content-management.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesUser $request, User $user)
    {
        $user = $request->update($user);
        flash('User updated', 'success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
