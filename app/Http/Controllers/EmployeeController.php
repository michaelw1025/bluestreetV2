<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FormatsHelper;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Storage;

use App\Employee;
use App\Position;
use App\Job;
use App\CostCenter;
use App\Shift;
use App\WageTitle;
use App\WageProgression;

class EmployeeController extends Controller
{
    use FormatsHelper;

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
    public function index(Request $request, Employee $employee, $status)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        if($status == 'inactive'){
            // Search all inactive
            $employees = $employee->where('status', 0)->orderBy('last_name', 'asc')->get();
        }else{
            // Search all active
            $employees = $employee->where('status', 1)->orderBy('last_name', 'asc')->get();
        }
        // Determines whether the employee search button searches active or inactive employees
        $routeName = $request->path();
        return view('hr.employees', [
            'employees' => $employees,
            'routeName' => $routeName,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Position $position, Job $job, CostCenter $costCenter, Shift $shift, WageTitle $wageTitle)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $positions = $position->all();
        $jobs = $job->all();
        $costCenters = $costCenter->orderBy('number', 'asc')->get();
        $shifts = $shift->all();
        $wageTitles = $wageTitle->with('wageProgression')->get();
        return view('hr.create-employee', [
            'positions' => $positions,
            'jobs' => $jobs,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'wageTitles' => $wageTitles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = new Employee();
        $this->buildEmployee($request, $employee);
        if($employee->save()){
            // Update spouse
            if($request->spouse){
                $this->buildSpouse($employee, $request);
            }
            // Update dependant
            if($request->dependant){
                $this->buildDependant($employee, $request);
            }
            // Update phone number
            if($request->phone_number){
                $this->buildPhoneNumber($employee, $request->phone_number);
            }
            // Update emergency contact
            if($request->emergency_contact){
                $this->buildEmergencyContact($employee, $request->emergency_contact);
            }
            // Sync position
            if($request->position){
                $this->syncPosition($employee, $request->position);
            }
            // Sync job
            if($request->job){
                $this->syncJob($employee, $request->job);
            }
            // Sync cost center
            if($request->cost_center){
                $this->syncCostCenter($employee, $request->cost_center);
            }
            // Sync shift
            if($request->shift){
                $this->syncShift($employee, $request->shift);
            }
            // Sync wage
            if($request->progression){
                $this->syncWage($employee, $request->progression);
            }
            // Update vision voucher
            if(!is_null($request->voucher_number)){
                $this->buildVisionVoucher($employee, $request->voucher_number);
            }
            // Update parking permit
            if(!is_null($request->parking_permit_number)){
                $this->buildParkingPermit($employee, $request->parking_permit_number);
            }
            \Session::flash('status', 'Employee created.');
        }else{
            \Session::flash('error', 'Employee not created.');
        }
        return redirect()->route('hr.employees', $employee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employee $employee, Position $position, Job $job, CostCenter $costCenter, Shift $shift, WageTitle $wageTitle, WageProgression $wageProgression, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->with(
          'spouse',
          'dependant',
          'phoneNumber',
          'emergencyContact',
          'job',
          'position',
          'position.wageTitle',
          'costCenter',
          'shift',
          'wageProgressionWageTitle',
          'visionVoucher',
          'parkingPermit',
          'disciplinary',
          'termination',
          'reduction',
          'wageProgression'
          )->withCount('dependant', 'phoneNumber', 'emergencyContact', 'wageProgressionWageTitle', 'wageProgression')->find($id);
        // return $employee;
        $jobs = $job->all();
        $positions = $position->with('wageTitle')->get();
        $costCenters = $costCenter->orderBy('number', 'asc')->get();
        $shifts = $shift->all();
        $wageTitles = $wageTitle->with('wageProgression')->get();
        $salaryJobs = $job->with(['employee' => function($query){
            $query->orderBy('last_name', 'asc');
        }])->where('description', 'salary')->get();
        $this->setTeamManagerTeamLeader($employee);
        $this->getWageStatus($employee);
        $this->setWageEventDate($employee);
        if($employee->costCenter->count() > 0){
          foreach($employee->costCenter as $employeeCostCenter){
            $staffManager = $costCenter->with('employeeStaffManager:first_name,last_name')->find($employeeCostCenter->id);
          }
        }else{
          $staffManager = null;
        }

        $wageProgressions = $wageProgression->orderBy('month', 'asc')->get();
// return $employee;
        $employee->link = '/storage/'.$employee->photo_link;
// return $employee;
        return view('hr.show-employee', [
            'employee' => $employee,
            'positions' => $positions,
            'jobs' => $jobs,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'wageTitles' => $wageTitles,
            'salaryJobs' => $salaryJobs,
            'staffManager' => $staffManager,
            'wageProgressions' => $wageProgressions,
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
    public function update(StoreEmployee $request, Employee $employee, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->find($id);

        if($request->hasFile('file')){
            $path = $request->file('file')->store('public');
            $employee->photo_link = $request->file('file')->hashName();
        }else{

        }

        $this->buildEmployee($request, $employee);
        if($employee->save()){
            // Update spouse
            if($request->spouse){
                $this->buildSpouse($employee, $request);
            }
            // Update dependant
            if($request->dependant){
                $this->buildDependant($employee, $request);
            }
            // Update phone number
            if($request->phone_number){
                $this->buildPhoneNumber($employee, $request->phone_number);
            }
            // Update emergency contact
            if($request->emergency_contact){
                $this->buildEmergencyContact($employee, $request->emergency_contact);
            }
            // Sync position
            if($request->position){
                $this->syncPosition($employee, $request->position);
            }
            // Sync job
            if($request->job){
                $this->syncJob($employee, $request->job);
            }
            // Sync cost center
            if($request->cost_center){
                $this->syncCostCenter($employee, $request->cost_center);
            }
            // Sync shift
            if($request->shift){
                $this->syncShift($employee, $request->shift);
            }
            // Sync wage
            if($request->progression){
                $this->syncWage($employee, $request->progression);
            }
            // Update vision voucher
            if(!is_null($request->voucher_number)){
                $this->buildVisionVoucher($employee, $request->voucher_number);
            }
            // Update parking permit
            if(!is_null($request->parking_permit_number)){
                $this->buildParkingPermit($employee, $request->parking_permit_number);
            }
            // Update disciplinary
            if($request->disciplinary_update){
                $this->buildDisciplinary($employee, $request);
            }
            // Update termination
            if($request->termination_update){
                $this->buildTermination($employee, $request);
            }
            // Update reduction
            if($request->reduction_update){
                $this->buildReduction($employee, $request);
            }
            // Sync wage event scale
            $this->buildWageEventScale($employee, $request);
            \Session::flash('status', 'Employee edited.');
        }else{
            \Session::flash('error', 'Employee not edited.');
        }
        return redirect()->route('hr.employees', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Employee $employee, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->find($id);
        $employee->status = 0;
        if($employee->save()){
            \Session::flash('status', 'Employee set as Inactive.');
        }else{
            \Session::flash('error', 'Employee not set as Inactive.');
        }
        return redirect()->route('hr.all-employees', 'active');
    }

    /**
     * Search for specified resource.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Employee $employee, $status)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $routeName = $request->path();
        if(!is_null($request->search_last_name)){
            $employees = $employee->where('last_name', 'LIKE', '%'.$request->search_last_name.'%')->get();
        }elseif(!is_null($request->search_ssn)){
            $employees = $employee->where('ssn', $request->search_ssn)->get();
        }elseif(!is_null($request->search_birth_date)){
            $date = $this->convertToDate($request->search_birth_date);
            $employees = $employee->where('birth_date', $date)->get();
        }elseif(!is_null($request->search_hire_date)){
            $date = $this->convertToDate($request->search_hire_date);
            $employees = $employee->where('hire_date', $date)->get();
        }else{
            $employees = '';
        }

        return view('hr.employees', [
            'employees' => $employees,
            'routeName' => $routeName,
        ]);
    }

    /**
     * Search for specified disciplinary.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function showDisciplinary(Request $request, Employee $employee, CostCenter $costCenter, Job $job, $employeeID, $disciplinaryID)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $disciplinary = $employee->find($employeeID)->disciplinary()->where('id', $disciplinaryID)->with('employee:id,first_name,last_name')->first();
        $issuer_name = $employee->select('first_name', 'last_name')->where('id', $disciplinary->issued_by)->get();
        $disciplinary->issued_by_name = $issuer_name[0]->first_name.' '.$issuer_name[0]->last_name;
        $costCenters = $costCenter->all();
        $salaryJobs = $job->with(['employee' => function($query){
            $query->orderBy('last_name', 'asc');
        }])->where('description', 'salary')->get();
        return view('hr.show-employee-disciplinary', [
            'disciplinary' => $disciplinary,
            'costCenters' => $costCenters,
            'salaryJobs' => $salaryJobs,
        ]);
    }

    /**
     * Update or delete the specified disciplinary.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function updateDisciplinary(Request $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->find($request->employee_id);
        if($request->has('disciplinary_update')){
            $request->validate([
                'disciplinary_type' => 'required',
                'disciplinary_level' => 'required',
                'disciplinary_date' => 'required',
                'disciplinary_cost_center' => 'required',
                'disciplinary_issued_by' => 'required',
                'disciplinary_comments' => 'required',
            ]);
            $this->updateDisciplinaryInfo($employee, $request);
        }elseif($request->has('disciplinary')){
            $this->deleteDisciplinary($employee, $request);
        }else{

        }
        return redirect()->route('hr.employees', $request->employee_id);
    }

    /**
     * Search for specified termination.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function showTermination(Request $request, Employee $employee, $employeeID, $terminationID)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $termination = $employee->find($employeeID)->termination()->where('id', $terminationID)->with('employee:id,first_name,last_name')->first();
        return view('hr.show-employee-termination', [
            'termination' => $termination,
        ]);
    }

    /**
     * Update or delete the specified termination.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function updateTermination(Request $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->find($request->employee_id);
        if($request->has('termination_update')){
            $request->validate([
                'termination_type' => 'required',
                'termination_date' => 'required',
                'termination_last_day' => 'required',
                'termination_comments' => 'required',
            ]);
            $this->updateTerminationInfo($employee, $request);
        }elseif($request->has('termination')){
            $this->deleteTermination($employee, $request);
        }else{

        }
        return redirect()->route('hr.employees', $request->employee_id);
    }

    /**
     * Search for specified reduction.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function showReduction(Request $request, Employee $employee, CostCenter $costCenter, Shift $shift, $employeeID, $reductionID)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $reduction = $employee->find($employeeID)->reduction()->where('id', $reductionID)->with('employee:id,first_name,last_name')->first();
        $costCenters = $costCenter->all();
        $shifts = $shift->all();
        return view('hr.show-employee-reduction', [
            'reduction' => $reduction,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
        ]);
    }

    /**
     * Update or delete the specified reduction.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function updateReduction(Request $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->find($request->employee_id);
        if($request->has('update_reduction')){
            $request->validate([
                'reduction_type' => 'required',
                'reduction_displacement' => 'required',
                'reduction_date' => 'required',
                'reduction_home_cost_center' => 'required',
                'reduction_comments' => 'required',
            ]);
            $this->updateReductionInfo($employee, $request);
        }elseif($request->has('reduction')){
            $this->deleteReduction($employee, $request);
        }else{

        }
        return redirect()->route('hr.employees', $request->employee_id);
    }

    /**
     * Delete employee photo.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function destroyPhoto(Request $request, Employee $employee, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->find($id);
        $photo = $employee->photo_link;
        $employee->photo_link = null;
        if($employee->save()){
            Storage::delete('/public/'.$photo);
            \Session::flash('status', 'Employee photo deleted.');
        }else{
            \Session::flash('error', 'Employee photo not deleted.');
        }
        return redirect()->route('hr.employees', $employee->id);
    }


}
