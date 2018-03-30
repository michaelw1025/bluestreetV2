<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FormatsHelper;

use Carbon\Carbon;
use App\Employee;
use App\CostCenter;
use App\Shift;
use App\Spouse;
use App\Dependant;

class HRQueryController extends Controller
{
    use FormatsHelper;

    /**
     * Query all employees alphabetical
     *
     * @return \Illuminate\Http\Response
     */
    public function queryEmployeesAlphabetical(Employee $employee, CostCenter $costCenter)
    {
        $employees = $employee->with('costCenter', 'shift', 'job', 'position')->where('status' , '1')->orderBy('last_name', 'asc')->get();
        foreach($employees as $employee){
            if($employee->shift->isNotEmpty()){
                if($employee->shift[0]->description == 'Day'){
                    $teamManager = $costCenter->with('employeeDayTeamManager:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamManager->employeeDayTeamManager->isNotEmpty()){
                        $employee->team_manager = $teamManager->employeeDayTeamManager[0]->first_name.' '.$teamManager->employeeDayTeamManager[0]->last_name;
                    }else{
                        $employee->team_manager = '';
                    }
                    $teamLeader = $costCenter->with('employeeDayTeamLeader:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamLeader->employeeDayTeamLeader->isNotEmpty()){
                        $employee->team_leader = $teamLeader->employeeDayteamLeader[0]->first_name.' '.$teamLeader->employeeDayteamLeader[0]->last_name;
                    }else{
                        $employee->team_leader = '';
                    }
                }elseif($employee->shift[0]->description == 'Night'){
                    $teamManager = $costCenter->with('employeeNightTeamManager:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamManager->employeeNightTeamManager->isNotEmpty()){
                        $employee->team_manager = $teamManager->employeeNightTeamManager[0]->first_name.' '.$teamManager->employeeNightTeamManager[0]->last_name;
                    }else{
                        $employee->team_manager = '';
                    }
                    $teamLeader = $costCenter->with('employeeNightTeamLeader:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamLeader->employeeNightTeamLeader->isNotEmpty()){
                        $employee->team_leader = $teamLeader->employeeNightteamLeader[0]->first_name.' '.$teamLeader->employeeNightteamLeader[0]->last_name;
                    }else{
                        $employee->team_leader = '';
                    }
                }else{
                    $employee->team_manager = '';
                    $employee->team_leader = '';
                }
            }else{
                $employee->team_manager = '';
                $employee->team_leader = '';
            }
        }
        return view('hr.query-employees-alphabetical', [
            'employees' => $employees,
        ]);
    }

    /**
     * Query all employees seniority
     *
     * @return \Illuminate\Http\Response
     */
    public function queryEmployeesSeniority(Employee $employee, CostCenter $costCenter)
    {
        $employees = $employee->with('costCenter', 'shift', 'job', 'position')->where('status' , '1')->orderBy('hire_date', 'asc')->get();
        foreach($employees as $employee){
            if($employee->shift->isNotEmpty()){
                if($employee->shift[0]->description == 'Day'){
                    $teamManager = $costCenter->with('employeeDayTeamManager:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamManager->employeeDayTeamManager->isNotEmpty()){
                        $employee->team_manager = $teamManager->employeeDayTeamManager[0]->first_name.' '.$teamManager->employeeDayTeamManager[0]->last_name;
                    }else{
                        $employee->team_manager = '';
                    }
                    $teamLeader = $costCenter->with('employeeDayTeamLeader:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamLeader->employeeDayTeamLeader->isNotEmpty()){
                        $employee->team_leader = $teamLeader->employeeDayteamLeader[0]->first_name.' '.$teamLeader->employeeDayteamLeader[0]->last_name;
                    }else{
                        $employee->team_leader = '';
                    }
                }elseif($employee->shift[0]->description == 'Night'){
                    $teamManager = $costCenter->with('employeeNightTeamManager:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamManager->employeeNightTeamManager->isNotEmpty()){
                        $employee->team_manager = $teamManager->employeeNightTeamManager[0]->first_name.' '.$teamManager->employeeNightTeamManager[0]->last_name;
                    }else{
                        $employee->team_manager = '';
                    }
                    $teamLeader = $costCenter->with('employeeNightTeamLeader:first_name,last_name')->find($employee->costCenter[0]->id);
                    if($teamLeader->employeeNightTeamLeader->isNotEmpty()){
                        $employee->team_leader = $teamLeader->employeeNightteamLeader[0]->first_name.' '.$teamLeader->employeeNightteamLeader[0]->last_name;
                    }else{
                        $employee->team_leader = '';
                    }
                }else{
                    $employee->team_manager = '';
                    $employee->team_leader = '';
                }
            }else{
                $employee->team_manager = '';
                $employee->team_leader = '';
            }
        }
        // return $employees;
        return view('hr.query-employees-seniority', [
            'employees' => $employees,
        ]);
    }

    /**
     * Query reviews
     *
     * @return \Illuminate\Http\Response
     */
    public function queryReviews(Employee $employee, CostCenter $costCenter)
    {
        $employees = $employee->with('costCenter', 'shift', 'job', 'position')->
        where([['status' , '1'],['thirty_day_review', '0']])->
        orWhere([['status' , '1'],['sixty_day_review', '0']])->orderBy('last_name', 'asc')->get();
        foreach($employees as $employee){
            $this->setTeamManagerTeamLeader($employee);
        }
        // return $employees;
        return view('hr.query-reviews', [
            'employees' => $employees,
        ]);
    }

    /**
     * Query reductions
     *
     * @return \Illuminate\Http\Response
     */
    public function queryReductions(Employee $employee, CostCenter $costCenter, Shift $shift)
    {
        $employees = $employee->whereHas('reduction', function($query) {
            $query->where('currently_active', '1');
        })->with(['reduction' => function($query) {
            $query->where('currently_active', '1');
        }])->orderBy('hire_date', 'asc')->get();
        $costCenters = $costCenter->all();
        $shifts = $shift->all();
        // return $employees;
        return view('hr.query-reductions', [
            'employees' => $employees,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
        ]);
    }

    /**
     * Query turnover
     *
     * @return \Illuminate\Http\Response
     */
    public function queryTurnovers(Request $request, Employee $employee, CostCenter $costCenter)
    {
        if(isset($request->submit_turnover_search)){
            $beginSearchDate = $this->convertToDateForSearch($request->search_begin_date);
            if(!is_null($request->search_end_date)){
                $endSearchDate = $this->convertToDateForSearch($request->search_end_date);
            }else{
                $endSearchDate = Carbon::now();
            }
            $employees = $employee->where('status', '0')->whereHas('termination', function($query) use ($beginSearchDate, $endSearchDate){
                $query->whereBetween('date', [$beginSearchDate, $endSearchDate]);
            })->with('termination', 'costCenter')->get();
            foreach($employees as $employee){
                $this->setTeamManagerTeamLeader($employee);
            }
            $costCenters = $costCenter->all();
            return view('hr.query-turnovers', [
                'employees' => $employees,
                'beginSearchDate' => $beginSearchDate,
                'endSearchDate' => $endSearchDate,
                'costCenters' => $costCenters,
            ]);
        }else{
            return view('hr.query-turnovers', [

            ]);
        }
    }

    /**
     * Query anniversaries
     *
     * @return \Illuminate\Http\Response
     */
    public function queryAnniversaries(Request $request, Employee $employee, CostCenter $costCenter)
    {
        if(isset($request->submit_anniversary_search)){
            $searchMonth = $request->search_month;
            $searchYear = $request->search_year;
            $searchDate = Carbon::create($request->search_year, $request->search_month, 1, 0);
            $employees = $employee->where('status', '1')->with('costCenter', 'shift')->get();
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
            foreach($yearEmployees as $yearEmployee){
                $this->setTeamManagerTeamLeader($yearEmployee);
            }
            $costCenters = $costCenter->all();
            return view('hr.query-anniversaries', [
                'employees' => $yearEmployees,
                'costCenters' => $costCenters,
                'searchMonth' => $searchMonth,
                'searchYear' => $searchYear,
            ]);
        }else{
            return view('hr.query-anniversaries', [

            ]);
        }
    }

    /**
     * Query birthdays
     *
     * @return \Illuminate\Http\Response
     */
    public function queryBirthdays(Request $request, Employee $employee, CostCenter $costCenter)
    {
        if(isset($request->submit_birthday_search)){
            $searchMonth = $request->search_month;
            $employees = $employee->where('status', '1')->with('costCenter', 'shift')->orderBy('birth_date', 'asc')->get();
            $monthEmployees = $employees->filter(function($employee) use ($searchMonth) {
                if($employee->birth_date->month == $searchMonth){
                    $employee->birth_day = $employee->birth_date->day;
                    return $employee;
                }
            });
            $monthEmployees = $monthEmployees->sortBy('birth_day');
            foreach($monthEmployees as $monthEmployee){
                $this->setTeamManagerTeamLeader($monthEmployee);
            }
            $costCenters = $costCenter->all();
            return view('hr.query-birthdays', [
                'employees' => $monthEmployees,
                'costCenters' => $costCenters,
                'searchMonth' => $searchMonth,
            ]);
        }else{
            return view('hr.query-birthdays', [

            ]);
        }
    }

    /**
     * Query hire date
     *
     * @return \Illuminate\Http\Response
     */
    public function queryHireDate(Request $request, Employee $employee, CostCenter $costCenter)
    {
        if(isset($request->submit_hire_date_search)){
            $beginSearchDate = $this->convertToDateForSearch($request->search_begin_date);
            if(!is_null($request->search_end_date)){
                $endSearchDate = $this->convertToDateForSearch($request->search_end_date);
            }else{
                $endSearchDate = Carbon::now();
            }
            $employees = $employee->wherebetween('hire_date', [$beginSearchDate, $endSearchDate])->orderBy('hire_date', 'asc')->with('costCenter')->get();
            foreach($employees as $employee){
                $this->setTeamManagerTeamLeader($employee);
            }
            $costCenters = $costCenter->all();
            return view('hr.query-hire-date', [
                'employees' => $employees,
                'beginSearchDate' => $beginSearchDate,
                'endSearchDate' => $endSearchDate,
                'costCenters' => $costCenters,
            ]);
        }else{
            return view('hr.query-hire-date', [

            ]);
        }
    }

    /**
     * Query cost center
     *
     * @return \Illuminate\Http\Response
     */
    public function queryCostCenter(Request $request, CostCenter $costCenter)
    {
        if(isset($request->submit_cost_center_search)){
            $searchCostCenter = $request->search_cost_center;
            $employeeCostCenters = $costCenter->where('id', $request->search_cost_center)->with(['employeeStaffManager', 'employeeDayTeamManager', 'employeeNightTeamManager', 'employeeDayTeamLeader', 'employeeNightTeamLeader', 'employee' => function($query){
                $query->where('status', '1');
            }])->get();
            foreach($employeeCostCenters as $costCenter){
                foreach($costCenter->employee as $employee){
                    $employee->load('job', 'shift', 'position');
                }
            }
            $costCenters = $costCenter->all();
            // return $employeeCostCenters;
            return view('hr.query-cost-center', [
                'employeeCostCenters' => $employeeCostCenters,
                'costCenters' => $costCenters,
                'searchCostCenter' => $searchCostCenter,
            ]);
        }else{
            $costCenters = $costCenter->all();
            return view('hr.query-cost-center', [
                'costCenters' => $costCenters,
            ]);
        }
    }

    /**
     * Query cost center
     *
     * @return \Illuminate\Http\Response
     */
    public function querySSN(Request $request, Employee $employee, Spouse $spouse, Dependant $dependant)
    {
        if(isset($request->submit_ssn_search)){
            $searchSSN = $request->ssn;
            if($employee->where('ssn', $searchSSN)->first()){
                $employee = $employee->where('ssn', $searchSSN)->first();
            }elseif($spouse->where('ssn', $searchSSN)->first()){
                $spouse = $spouse->where('ssn', $searchSSN)->with('employee')->first();
                $employee = $employee->find($spouse->employee->id);
            }elseif($dependant->where('ssn', $searchSSN)->first()){
                $dependant = $dependant->where('ssn', $searchSSN)->with('employee')->first();
                $employee = $employee->find($dependant->employee->id);
            }else{
                return view('hr.query-ssn', [

                ]);
            }
            return view('hr.query-ssn', [
                'searchSSN' => $searchSSN,
                'employee' => $employee,
            ]);
        }else{
            return view('hr.query-ssn', [

            ]);
        }
    }
}
