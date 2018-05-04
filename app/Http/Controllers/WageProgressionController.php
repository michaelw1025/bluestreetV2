<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WageProgression;

class WageProgressionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, WageProgression $wageProgression)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $wageProgressions = $wageProgression->orderBy('month', 'asc')->get();
        return view('hr.wage-progressions', [
            'wageProgressions' => $wageProgressions,
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
    public function store(Request $request, WageProgression $wageProgression)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'month' => 'required|string|max:255|unique:wage_progressions',
        ]);
        $wageProgression = new WageProgression();
        $wageProgression->month = $request->month;
        if($wageProgression->save()){
            \Session::flash('status', 'Wage Progression created.');
        }else{
            \Session::flash('error', 'Wage Progression not created.');
        }
        return redirect('hr.wage-progressions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, WageProgression $wageProgression, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $wageProgression = $wageProgression->find($id);
        return view('hr.show-wage-progression', [
            'wageProgression' => $wageProgression,
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
    public function update(Request $request, WageProgression $wageProgression, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'month' => 'required|string|max:255|unique:wage_progressions,month,'.$id,
        ]);
        $wageProgression = $wageProgression->find($id);
        $wageProgression->month = $request->month;
        if($wageProgression->save()){
            \Session::flash('status', 'Wage Progression edited.');
        }else{
            \Session::flash('error', 'Wage Progression not edited.');
        }
        return redirect()->route('hr.wage-progressions', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, WageProgression $wageProgression, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $wageProgression = $wageProgression->find($id);
        if($wageProgression->delete()){
            \Session::flash('status', 'Wage Progression deleted.');
        }else{
            \Session::flash('error', 'Wage Progression not deleted.');
        }
        return redirect('hr.wage-progressions');
    }
}
