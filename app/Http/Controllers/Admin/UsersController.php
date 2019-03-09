<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index')
                ->with('users', User::orderBy('name')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $attributes['password'] = bcrypt($request->password);
        $attributes['status'] = $request->status??User::DEACTIVE;
        $attributes['is_admin'] = $request->is_admin??User::REGULAR_USER;

        if(User::create($attributes)){
            Session::flash('success','User has been created successfully');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if($request->password != null){
            $attributes['password'] = bcrypt($request->password);
        }
        else{
            $attributes['password'] = $user->password;
        }

        $attributes['status'] = $request->status?User::ACTIVE:User::DEACTIVE;
        $attributes['is_admin'] = $request->is_admin?User::ADMIN_USER:User::REGULAR_USER;
        
        if($user->update($attributes)){
            Session::flash('success','User has been updated successfully');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            Session::flash('success','User has been deleted successfully');
        }
        return redirect()->back();
    }

    public function status(User $user)
    {
        if ($user->update([
            'status' => !$user->status,
        ])) {
            Session::flash('success', 'User status has been changed successfull');
        }

        return back();
    }

    public function type(User $user)
    {
        if ($user->update([
            'is_admin' => !$user->is_admin,
        ])) {
            Session::flash('success', 'User type has been changed successfull');
        }

        return back();
    }
}
