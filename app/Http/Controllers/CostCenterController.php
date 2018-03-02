<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CostCenter;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        $costCenters = $costCenter->orderBy('number', 'asc')->get();
        return view('hr.cost-centers', [
            'costCenters' => $costCenters,
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
    public function store(Request $request, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $this->validate($request,[
            'number' => 'required|string|max:255|unique:cost_centers',
            'description' => 'required|string|max:255',
        ]);
        $costCenter = new CostCenter();
        $costCenter->number = $request->number;
        $costCenter->description = $request->description;
        if($costCenter->save()){
            \Session::flash('status', 'Cost Center created.');
        }else{
            \Session::flash('error', 'Cost Center not created.');
        }
        return redirect('hr.cost-centers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CostCenter $costCenter, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $costCenter = $costCenter->find($id);
        return view('hr.show-cost-center', [
            'costCenter' => $costCenter,
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
    public function update(Request $request, CostCenter $costCenter, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $this->validate($request,[
            'number' => 'required|string|max:255|unique:cost_centers,number,'.$id,
            'description' => 'required|string|max:255',
        ]);
        $costCenter = $costCenter->find($id);
        $costCenter->number = $request->number;
        $costCenter->description = $request->description;
        if($costCenter->save()){
            \Session::flash('status', 'Cost Center edited.');
        }else{
            \Session::flash('error', 'Cost Center not edited.');
        }
        return redirect()->route('hr.cost-centers', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CostCenter $costCenter, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        $costCenter = $costCenter->find($id);
        if($costCenter->delete()){
            \Session::flash('status', 'Cost Center deleted.');
        }else{
            \Session::flash('error', 'Cost Center not deleted.');
        }
        return redirect('hr.cost-centers');
    }
}
