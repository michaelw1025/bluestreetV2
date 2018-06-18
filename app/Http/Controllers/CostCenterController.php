<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CostCenter;
use App\Employee;
use App\Job;
use App\Position;

class CostCenterController extends Controller
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
    public function index(Request $request, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $costCenters = $costCenter->orderBy('number', 'asc')->with(
            'employeeStaffManager:employee_id,first_name,last_name',
            'employeeDayTeamManager:employee_id,first_name,last_name',
            'employeeNightTeamManager:employee_id,first_name,last_name',
            'employeeDayTeamLeader:employee_id,first_name,last_name',
            'employeeNightTeamLeader:employee_id,first_name,last_name'
        )->get();
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
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
    public function show(Request $request, CostCenter $costCenter, Position $position, Job $job, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $costCenter = $costCenter->with(
            'employeeStaffManager:employee_id,first_name,last_name',
            'employeeDayTeamManager:employee_id,first_name,last_name',
            'employeeNightTeamManager:employee_id,first_name,last_name',
            'employeeDayTeamLeader:employee_id,first_name,last_name',
            'employeeNightTeamLeader:employee_id,first_name,last_name'
        )->find($id);
        $salaryJobs = $job->with(['employee' => function ($query){
            $query->select('first_name', 'last_name')->where('status', 1)->orderBy('last_name');
        }])->where('description', 'salary')->get();
        $salaryPositions = $position->with(['employee' => function ($query){
            $query->select('first_name', 'last_name')->where('status', 1)->orderBy('last_name');
        }])->where('description', 'specialist operations')->get();
        $salaryEmployees = $salaryJobs->concat($salaryPositions);
        return view('hr.show-cost-center', [
            'costCenter' => $costCenter,
            'salaryEmployees' => $salaryEmployees,
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        $this->validate($request,[
            'number' => 'required|string|max:255|unique:cost_centers,number,'.$id,
            'description' => 'required|string|max:255',
        ]);
        $costCenter = $costCenter->find($id);
        $costCenter->number = $request->number;
        $costCenter->description = $request->description;
        if($costCenter->save()){
            // Sync staff manager
            if(!is_null($request->staff_manager)){
                $costCenter->employeeStaffManager()->sync($request->staff_manager);
            }
            // Sync day team manager
            if(!is_null($request->day_team_manager)){
                $costCenter->employeeDayTeamManager()->sync($request->day_team_manager);
            }
            // Sync night team manager
            if(!is_null($request->night_team_manager)){
                $costCenter->employeeNightTeamManager()->sync($request->night_team_manager);
            }
            // Sync day team leader
            if(!is_null($request->day_team_leader)){
                $costCenter->employeeDayTeamLeader()->sync($request->day_team_leader);
            }
            // Sync night team leader
            if(!is_null($request->night_team_leader)){
                $costCenter->employeeNightTeamLeader()->sync($request->night_team_leader);
            }
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // $costCenter = $costCenter->find($id);
        // if($costCenter->delete()){
        //     // Clear staff manager for deleted cost center
        //     $costCenter->employeeStaffManager()->sync([]);
        //     // Clear day team manager for deleted cost center
        //     $costCenter->employeeDayTeamManager()->sync([]);
        //     // Clear night team manager for deleted cost center
        //     $costCenter->employeeNightTeamManager()->sync([]);
        //     // Clear day team leader for deleted cost center
        //     $costCenter->employeeDayTeamLeader()->sync([]);
        //     // Clear night team leader for deleted cost center
        //     $costCenter->employeeNightTeamLeader()->sync([]);
        //     \Session::flash('status', 'Cost Center deleted.');
        // }else{
        //     \Session::flash('error', 'Cost Center not deleted.');
        // }
        return redirect('hr.cost-centers');
    }
}
