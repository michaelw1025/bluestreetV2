<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        return view('admin.index');
    }
}
