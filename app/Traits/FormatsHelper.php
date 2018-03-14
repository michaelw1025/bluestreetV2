<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Spouse;
use App\Dependant;

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
    // foreach($dependant as $dependantArray){
        // if(isset($dependantArray['update'])){    // Check if the dependant is meant to be updated or deleted
        //     if(isset($dependantArray['id'])){    // Check if dependant id is set for update
        //         $updateDependant = Dependant::find($dependantArray['id']);    // Get dependant for update
        //         $this->assignDependantInfo($updateDependant, $dependantArray);
        //     }else{    // If dependant does not exist create new
        //         $updateDependant = new Dependant();    // Create new dependant
        //         $this->assignDependantInfo($updateDependant, $dependantArray);
        //     }
        //     $employee->dependant()->save($updateDependant);
        // }else{    // If dependant info is in request but not selected for update then delete
        //     $this->deleteDependant($employee);    // Call method to delete dependant
        // }

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
}