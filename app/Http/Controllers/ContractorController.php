<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FormatsHelper;
use App\Contractor;
use App\ContractorTraining;

class ContractorController extends Controller
{
    use FormatsHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Contractor $contractor)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractors = $contractor->all();
        return view('hr.contractor.contractor', [
            'contractors' => $contractors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contractor $contractor)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $newContractor = new Contractor();
        $newContractor->contractor_name = $request->contractor_name;
        $newContractor->contact_first_name = $request->contact_first_name;
        $newContractor->contact_last_name = $request->contact_last_name;
        $newContractor->contact_email = $request->contact_email;
        $newContractor->contact_phone_number = $request->contact_phone_number;
        $newContractor->general_liability_insurance_date = $this->convertToDate($request->general_liability_insurance_date);
        $newContractor->work_comp_employment_insurance_date = $this->convertToDate($request->work_comp_employment_insurance_date);
        if($newContractor->save()){
            \Session::flash('status', 'Contractor created.');
        }else{
            \Session::flash('error', 'Contractor not created.');
        }
        return redirect('hr.create-contractor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Contractor $contractor, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractor = $contractor->find($id);
        return view('hr.contractor.show-contractor', [
            'contractor' => $contractor,
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
    public function update(Request $request, Contractor $contractor, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $updateContractor = $contractor->find($id);
        $updateContractor->contractor_name = $request->contractor_name;
        $updateContractor->contact_first_name = $request->contact_first_name;
        $updateContractor->contact_last_name = $request->contact_last_name;
        $updateContractor->contact_email = $request->contact_email;
        $updateContractor->contact_phone_number = $request->contact_phone_number;
        $updateContractor->general_liability_insurance_date = $this->convertToDate($request->general_liability_insurance_date);
        $updateContractor->work_comp_employment_insurance_date = $this->convertToDate($request->work_comp_employment_insurance_date);
        if($updateContractor->save()){
            \Session::flash('status', 'Contractor edited.');
        }else{
            \Session::flash('error', 'Contractor not edited.');
        }
        return view('hr.contractor.show-contractor', [
            'contractor' => $updateContractor,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contractor $contractor, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $destroyContractor = $contractor->find($id);
        if($destroyContractor->delete()){
            \Session::flash('status', 'Contractor deleted.');
        }else{
            \Session::flash('error', 'Contractor not deleted.');
        }
        return redirect('hr.create-contractor');
    }



    /*
    |--------------------------------------------------------------------------
    | Contractor employee
    |--------------------------------------------------------------------------
    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmployee(Request $request, Contractor $contractor)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractors = $contractor->with('contractorTraining')->get();
        return view('hr.contractor.contractor-employee', [
            'contractors' => $contractors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployee(Request $request, Contractor $contractor, ContractorTraining $contractorTraining)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractor = $contractor->find((int)$request->contractor_employee_contractors);
        $contractorEmployee = new ContractorTraining();
        $contractorEmployee->contractor_employee_first_name = $request->contractor_employee_first_name;
        $contractorEmployee->contractor_employee_last_name = $request->contractor_employee_last_name;
        $contractorEmployee->training_completion_date = $this->convertToDate($request->contractor_employee_training_completion_date);
        $contractorEmployee->re_training_due_date = $this->convertToDate($request->contractor_employee_re_training_due_date);
        $contractorEmployee->active = $request->contractor_employee_status;
        if($contractor->contractorTraining()->save($contractorEmployee)){
            \Session::flash('status', 'Contractor Employee Created.');
        }else{
            \Session::flash('error', 'Contractor Employee Not Created.');
        }
        
        return redirect('hr.create-contractor-employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEmployee(Request $request, Contractor $contractor, ContractorTraining $contractorTraining, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractorEmployee = $contractorTraining->with('contractor')->find($id);
        $contractors = $contractor->all();

        return view('hr.contractor.show-contractor-employee', [
            'contractorEmployee' => $contractorEmployee,
            'contractors' => $contractors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmployee(Request $request, Contractor $contractor, ContractorTraining $contractorTraining, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractors = $contractor->all();
        $contractor = $contractor->find($request->contractor_employee_contractors);
        
        $contractorEmployee = $contractorTraining->find($id);
        $contractorEmployee->contractor_employee_first_name = $request->contractor_employee_first_name;
        $contractorEmployee->contractor_employee_last_name = $request->contractor_employee_last_name;
        $contractorEmployee->training_completion_date = $this->convertToDate($request->contractor_employee_training_completion_date);
        $contractorEmployee->re_training_due_date = $this->convertToDate($request->contractor_employee_re_training_due_date);
        $contractorEmployee->active = $request->contractor_employee_status;
        if($contractor->contractorTraining()->save($contractorEmployee)){
            \Session::flash('status', 'Contractor Employee edited.');
        }else{
            \Session::flash('error', 'Contractor Employee not edited.');
        }
        return view('hr.contractor.show-contractor-employee', [
            'contractorEmployee' => $contractorEmployee,
            'contractors' => $contractors,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyEmployee(Request $request, ContractorTraining $contractorTraining, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractorEmployee = $contractorTraining->find($id);
        if($contractorEmployee->delete()){
            \Session::flash('status', 'Contractor Employee deleted.');
        }else{
            \Session::flash('error', 'Contractor Employee not deleted.');
        }
        return redirect('hr.create-contractor-employee');
    }
}
