<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Position;
use App\WageTitle;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Job $job, Position $position, WageTitle $wageTitle)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $jobs = $job->orderBy('description', 'asc')->with('position')->get();
        $positions = $position->all();
        $wageTitles = $wageTitle->all();
        return view('hr.jobs', [
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
    public function store(Request $request, Job $job)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:jobs',
        ]);
        $job = new Job();
        $job->description = $request->description;
        if($job->save()){
            $job->position()->sync([$request->position]);
            $job->wageTitle()->sync([$request->wage_title]);
            \Session::flash('status', 'Job created.');
            return redirect('hr.jobs');
        }else{
            \Session::flash('error', 'Job not created.');
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
        $job = $job->with('position', 'wageTitle')->find($id);
        $positions = $position->all();
        $wageTitles = $wageTitle->all();
        return view('hr.show-job', [
            'job' => $job,
            'positions' => $positions,
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
    public function update(Request $request, Job $job, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'description' => 'required|string|max:255|unique:jobs,description,'.$id,
        ]);
        $job = $job->find($id);
        $job->description = $request->description;
        if($job->save()){
            $job->position()->sync([$request->position]);
            $job->wageTitle()->sync([$request->wage_title]);
            \Session::flash('status', 'Job edited.');
        }else{
            \Session::flash('error', 'Job not edited.');
        }
        return redirect()->route('hr.jobs', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Job $job, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // $job = $job->find($id);
        // $job->position()->sync([]);
        // $job->wageTitle()->sync([]);
        // if($job->delete()){
        //     \Session::flash('status', 'Job deleted.');
        // }else{
        //     \Session::flash('error', 'Job not deleted.');
        // }
        return redirect('hr.jobs');
    }
}