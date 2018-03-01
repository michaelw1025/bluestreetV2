<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        return view('admin.index');
    }

    public function showUsers(Request $request, User $user)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        $users = $user->with('role')->get();
        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function show(Request $request, User $user, Role $role, $id)
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

    public function update(Request $request, User $user, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        return redirect()->route('admin.users', $id);
    }

    public function destroy(Request $request, User $user, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        return redirect('admin.users');
    }
}
