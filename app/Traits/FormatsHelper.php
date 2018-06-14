<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Spouse;
use App\Dependant;
use App\PhoneNumber;
use App\EmergencyContact;
use App\VisionVoucher;
use App\ParkingPermit;
use App\Disciplinary;
use App\Termination;
use App\Reduction;
use App\CostCenter;


trait FormatsHelper
{
    public function convertToDate($date)
    {
        $date = Carbon::createFromFormat('m-d-Y', $date)->toDateString();
        return Carbon::parse($date);
    }

    public function setTeamManagerTeamLeader($employee)
    {
        if($employee->shift->isNotEmpty()){
            foreach($employee->shift as $shift){
                foreach($employee->costCenter as $costCenter){

                    if($shift->description == 'Day'){
                        $teamManager = CostCenter::with('employeeDayTeamManager')->find($costCenter->id);
                        if($teamManager->employeeDayTeamManager->isNotEmpty()){
                            $employee->team_manager = $teamManager->employeeDayTeamManager[0]->first_name.' '.$teamManager->employeeDayTeamManager[0]->last_name;
                            $employee->team_manager_id = $teamManager->employeeDayTeamManager[0]->id;
                        }else{
                            $employee->team_manager = null;
                            $employee->team_manager_id = null;
                        }
                        $teamLeader = CostCenter::with('employeeDayTeamLeader')->find($costCenter->id);
                        if($teamLeader->employeeDayTeamLeader->isNotEmpty()){
                            $employee->team_leader = $teamLeader->employeeDayteamLeader[0]->first_name.' '.$teamLeader->employeeDayteamLeader[0]->last_name;
                            $employee->team_leader_id = $teamLeader->employeeDayTeamLeader[0]->id;
                        }else{
                            $employee->team_leader = null;
                            $employee->team_leader_id = null;
                        }
                    }elseif($employee->shift[0]->description == 'Night'){
                        $teamManager = CostCenter::with('employeeNightTeamManager')->find($costCenter->id);
                        if($teamManager->employeeNightTeamManager->isNotEmpty()){
                            $employee->team_manager = $teamManager->employeeNightTeamManager[0]->first_name.' '.$teamManager->employeeNightTeamManager[0]->last_name;
                            $employee->team_manager_id = $teamManager->employeeNightTeamManager[0]->id;
                        }else{
                            $employee->team_manager = null;
                            $employee->team_manager_id = null;
                        }
                        $teamLeader = CostCenter::with('employeeNightTeamLeader')->find($costCenter->id);
                        if($teamLeader->employeeNightTeamLeader->isNotEmpty()){
                            $employee->team_leader = $teamLeader->employeeNightteamLeader[0]->first_name.' '.$teamLeader->employeeNightteamLeader[0]->last_name;
                            $employee->team_leader_id = $teamLeader->employeeNightTeamLeader[0]->id;
                        }else{
                            $employee->team_leader = null;
                            $employee->team_leader_id = null;
                        }
                    }else{
                        $employee->team_manager = null;
                        $employee->team_manager_id = null;
                        $employee->team_leader = null;
                        $employee->team_leader_id = null;
                    }

                }
            }

        }else{
            $employee->team_manager = null;
                $employee->team_manager_id = null;
                $employee->team_leader = null;
                $employee->team_leader_id = null;
        }
    }

    public function getWageStatus($employee)
    {
        $wageDate = $employee->hire_date;
        $today = Carbon::today();
        $employee->wage_difference = $today->diffInMonths($wageDate);
        if($employee->wage_difference > 42){
            $employee->wage_difference = 42;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Employee update and delete methods
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | Spouse update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildSpouse($employee, $request)
    {
        foreach($request->spouse as $spouseArray){
            if(isset($spouseArray['update'])){    // Check if the spouse is meant to be updated or deleted
                if(isset($spouseArray['id'])){    // Check if spouse id is set for update
                    $updateSpouse = Spouse::find($spouseArray['id']);    // Get spouse for update
                    $this->assignSpouseInfo($updateSpouse, $spouseArray, $request);
                }else{    // If spouse does not exist create new
                    $updateSpouse = new Spouse();    // Create new spouse
                    $this->assignSpouseInfo($updateSpouse, $spouseArray, $request);
                }
                $employee->spouse()->save($updateSpouse);
            }else{    // If spouse info is in request but not selected for update then delete
                $this->deleteSpouse($employee);    // Call method to delete spouse
            }
        }
    }
    public function assignSpouseInfo($updateSpouse, $spouseArray, $request)
    {
        $updateSpouse->first_name = $spouseArray['first_name'];
        $updateSpouse->last_name = $spouseArray['last_name'];
        $updateSpouse->middle_initial = $spouseArray['middle_initial'];
        $updateSpouse->ssn = $spouseArray['ssn'];
        $updateSpouse->birth_date = $this->convertToDate($spouseArray['birth_date']);
        $updateSpouse->gender = $spouseArray['gender'];
        $updateSpouse->domestic_partner = $spouseArray['domestic_partner'];
    }
    public function deleteSpouse($employee)
    {
        $employee->spouse()->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Dependant update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildDependant($employee, $request)
    {
            $storeDependants = array();
            foreach($request->dependant as $dependantArray){
                if(isset($dependantArray['update'])){
                    if(isset($dependantArray['id'])){
                        $updateDependant = Dependant::find($dependantArray['id']);
                        $this->assignDependantInfo($updateDependant, $dependantArray, $request);
                    }else{
                        $updateDependant = new Dependant();
                        $this->assignDependantInfo($updateDependant, $dependantArray, $request);
                    }
                    $employee->dependant()->save($updateDependant);
                    $storeDependants[] = $updateDependant->id;
                }
            }
            Dependant::where('employee_id', $employee->id)->whereNotIn('id', $storeDependants)->delete();

    }
    public function assignDependantInfo($updateDependant, $dependantArray, $request)
    {
        $updateDependant->first_name = $dependantArray['first_name'];
        $updateDependant->last_name = $dependantArray['last_name'];
        $updateDependant->middle_initial = $dependantArray['middle_initial'];
        $updateDependant->ssn = $dependantArray['ssn'];
        $updateDependant->birth_date = $this->convertToDate($dependantArray['birth_date']);
        $updateDependant->gender = $dependantArray['gender'];
    }
    public function deleteDependant($employee)
    {
        $employee->dependant()->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Phone number update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildPhoneNumber($employee, $phoneNumber)
    {
            $storePhoneNumbers = array();
            foreach($phoneNumber as $phoneNumberArray){
                if(isset($phoneNumberArray['update'])){
                    if(isset($phoneNumberArray['id'])){
                        $updatePhoneNumber = PhoneNumber::find($phoneNumberArray['id']);
                        $this->assignPhoneNumberInfo($updatePhoneNumber, $phoneNumberArray);
                    }else{
                        $updatePhoneNumber = new PhoneNumber();
                        $this->assignPhoneNumberInfo($updatePhoneNumber, $phoneNumberArray);
                    }
                    $employee->phoneNumber()->save($updatePhoneNumber);
                    $storePhoneNumbers[] = $updatePhoneNumber->id;
                }
            }
            PhoneNumber::where('employee_id', $employee->id)->whereNotIn('id', $storePhoneNumbers)->delete();

    }
    public function assignPhoneNumberInfo($updatePhoneNumber, $phoneNumberArray)
    {
        $updatePhoneNumber->number = $phoneNumberArray['number'];
        if(isset($phoneNumberArray['is_primary'])){
            $updatePhoneNumber->is_primary = 1;
        }else{
            $updatePhoneNumber->is_primary = 0;
        }

    }
    public function deletePhoneNumber($employee)
    {
        $employee->phoneNumber()->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Emergency Contact update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildEmergencyContact($employee, $emergencyContact)
    {
            $storeEmergencyContacts = array();
            foreach($emergencyContact as $emergencyContactArray){
                if(isset($emergencyContactArray['update'])){
                    if(isset($emergencyContactArray['id'])){
                        $updateEmergencyContact = EmergencyContact::find($emergencyContactArray['id']);
                        $this->assignEmergencyContactInfo($updateEmergencyContact, $emergencyContactArray);
                    }else{
                        $updateEmergencyContact = new EmergencyContact();
                        $this->assignEmergencyContactInfo($updateEmergencyContact, $emergencyContactArray);
                    }
                    $employee->emergencyContact()->save($updateEmergencyContact);
                    $storeEmergencyContacts[] = $updateEmergencyContact->id;
                }
            }
            EmergencyContact::where('employee_id', $employee->id)->whereNotIn('id', $storeEmergencyContacts)->delete();

    }
    public function assignEmergencyContactInfo($updateEmergencyContact, $emergencyContactArray)
    {
        $updateEmergencyContact->name = $emergencyContactArray['name'];
        $updateEmergencyContact->number = $emergencyContactArray['number'];
        if(isset($emergencyContactArray['is_primary'])){
            $updateEmergencyContact->is_primary = 1;
        }else{
            $updateEmergencyContact->is_primary = 0;
        }

    }
    public function deleteEmergencyContact($employee)
    {
        $employee->emergencyContact()->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Position
    |--------------------------------------------------------------------------
    */
    public function syncPosition($employee, $positionID)
    {
        $employee->position()->sync($positionID);
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Job
    |--------------------------------------------------------------------------
    */
    public function syncJob($employee, $jobID)
    {
        $employee->job()->sync($jobID);
    }

    /*
    |--------------------------------------------------------------------------
    | Sync CostCenter
    |--------------------------------------------------------------------------
    */
    public function syncCostCenter($employee, $costCenterID)
    {
        $employee->costCenter()->sync($costCenterID);
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Shift
    |--------------------------------------------------------------------------
    */
    public function syncShift($employee, $shiftID)
    {
        $employee->shift()->sync($shiftID);
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Wage
    |--------------------------------------------------------------------------
    */
    public function syncWage($employee, $wageID)
    {
        $employee->wageProgressionWageTitle()->sync($wageID);
    }

    /*
    |--------------------------------------------------------------------------
    | Vision voucher update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildVisionVoucher($employee, $voucherNumber)
    {

        $updateVoucher = new VisionVoucher();
        $this->assignVisionVoucherInfo($updateVoucher, $voucherNumber);
        $employee->visionVoucher()->save($updateVoucher);

    }
    public function assignVisionVoucherInfo($updateVoucher, $voucherNumber)
    {
        $updateVoucher->voucher_number = $voucherNumber;
    }

    /*
    |--------------------------------------------------------------------------
    | Parking permit update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildParkingPermit($employee, $parkingPermitNumber)
    {

        $updateParkingPermit = new ParkingPermit();
        $this->assignParkingPermitInfo($updateParkingPermit, $parkingPermitNumber);
        $employee->parkingPermit()->save($updateParkingPermit);

    }
    public function assignParkingPermitInfo($updateParkingPermit, $parkingPermitNumber)
    {
        $updateParkingPermit->number = $parkingPermitNumber;
    }

    /*
    |--------------------------------------------------------------------------
    | Disciplinary update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildDisciplinary($employee, $request)
    {
        $updateDisciplinary = new Disciplinary();
        $this->assignDisciplinaryInfo($updateDisciplinary, $request);
        $employee->disciplinary()->save($updateDisciplinary);
    }
    public function assignDisciplinaryInfo($updateDisciplinary, $request)
    {
        $updateDisciplinary->type = $request->disciplinary_type;
        $updateDisciplinary->level = $request->disciplinary_level;
        $updateDisciplinary->date = $this->convertToDate($request->disciplinary_date);
        $updateDisciplinary->cost_center = $request->disciplinary_cost_center;
        $updateDisciplinary->issued_by = $request->disciplinary_issued_by;
        $updateDisciplinary->comments = $request->disciplinary_comments;
    }
    public function updateDisciplinaryInfo($employee, $request)
    {
        $disciplinary = Disciplinary::find($request->disciplinary_id);
        $this->assignDisciplinaryInfo($disciplinary, $request);
        $employee->disciplinary()->save($disciplinary);
    }
    public function deleteDisciplinary($employee, $request)
    {
        Disciplinary::where('id', $request->disciplinary_id)->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Termination update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildTermination($employee, $request)
    {
        $updateTermination = new Termination();
        $this->assignTerminationInfo($updateTermination, $request);
        $employee->termination()->save($updateTermination);
    }
    public function assignTerminationInfo($updateTermination, $request)
    {
        $updateTermination->type = $request->termination_type;
        $updateTermination->date = $this->convertToDate($request->termination_date);
        $updateTermination->last_day = $this->convertToDate($request->termination_last_day);
        $updateTermination->comments = $request->termination_comments;
    }
    public function updateTerminationInfo($employee, $request)
    {
        $termination = Termination::find($request->termination_id);
        $this->assignTerminationInfo($termination, $request);
        $employee->termination()->save($termination);
    }
    public function deleteTermination($employee, $request)
    {
        Termination::where('id', $request->termination_id)->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Reduction update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildReduction($employee, $request)
    {
        $updateReduction = new Reduction();
        $this->assignReductionInfo($updateReduction, $request);
        $employee->reduction()->save($updateReduction);
    }
    public function assignReductionInfo($updateReduction, $request)
    {
        if($request->reduction_update){
            $updateReduction->currently_active = 1;
        }else{
            $updateReduction->currently_active = 0;
        }
        $updateReduction->type = $request->reduction_type;
        $updateReduction->displacement = $request->reduction_displacement;
        $updateReduction->date = $this->convertToDate($request->reduction_date);
        $updateReduction->home_cost_center = $request->reduction_home_cost_center;
        $updateReduction->bump_to_cost_center = $request->reduction_bump_to_cost_center;
        $updateReduction->home_shift = $request->reduction_home_shift;
        $updateReduction->bump_to_shift = $request->reduction_bump_to_shift;
        $updateReduction->fiscal_week = $request->reduction_fiscal_week;
        $updateReduction->fiscal_year = $request->reduction_fiscal_year;
        $updateReduction->comments = $request->reduction_comments;
        if($request->has('reduction_return_date')){
            $updateReduction->return_date = $this->convertToDate($request->reduction_return_date);
        }else{
            $returnDate = ('01-01-2050');
            $updateReduction->return_date = $this->convertToDate($returnDate);
        }
    }
    public function updateReductionInfo($employee, $request)
    {
        $reduction = Reduction::find($request->reduction_id);
        $this->assignReductionInfo($reduction, $request);
        $employee->reduction()->save($reduction);
    }
    public function deleteReduction($employee, $request)
    {
        Reduction::where('id', $request->reduction_id)->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Wage Event Scale update methods
    |--------------------------------------------------------------------------
    */
    public function buildWageEventScale($employee, $request)
    {
        if($request->has('create_employee')){

        }elseif($request->has('update_employee')){
            $eventArray = array();
            foreach($request->wage_event as $wageEvent){
                if(!is_null($wageEvent['date'])){
                    $wageDate = $this->convertToDate($wageEvent['date']);
                    $eventArray[$wageEvent['month']] = (['date' => $wageDate]);
                }
            }
            $employee->wageProgression()->sync($eventArray);
        }
    }

    public function setWageEventDate($employee)
    {
        foreach($employee->wageProgression as $employeeProgression){
            $employeeProgression->pivot->date = Carbon::parse($employeeProgression->pivot->date);
        }
    }
}
