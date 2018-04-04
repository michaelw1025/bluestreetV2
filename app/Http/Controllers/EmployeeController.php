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
use App\AccidentalCoverage;
use App\WageProgression;

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
    public function create(Request $request, Position $position, Job $job, CostCenter $costCenter, Shift $shift, WageTitle $wageTitle, MedicalPlan $medicalPlan, DentalPlan $dentalPlan, VisionPlan $visionPlan, AccidentalCoverage $accidentalCoverage)
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
        $accidentalCoverages = $accidentalCoverage->all();
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
            'accidentalCoverages' => $accidentalCoverages,
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
            // Update vision voucher
            if(!is_null($request->voucher_number)){
                $this->buildVisionVoucher($employee, $request->voucher_number);
            }
            // Update accidental insurance
            $this->attachAccidentalInsurance($employee, $request);
            // Update beneficiary
            if($request->beneficiary){
                $this->buildBeneficiary($employee, $request->beneficiary);
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
    public function show(Request $request, Employee $employee, Position $position, Job $job, CostCenter $costCenter, Shift $shift, WageTitle $wageTitle, MedicalPlan $medicalPlan, DentalPlan $dentalPlan, VisionPlan $visionPlan, AccidentalCoverage $accidentalCoverage, WageProgression $wageProgression, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->with('spouse', 'dependant', 'phoneNumber', 'emergencyContact', 'position', 'job.wageTitle', 'costCenter', 'shift', 'wageProgressionWageTitle', 'insuranceCoverageMedicalPlan', 'dentalPlanInsuranceCoverage', 'insuranceCoverageVisionPlan', 'visionVoucher', 'accidentalCoverage', 'beneficiary', 'parkingPermit', 'disciplinary', 'termination', 'reduction', 'wageProgression')->withCount('dependant', 'phoneNumber', 'emergencyContact', 'wageProgressionWageTitle', 'beneficiary', 'wageProgression')->find($id);
        $positions = $position->all();
        $jobs = $job->with('wageTitle')->get();
        $costCenters = $costCenter->all();
        $shifts = $shift->all();
        $wageTitles = $wageTitle->with('wageProgression')->get();
        $medicalPlans = $medicalPlan->with('insuranceCoverage')->get();
        $dentalPlans = $dentalPlan->with('insuranceCoverage')->get();
        $visionPlans = $visionPlan->with('insuranceCoverage')->get();
        $accidentalCoverages = $accidentalCoverage->all();
        $salaryPositions = $position->with(['employee' => function($query){
            $query->orderBy('last_name', 'asc');
        }])->where('description', 'salary')->get();
        $this->setTeamManagerTeamLeader($employee);
        $this->getWageStatus($employee);
        $this->setWageEventDate($employee);
        $staffManager = $costCenter->with('employeeStaffManager:first_name,last_name')->find($employee->costCenter[0]->id);
        $wageProgressions = $wageProgression->orderBy('month', 'asc')->get();
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
            'accidentalCoverages' => $accidentalCoverages,
            'salaryPositions' => $salaryPositions,
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
                if($request->medical_plan == 'Waived'){
                    $this->unsyncMedicalInsurance($employee);
                }else{
                    $this->syncMedicalInsurance($employee, $request->medical_coverage_type);
                }
            }
            // Sync dental insurance
            if($request->dental_coverage_type){
                if($request->dental_plan == 'Waived'){
                    $this->unsyncDentalInsurance($employee);
                }else{
                    $this->syncDentalInsurance($employee, $request->dental_coverage_type);
                }
            }
            // Sync vision insurance
            if($request->vision_coverage_type){
                if($request->vision_plan == 'Waived'){
                    $this->unsyncVisionInsurance($employee);
                }else{
                    $this->syncVisionInsurance($employee, $request->vision_coverage_type);
                }
            }
            // Update vision voucher
            if(!is_null($request->voucher_number)){
                $this->buildVisionVoucher($employee, $request->voucher_number);
            }
            // Update accidental insurance
            $this->attachAccidentalInsurance($employee, $request);
            // Update beneficiary
            if($request->beneficiary){
                $this->buildBeneficiary($employee, $request->beneficiary);
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

    /**
     * Search for specified disciplinary.
     *
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function showDisciplinary(Employee $employee, CostCenter $costCenter, Position $position, $employeeID, $disciplinaryID)
    {
        $disciplinary = $employee->find($employeeID)->disciplinary()->where('id', $disciplinaryID)->with('employee:id,first_name,last_name')->first();
        $costCenters = $costCenter->all();
        $salaryPositions = $position->with(['employee' => function($query){
            $query->orderBy('last_name', 'asc');
        }])->where('description', 'salary')->get();
        return view('hr.show-employee-disciplinary', [
            'disciplinary' => $disciplinary,
            'costCenters' => $costCenters,
            'salaryPositions' => $salaryPositions,
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
        // return $request;
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
    public function showTermination(Employee $employee, $employeeID, $terminationID)
    {
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
        // return $request;
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
    public function showReduction(Employee $employee, CostCenter $costCenter, Shift $shift, $employeeID, $reductionID)
    {
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
        // return $request;
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

    
}
