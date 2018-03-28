<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FormatsHelper;

use Carbon\Carbon;
use App\Employee;
use App\CostCenter;
use App\Shift;

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
        // return $employees;
        return view('hr.query-employees-alphabetical', [
            'employees' => $employees,
        ]);
    }

    /**
     * Query reviews
     *
     * @param  int  $status
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
     * @param  int  $status
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
     * @param  int  $status
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
}
