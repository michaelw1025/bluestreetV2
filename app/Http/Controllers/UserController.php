<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $users = $user->with('role')->get();
        return view('admin.users', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request, User $user, Role $role)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $user = $user->with('role')->find($id);
        $roles = $role->all();
        return view('admin.show-user', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);
        $user = $user->find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($user->save()){
            $user->role()->sync([$request->role]);
            \Session::flash('status', 'User edited.');
        }else{
            \Session::flash('error', 'User not edited.');
        }
        return redirect()->route('admin.users', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $user = $user->find($id);
        $user->role()->sync([]);

        if($user->delete()){
            \Session::flash('status', 'User deleted.');
        }else{
            \Session::flash('error', 'User not deleted.');
        }
        return redirect('admin.users');
    }
}
