<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FormatsHelper;

use App\Employee;

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
    public function create(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        return view('hr.create-employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'ssn' => 'required|string|unique:employees',
            'birth_date' => 'required',
            'hire_date' => 'required',
            'gender' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'county' => 'required',
            // Spouse
            'spouse.*.first_name' => 'required_with:spouse.*.update',
            'spouse.*.last_name' => 'required_with:spouse.*.update',
            'spouse.*.ssn' => 'required_with:spouse.*.update',
            'spouse.*.birth_date' => 'required_with:spouse.*.update',
            'spouse.*.gender' => 'required_with:spouse.*.update',
            'spouse.*.domestic_partner' => 'required_with:spouse.*.update',
            // Dependant
            'dependant.*.first_name' => 'required_with:dependant.*.update',
            'dependant.*.last_name' => 'required_with:dependant.*.update',
            'dependant.*.ssn' => 'required_with:dependant.*.update',
            'dependant.*.birth_date' => 'required_with:dependant.*.update',
            'dependant.*.gender' => 'required_with:dependant.*.update',
        ]);
        $employee = new Employee();
        $this->buildEmployee($request, $employee);
        if($employee->save()){
            // Update spouse
            if($request->spouse){
                $this->buildSpouse($employee, $request->spouse);
            }
            // Update dependant
            if($request->dependant){
                $this->buildDependant($employee, $request->dependant);
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
    public function show(Request $request, Employee $employee, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employee = $employee->with('spouse', 'dependant')->withCount('dependant')->find($id);
        return view('hr.show-employee', [
            'employee' => $employee,
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
    public function update(Request $request, Employee $employee, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // return $request;
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'ssn' => 'required|string|unique:employees,ssn,'.$id,
            'oracle_number' => 'required',
            'birth_date' => 'required',
            'hire_date' => 'required',
            'service_date' => 'required',
            'gender' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'county' => 'required',
            'status' => 'required',
            'rehire' => 'required',
            // Spouse
            'spouse.*.first_name' => 'required_with:spouse.*.update',
            'spouse.*.last_name' => 'required_with:spouse.*.update',
            'spouse.*.ssn' => 'required_with:spouse.*.update',
            'spouse.*.birth_date' => 'required_with:spouse.*.update',
            'spouse.*.gender' => 'required_with:spouse.*.update',
            'spouse.*.domestic_partner' => 'required_with:spouse.*.update',
            // Dependant
            'dependant.*.first_name' => 'required_with:dependant.*.update',
            'dependant.*.last_name' => 'required_with:dependant.*.update',
            'dependant.*.ssn' => 'required_with:dependant.*.update',
            'dependant.*.birth_date' => 'required_with:dependant.*.update',
            'dependant.*.gender' => 'required_with:dependant.*.update',

        ]);
        $employee = $employee->find($id);

        $this->buildEmployee($request, $employee);
        if($employee->save()){
            // Update spouse
            if($request->spouse){
                $this->buildSpouse($employee, $request->spouse);
            }
            // Update dependant
            if($request->dependant){
                $this->buildDependant($employee, $request->dependant);
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

    // ----------------------------------------Build Employee----------------------------------------
    public function buildEmployee($request, $employee)
    {
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_initial = $request->middle_initial;
        $employee->ssn = $request->ssn;
        $employee->oracle_number = $request->oracle_number;
        $employee->maiden_name = $request->maiden_name;
        $employee->nick_name = $request->nick_name;
        $employee->gender = $request->gender;
        $employee->suffix = $request->suffix;
        $employee->address_1 = $request->address_1;
        $employee->address_2 = $request->address_2;
        $employee->city = $request->city;
        $employee->state = $request->state;
        $employee->zip_code = $request->zip_code;
        $employee->county = $request->county;
        $employee->bid_eligible_comment = $request->bid_eligible_comment;

        if($request->has('create_employee')){
            $employee->birth_date = $this->convertToDate($request->birth_date);
            $employee->hire_date = $this->convertToDate($request->hire_date);
            $employee->service_date = $this->convertToDate($request->hire_date);
            $employee->status = 1;
            $employee->rehire = 1;
            $employee->bid_eligible = 1;
        }elseif($request->has('update_employee')){
            $employee->birth_date = $this->convertToDate($request->birth_date);
            $employee->hire_date = $this->convertToDate($request->hire_date);
            $employee->service_date = $this->convertToDate($request->service_date);

            if((int)$request->status == 0){
                $employee->status = 0;
            }else{
                $employee->status = 1;
            }

            if((int)$request->rehire == 0){
                $employee->rehire = 0;
            }else{
                $employee->rehire = 1;
            }

            if((int)$request->bid_eligible == 0){
                $employee->bid_eligible = 0;
            }else{
                $employee->bid_eligible = 1;
            }

            if(!is_null($request->bid_eligible_date)){
                $employee->bid_eligible_date = $this->convertToDate($request->bid_eligible_date);
            }

            if($request->has('thirty_day_review')){
                $employee->thirty_day_review = 1;
            }else{
                $employee->thirty_day_review = 0;
            }

            if($request->has('sixty_day_review')){
                $employee->sixty_day_review = 1;
            }else{
                $employee->sixty_day_review = 0;
            }
        }
    }
}
