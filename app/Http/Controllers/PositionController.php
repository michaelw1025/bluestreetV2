<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Position;
use App\WageTitle;

class PositionController extends Controller
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
    public function index(Request $request, Job $job, Position $position, WageTitle $wageTitle)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $positions = $position->orderBy('description', 'asc')->with('job')->get();
        $jobs = $job->all();
        $wageTitles = $wageTitle->all();
        return view('hr.positions', [
            'jobs' => $jobs,
            'positions' => $positions,
            'wageTitles' => $wageTitles,
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
    public function store(Request $request, Position $position)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:positions',
        ]);
        $position = new Position();
        $position->description = $request->description;
        if($position->save()){
            $position->job()->sync([$request->job]);
            $position->wageTitle()->sync([$request->wage_title]);
            \Session::flash('status', 'Position created.');
            return redirect('hr.positions');
        }else{
            \Session::flash('error', 'Position not created.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Job $job, Position $position, WageTitle $wageTitle, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $position = $position->with('job', 'wageTitle')->find($id);
        $jobs = $job->all();
        $wageTitles = $wageTitle->all();
        return view('hr.show-position', [
            'jobs' => $jobs,
            'position' => $position,
            'wageTitles' => $wageTitles,
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
    public function update(Request $request, Position $position, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:positions,description,'.$id,
        ]);
        $position = $position->find($id);
        $position->description = $request->description;
        if($position->save()){
            $position->job()->sync([$request->job]);
            $position->wageTitle()->sync([$request->wage_title]);
            \Session::flash('status', 'Position edited.');
        }else{
            \Session::flash('error', 'Position not edited.');
        }
        return redirect()->route('hr.positions', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Position $position, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $position = $position->find($id);
        // $position->job()->sync([]);
        // $position->wageTitle()->sync([]);
        // if($position->delete()){
        //     \Session::flash('status', 'Position deleted.');
        // }else{
        //     \Session::flash('error', 'Position not deleted.');
        // }
        return redirect('hr.positions');
    }
}
