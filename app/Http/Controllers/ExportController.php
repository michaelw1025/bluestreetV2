<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\EmployeesAlphabetical;
use App\Exports\EmployeesSeniority;
use App\Exports\EmployeesAnniversary;
use App\Employee;
use App\Traits\FormatsHelper;
use Carbon\Carbon;

class ExportController extends Controller
{
    use FormatsHelper;

    public function employeesAlphabetical(Request $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        $employees = $employee->select('id', 'first_name', 'last_name', 'middle_initial', 'ssn', 'oracle_number', 'birth_date', 'hire_date', 'service_date', 'maiden_name', 'nick_name', 'gender', 'suffix', 'address_1', 'address_2', 'city', 'state', 'zip_code', 'county', 'vitality_incentive')->where('status', 1)->orderBy('hire_date', 'asc')->with('costCenter', 'shift', 'job', 'position')->get();
        $this->employeeInfoOne($employees);
        return (new EmployeesAlphabetical($employees))->download('employees-by-alphabetical-'.Carbon::now()->format('m-d-Y').'.xlsx');
        
    }

    public function employeesSeniority(Request $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        $employees = $employee->select('id', 'first_name', 'last_name', 'middle_initial', 'ssn', 'oracle_number', 'birth_date', 'hire_date', 'service_date', 'maiden_name', 'nick_name', 'gender', 'suffix', 'address_1', 'address_2', 'city', 'state', 'zip_code', 'county', 'vitality_incentive')->where('status', 1)->orderBy('hire_date', 'asc')->with('costCenter', 'shift', 'job', 'position')->get();

        $this->employeeInfoOne($employees);
        
        return (new EmployeesSeniority($employees))->download('employees-by-seniority-'.Carbon::now()->format('m-d-Y').'.xlsx');
        
    }

    public function employeesAnniversary(Request $request, Employee $employee, $searchMonth, $searchYear)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        
        $searchDate = Carbon::create($searchYear, $searchMonth, 1, 0);

        $employees = $employee->select('id', 'first_name', 'last_name', 'middle_initial', 'ssn', 'oracle_number', 'birth_date', 'hire_date', 'service_date', 'maiden_name', 'nick_name', 'gender', 'suffix', 'address_1', 'address_2', 'city', 'state', 'zip_code', 'county', 'vitality_incentive')->where('status', 1)->orderBy('hire_date', 'asc')->with('costCenter', 'shift', 'job', 'position')->get();

        $monthEmployees = $employees->filter(function($employee) use ($searchDate) {
            if($employee->hire_date->month == $searchDate->month){
                return $employee;
            }
        });
        
        $yearEmployees = $monthEmployees->filter(function($monthEmployee) use ($searchDate) {
            $diff = $monthEmployee->hire_date->diffInYears($searchDate) + 1;
            if($diff % 5 == 0){
                $monthEmployee->diff = $diff;
                return $monthEmployee;
            }
        });

        $this->employeeInfoOne($yearEmployees);

        return (new EmployeesAnniversary($yearEmployees))->download('employees-by-anniversary-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }














    

    private function employeeInfoOne($employees)
    {
        foreach($employees as $employee){
            $employee->date_of_birth = $employee->birth_date->format('m-d-Y');
            $employee->date_of_hire = $employee->hire_date->format('m-d-Y');
            $employee->date_of_service = $employee->service_date->format('m-d-Y');
            foreach($employee->costCenter as $costCenter){
                $employee->cost_center = $costCenter->number;
            }
            $this->setTeamManagerTeamLeader($employee);
            foreach($employee->shift as $shift){
                $employee->current_shift = $shift->description;
            }
            foreach($employee->job as $job){
                $employee->current_job = $job->description;
            }
            foreach($employee->position as $position){
                $employee->current_position = $position->description;
            }
            unset($employee['costCenter']);
            unset($employee['shift']);
            unset($employee['job']);
            unset($employee['position']);
            unset($employee['birth_date']);
            unset($employee['hire_date']);
            unset($employee['service_date']);
        }
    }
}
