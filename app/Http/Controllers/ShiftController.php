<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Shift $shift)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $shifts = $shift->orderBy('description', 'asc')->get();
        return view('hr.shifts', [
            'shifts' => $shifts,
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shift $shift)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:shifts',
        ]);
        $shift = new Shift();
        $shift->description = $request->description;
        if($shift->save()){
            \Session::flash('status', 'Shift created.');
        }else{
            \Session::flash('error', 'Shift not created.');
        }
        return redirect('hr.shifts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Shift $shift, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $shift = $shift->find($id);
        return view('hr.show-shift', [
            'shift' => $shift,
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:shifts,description,'.$id,
        ]);
        $shift = $shift->find($id);
        $shift->description = $request->description;
        if($shift->save()){
            \Session::flash('status', 'Shift edited.');
        }else{
            \Session::flash('error', 'Shift not edited.');
        }
        return redirect()->route('hr.shifts', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Shift $shift, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $shift = $shift->find($id);
        // if($shift->delete()){
        //     \Session::flash('status', 'Shift deleted.');
        // }else{
        //     \Session::flash('error', 'Shift not deleted.');
        // }
        return redirect('hr.shifts');
    }
}
