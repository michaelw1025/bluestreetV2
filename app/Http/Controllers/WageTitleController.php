<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WageTitle;

class WageTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, WageTitle $wageTitle)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $wageTitles = $wageTitle->orderBy('description', 'asc')->get();
        return view('hr.wage-titles', [
            'wageTitles' => $wageTitles,
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, WageTitle $wageTitle)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:wage_titles',
        ]);
        $wageTitle = new WageTitle();
        $wageTitle->description = $request->description;
        if($wageTitle->save()){
            \Session::flash('status', 'Wage Title created.');
        }else{
            \Session::flash('error', 'Wage Title not created.');
        }
        return redirect('hr.wage-titles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, WageTitle $wageTitle, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $wageTitle = $wageTitle->find($id);
        return view('hr.show-wage-title', [
            'wageTitle' => $wageTitle,
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WageTitle $wageTitle, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:wage_titles,description,'.$id,
        ]);
        $wageTitle = $wageTitle->find($id);
        $wageTitle->description = $request->description;
        if($wageTitle->save()){
            \Session::flash('status', 'Wage Title edited.');
        }else{
            \Session::flash('error', 'Wage Title not edited.');
        }
        return redirect()->route('hr.wage-titles', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, WageTitle $wageTitle, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $wageTitle = $wageTitle->find($id);
        if($wageTitle->delete()){
            \Session::flash('status', 'Wage Title deleted.');
        }else{
            \Session::flash('error', 'Wage Title not deleted.');
        }
        return redirect('hr.wage-titles');
    }
}