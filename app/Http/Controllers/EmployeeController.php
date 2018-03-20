<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FormatsHelper;
use App\Http\Requests\StoreEmployee;

use App\Employee;
use App\Position;
use App\Job;
use App\CostCenter;
use App\Shift;
use App\WageTitle;
use App\MedicalPlan;
use App\DentalPlan;
use App\VisionPlan;

class EmployeeController extends Controller
{
    use FormatsHelper;

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
            $employees = $employee->where('status', 0)->orderBy('last_name', 'asc')->get();
        }else{
            $employees = $employee->where('status', 1)->orderBy('last_name', 'asc')->get();
        }
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
    public function create(Request $request, Position $position, Job $job, CostCenter $costCenter, Shift $shift, WageTitle $wageTitle, MedicalPlan $medicalPlan, DentalPlan $dentalPlan, VisionPlan $visionPlan)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $positions = $position->all();
        $jobs = $job->all();
        $costCenters = $costCenter->all();
        $shifts = $shift->all();
        $wageTitles = $wageTitle->with('wageProgression')->get();
        $medicalPlans = $medicalPlan->with('insuranceCoverage')->get();
        $dentalPlans = $dentalPlan->with('insuranceCoverage')->get();
        $visionPlans = $visionPlan->with('insuranceCoverage')->get();
        // return $dentalPlans;
        return view('hr.create-employee', [
            'positions' => $positions,
            'jobs' => $jobs,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'wageTitles' => $wageTitles,
            'medicalPlans' => $medicalPlans,
            'dentalPlans' => $dentalPlans,
            'visionPlans' => $visionPlans,
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
            // Sync medical insurance
            if($request->medical_coverage_type){
                $this->syncMedicalInsurance($employee, $request->medical_coverage_type);
            }
            // Sync dental insurance
            if($request->dental_coverage_type){
                $this->syncDentalInsurance($employee, $request->dental_coverage_type);
            }
            // Sync vision insurance
            if($request->vision_coverage_type){
                $this->syncVisionInsurance($employee, $request->vision_coverage_type);
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
    public function show(Request $request, Employee $employee, Position $position, Job $job, CostCenter $costCenter, Shift $shift, WageTitle $wageTitle, MedicalPlan $medicalPlan, DentalPlan $dentalPlan, VisionPlan $visionPlan, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->with('spouse', 'dependant', 'phoneNumber', 'emergencyContact', 'position', 'job.wageTitle', 'costCenter', 'shift', 'wageProgressionWageTitle', 'insuranceCoverageMedicalPlan', 'dentalPlanInsuranceCoverage', 'insuranceCoverageVisionPlan')->withCount('dependant', 'phoneNumber', 'emergencyContact', 'wageProgressionWageTitle')->find($id);
        $positions = $position->all();
        $jobs = $job->with('wageTitle')->get();
        $costCenters = $costCenter->all();
        $shifts = $shift->all();
        $wageTitles = $wageTitle->with('wageProgression')->get();
        $medicalPlans = $medicalPlan->with('insuranceCoverage')->get();
        $dentalPlans = $dentalPlan->with('insuranceCoverage')->get();
        $visionPlans = $visionPlan->with('insuranceCoverage')->get();
// return $dentalPlans;
        return view('hr.show-employee', [
            'employee' => $employee,
            'positions' => $positions,
            'jobs' => $jobs,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'wageTitles' => $wageTitles,
            'medicalPlans' => $medicalPlans,
            'dentalPlans' => $dentalPlans,
            'visionPlans' => $visionPlans,
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
// return $request;
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
            // Sync medical insurance
            if($request->medical_coverage_type){
                $this->syncMedicalInsurance($employee, $request->medical_coverage_type);
            }
            // Sync dental insurance
            if($request->dental_coverage_type){
                $this->syncDentalInsurance($employee, $request->dental_coverage_type);
            }
            // Sync vision insurance
            if($request->vision_coverage_type){
                $this->syncVisionInsurance($employee, $request->vision_coverage_type);
            }
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
        if($employee->delete()){
            \Session::flash('status', 'Employee deleted.');
        }else{
            \Session::flash('error', 'Employee not deleted.');
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
            $employees = $employee->where('last_name', $request->search_last_name)->get();
        }elseif(!is_null($request->search_ssn)){
            $employees = $employee->where('ssn', $request->search_ssn)->get();
        }elseif(!is_null($request->search_birth_date)){
            $date = $this->convertToDateForSearch($request->search_birth_date);
            $employees = $employee->where('birth_date', $date)->get();
        }elseif(!is_null($request->search_hire_date)){
            $date = $this->convertToDateForSearch($request->search_hire_date);
            $employees = $employee->where('hire_date', $date)->get();
        }else{
            $employees = '';
        }

        return view('hr.employees', [
            'employees' => $employees,
            'routeName' => $routeName,
        ]);
    }
    
}
