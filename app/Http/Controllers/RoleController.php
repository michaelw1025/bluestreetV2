<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $role)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        $roles = $role->all();
        return view('admin.roles', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
    public function store(Request $request, Role $role)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        $this->validate($request,[
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'required|string|max:255',
        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        if($role->save()){
            \Session::flash('status', 'Role created.');
        }else{
            \Session::flash('error', 'Role not created.');
        }
        return redirect('admin.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Role $role, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        $role = $role->find($id);
        return view('admin.show-role', [
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
    public function update(Request $request, Role $role, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        $this->validate($request,[
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'description' => 'required|string|max:255',
        ]);
        $role = $role->find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        if($role->save()){
            \Session::flash('status', 'Role edited.');
        }else{
            \Session::flash('error', 'Role not edited.');
        }
        return redirect()->route('admin.roles', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        $role = $role->find($id);
        if($role->delete()){
            \Session::flash('status', 'Role deleted.');
        }else{
            \Session::flash('error', 'Role not deleted.');
        }
        return redirect('admin.roles');
    }
}
