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
use App\WageProgression;
use App\WageProgressionWageTitle;

class HRQueryController extends Controller
{
    use FormatsHelper;

    /**
     * Query all employees alphabetical
     *
     * @return \Illuminate\Http\Response
     */
    public function queryEmployeesAlphabetical(Request $request, Employee $employee, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employees = $employee->with('costCenter', 'shift', 'job', 'position')->where('status' , '1')->orderBy('last_name', 'asc')->get();
        foreach($employees as $employee){
            $this->setTeamManagerTeamLeader($employee);
        }
        return view('hr.queries.query-employees-alphabetical', [
            'employees' => $employees,
        ]);
    }

    /**
     * Query all employees seniority
     *
     * @return \Illuminate\Http\Response
     */
    public function queryEmployeesSeniority(Request $request, Employee $employee, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employees = $employee->with('costCenter', 'shift', 'job', 'position')->where('status' , '1')->orderBy('hire_date', 'asc')->get();
        foreach($employees as $employee){
            $this->setTeamManagerTeamLeader($employee);
        }
        return view('hr.queries.query-employees-seniority', [
            'employees' => $employees,
        ]);
    }

    /**
     * Query reviews
     *
     * @return \Illuminate\Http\Response
     */
    public function queryReviews(Request $request, Employee $employee, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employees = $employee->with('costCenter', 'shift', 'job', 'position')->
        where([['status' , '1'],['thirty_day_review', '0']])->
        orWhere([['status' , '1'],['sixty_day_review', '0']])->orderBy('last_name', 'asc')->get();
        foreach($employees as $employee){
            $this->setTeamManagerTeamLeader($employee);
        }
        return view('hr.queries.query-reviews', [
            'employees' => $employees,
        ]);
    }

    /**
     * Query reductions
     *
     * @return \Illuminate\Http\Response
     */
    public function queryReductions(Request $request, Employee $employee, CostCenter $costCenter, Shift $shift)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employees = $employee->whereHas('reduction', function($query) {
            $query->where('currently_active', '1');
        })->with(['reduction' => function($query) {
            $query->where('currently_active', '1');
        }])->orderBy('hire_date', 'asc')->get();
        $costCenters = $costCenter->all();
        $shifts = $shift->all();
        return view('hr.queries.query-reductions', [
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
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        if(isset($request->submit_turnover_search)){
            $beginSearchDate = $this->convertToDate($request->search_begin_date);
            if(!is_null($request->search_end_date)){
                $endSearchDate = $this->convertToDate($request->search_end_date);
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
            return view('hr.queries.query-turnovers', [
                'employees' => $employees,
                'beginSearchDate' => $beginSearchDate,
                'endSearchDate' => $endSearchDate,
                'costCenters' => $costCenters,
            ]);
        }else{
            return view('hr.queries.query-turnovers');
        }
    }

    /**
     * Query anniversaries
     *
     * @return \Illuminate\Http\Response
     */
    public function queryAnniversaries(Request $request, Employee $employee, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
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
            return view('hr.queries.query-anniversaries', [
                'employees' => $yearEmployees,
                'costCenters' => $costCenters,
                'searchMonth' => $searchMonth,
                'searchYear' => $searchYear,
            ]);
        }else{
            return view('hr.queries.query-anniversaries');
        }
    }

    /**
     * Query birthdays
     *
     * @return \Illuminate\Http\Response
     */
    public function queryBirthdays(Request $request, Employee $employee, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        if(isset($request->submit_birthday_search)){
            $searchMonth = $request->search_month;
            $employees = $employee->where('status', '1')->with('costCenter', 'shift', 'job', 'position')->orderBy('birth_date', 'asc')->get();
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
            return view('hr.queries.query-birthdays', [
                'employees' => $monthEmployees,
                'searchMonth' => $searchMonth,
            ]);
        }else{
            return view('hr.queries.query-birthdays');
        }
    }

    /**
     * Query hire date
     *
     * @return \Illuminate\Http\Response
     */
    public function queryHireDate(Request $request, Employee $employee, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        if(isset($request->submit_hire_date_search)){
            $beginSearchDate = $this->convertToDate($request->search_begin_date);
            if(!is_null($request->search_end_date)){
                $endSearchDate = $this->convertToDate($request->search_end_date);
            }else{
                $endSearchDate = Carbon::now();
            }
            $employees = $employee->wherebetween('hire_date', [$beginSearchDate, $endSearchDate])->orderBy('hire_date', 'asc')->with('costCenter')->get();
            foreach($employees as $employee){
                $this->setTeamManagerTeamLeader($employee);
            }
            $costCenters = $costCenter->all();
            return view('hr.queries.query-hire-date', [
                'employees' => $employees,
                'beginSearchDate' => $beginSearchDate,
                'endSearchDate' => $endSearchDate,
                'costCenters' => $costCenters,
            ]);
        }else{
            return view('hr.queries.query-hire-date');
        }
    }

    /**
     * Query cost center
     *
     * @return \Illuminate\Http\Response
     */
    public function queryCostCenter(Request $request, CostCenter $costCenter)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
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
            $costCenters = $costCenter->orderBy('number', 'asc')->get();
            return view('hr.queries.query-cost-center', [
                'employeeCostCenters' => $employeeCostCenters,
                'costCenters' => $costCenters,
                'searchCostCenter' => $searchCostCenter,
            ]);
        }else{
            $costCenters = $costCenter->orderBy('number', 'asc')->get();
            return view('hr.queries.query-cost-center', [
                'costCenters' => $costCenters,
            ]);
        }
    }

    /**
     * Query ssn
     *
     * @return \Illuminate\Http\Response
     */
    public function querySSN(Request $request, Employee $employee, Spouse $spouse, Dependant $dependant)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
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
                return view('hr.queries.query-ssn', [

                ]);
            }
            return view('hr.queries.query-ssn', [
                'searchSSN' => $searchSSN,
                'employee' => $employee,
            ]);
        }else{
            return view('hr.queries.query-ssn', [

            ]);
        }
    }

    /**
     * Query wage progression
     *
     * @return \Illuminate\Http\Response
     */
    public function queryEmployeesWageProgression(Request $request, WageProgression $wageProgression, Employee $employee, WageProgressionWageTitle $wageProgressionWageTitle)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        $wageProgressions = $wageProgression->orderBy('month', 'asc')->get();

        if($request->has('submit_wage_event_search')){
            // Get current search items
            $searchMonth = (int)$request->search_month;
            $searchYear = (int)$request->search_year;
            $searchProgression = (int)$request->search_progression;
            // Get the searched progression
            $progression = $wageProgression->find($searchProgression);
            // Get all employees who have a wage event at the searched progression level
            $employees = $employee->whereHas('wageProgression', function($query) use($progression) {
                $query->where('wage_progression_id', $progression->id);
            })->with(['wageProgression' => function($query) use($progression) {
                $query->where('wage_progression_id', $progression->id);
            }])->where('status', 1)->get();
            // Filter out employees whose wage event does not match the searched month and year
            $searchEmployees = $employees->filter(function($employee) use ($searchMonth, $searchYear) {
                foreach($employee->wageProgression as $employeeProgression){
                    $employeeProgression->pivot->date = Carbon::parse($employeeProgression->pivot->date);
                    // Filter by month
                    if($employeeProgression->pivot->date->month === $searchMonth){
                        // Filter by year
                        if($employeeProgression->pivot->date->year === $searchYear){
                            return $employee;
                        }
                    }
                }
            });

            // for each employee left eager load the required relationships, get current wage for wage title, and get next wage for wage title
            foreach($searchEmployees as $searchEmployee){
                $searchEmployee->loadMissing('costCenter', 'shift', 'job', 'wageProgressionWageTitle');
                $searchEmployee->next_progression = $wageProgressionWageTitle->where([
                    ['wage_title_id', $searchEmployee->wageProgressionWageTitle[0]->wage_title_id],
                    ['wage_progression_id', $progression->id],
                ])->get();
                $this->setTeamManagerTeamLeader($searchEmployee);
            }
            return view('hr.queries.query-employees-wage-progression', [
                'wageProgressions' => $wageProgressions,
                'searchMonth' => $searchMonth,
                'searchYear' => $searchYear,
                'searchProgression' => $searchProgression,
                'employees' => $searchEmployees,
            ]);
        }else{
            return view('hr.queries.query-employees-wage-progression', [
                'wageProgressions' => $wageProgressions,
            ]);
        }
    }

    /**
     * Query bonus hours
     *
     * @return \Illuminate\Http\Response
     */
    public function queryEmployeesBonusHours(Request $request, Employee $employee)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Today's date
        $now = Carbon::now();
        // First day of the current quarter
        $firstOfCurrentQuarter = $now->copy()->firstOfQuarter();
        // Subtract one day to get a date in the previous quarter
        $dateInPreviousQuarter = $firstOfCurrentQuarter->copy()->subDay();
        // Use date in previous quarter to calculate last day of previous quarter - should be the same as dateInPreviousQuarter but calculate to be sure
        $lastOfPreviousQuarter = $dateInPreviousQuarter->copy()->lastOfQuarter();
        // Get first day of previous quarter for disciplinary comparison
        $firstOfPreviousQuarter = $dateInPreviousQuarter->copy()->firstOfQuarter();
        // Subtract 5 years to get minimum hire date
        $fiveYearHireDate = $lastOfPreviousQuarter->copy()->subYears(5);
        // Subtract 3 years from fiveYearHireDate to get the eightYearHireDate
        $eightYearHireDate = $fiveYearHireDate->copy()->subYears(3);
        // Get all employees with a hire date greater than or equal to fiveYearHireDate
        $employees = $employee->where('status', 1)->where('hire_date', '<=', $fiveYearHireDate)->orderBy('hire_date', 'desc')->with('disciplinary')->get();
        foreach($employees as $employee){
            if($employee->hire_date <= $eightYearHireDate){
                // If employee hire date is greater than or equal to 8 years
                $employee->bonus_years = 8;
            }else{
                // If employee hire date is between 5 and 7 years
                $employee->bonus_years = 5;
            }
        }

        $filteredEmployees = $employees->filter(function($employee) use ($lastOfPreviousQuarter, $firstOfPreviousQuarter){
            if($employee->disciplinary->isEmpty()){
                return $employee;
            }else{
                foreach($employee->disciplinary as $disciplinary){
                    if($disciplinary->date->between($lastOfPreviousQuarter, $firstOfPreviousQuarter)){
                        $employee->active_disciplinary = 1;
                        return $employee;
                    }else{
                        $employee->active_disciplinary = 0;
                        return $employee;
                    }
                }
            }
        });
        return view('hr.queries.query-employees-bonus-hours', [
            'employees' => $filteredEmployees,
        ]);
    }
}
