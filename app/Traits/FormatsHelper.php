<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Spouse;
use App\Dependant;
use App\PhoneNumber;
use App\EmergencyContact;


trait FormatsHelper
{
    public function convertToDate($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->toDateString();
    }

    public function convertToDateForSearch($date)
    {
        $date = Carbon::createFromFormat('m-d-Y', $date)->toDateString();
        return Carbon::parse($date);
    }
    /*
    |--------------------------------------------------------------------------
    | Spouse update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildSpouse($employee, $spouse)
    {
        foreach($spouse as $spouseArray){
            if(isset($spouseArray['update'])){    // Check if the spouse is meant to be updated or deleted
                if(isset($spouseArray['id'])){    // Check if spouse id is set for update
                    $updateSpouse = Spouse::find($spouseArray['id']);    // Get spouse for update
                    $this->assignSpouseInfo($updateSpouse, $spouseArray);
                }else{    // If spouse does not exist create new
                    $updateSpouse = new Spouse();    // Create new spouse
                    $this->assignSpouseInfo($updateSpouse, $spouseArray);
                }
                $employee->spouse()->save($updateSpouse);
            }else{    // If spouse info is in request but not selected for update then delete
                $this->deleteSpouse($employee);    // Call method to delete spouse
            }
        }
    }
    public function assignSpouseInfo($updateSpouse, $spouseArray)
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
    public function buildDependant($employee, $dependant)
    {
            $storeDependants = array();
            foreach($dependant as $dependantArray){
                if(isset($dependantArray['update'])){
                    if(isset($dependantArray['id'])){
                        $updateDependant = Dependant::find($dependantArray['id']);
                        $this->assignDependantInfo($updateDependant, $dependantArray);
                    }else{
                        $updateDependant = new Dependant();
                        $this->assignDependantInfo($updateDependant, $dependantArray);
                    }
                    $employee->dependant()->save($updateDependant);
                    $storeDependants[] = $updateDependant->id;
                }
            }
            Dependant::where('employee_id', $employee->id)->whereNotIn('id', $storeDependants)->delete();

    }
    public function assignDependantInfo($updateDependant, $dependantArray)
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
    | Phone number update and delete methods
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
}