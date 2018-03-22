<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Spouse;
use App\Dependant;
use App\PhoneNumber;
use App\EmergencyContact;
use App\VisionVoucher;
use App\Beneficiary;
use App\ParkingPermit;
use App\Disciplinary;


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
        $employee->flex_spending_amount = $request->flex_spending_amount;
        $employee->hsa_amount = $request->hsa_amount;
        $employee->child_care_spending_amount = $request->child_care_spending_amount;
        $employee->employee_optional_life = $request->employee_optional_life;
        $employee->spouse_optional_life = $request->spouse_optional_life;
        $employee->dependant_optional_life = $request->dependant_optional_life;

        if($request->has('vitality_incentive')){
            $employee->vitality_incentive = 1;
        }else{
            $employee->vitality_incentive = 0;
        }

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
        if($request->has('spouse_medical_'.$updateSpouse->id)){
            $updateSpouse->has_medical = 1;
        }else{
            $updateSpouse->has_medical = 0;
        }
        if($request->has('spouse_dental_'.$updateSpouse->id)){
            $updateSpouse->has_dental = 1;
        }else{
            $updateSpouse->has_dental = 0;
        }
        if($request->has('spouse_vision_'.$updateSpouse->id)){
            $updateSpouse->has_vision = 1;
        }else{
            $updateSpouse->has_vision = 0;
        }
        if($request->has('spouse_court_ordered_'.$updateSpouse->id)){
            $updateSpouse->court_ordered = 1;
        }else{
            $updateSpouse->court_ordered = 0;
        }
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
        if($request->has('dependant_medical_'.$updateDependant->id)){
            $updateDependant->has_medical = 1;
        }else{
            $updateDependant->has_medical = 0;
        }
        if($request->has('dependant_dental_'.$updateDependant->id)){
            $updateDependant->has_dental = 1;
        }else{
            $updateDependant->has_dental = 0;
        }
        if($request->has('dependant_vision_'.$updateDependant->id)){
            $updateDependant->has_vision = 1;
        }else{
            $updateDependant->has_vision = 0;
        }
        if($request->has('dependant_court_ordered_'.$updateDependant->id)){
            $updateDependant->court_ordered = 1;
        }else{
            $updateDependant->court_ordered = 0;
        }
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
    | Sync Medical Insurance
    |--------------------------------------------------------------------------
    */
    public function syncMedicalInsurance($employee, $medicalCoverageType)
    {
        foreach($medicalCoverageType as $medicalCoverage){
            if(!is_null($medicalCoverage)){
                $employee->insuranceCoverageMedicalPlan()->sync($medicalCoverage);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Dental Insurance
    |--------------------------------------------------------------------------
    */
    public function syncDentalInsurance($employee, $dentalCoverageType)
    {
        foreach($dentalCoverageType as $dentalCoverage){
            if(!is_null($dentalCoverage)){
                $employee->dentalPlanInsuranceCoverage()->sync($dentalCoverage);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Vision Insurance
    |--------------------------------------------------------------------------
    */
    public function syncVisionInsurance($employee, $visionCoverageType)
    {
        foreach($visionCoverageType as $visionCoverage){
            if(!is_null($visionCoverage)){
                $employee->insuranceCoverageVisionPlan()->sync($visionCoverage);
            }
        }
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
    // public function deleteVisionVoucher($employee)
    // {
    //     $employee->visionVoucher()->delete();
    // }

    /*
    |--------------------------------------------------------------------------
    | Accidental insurance update and delete methods
    |--------------------------------------------------------------------------
    */
    public function attachAccidentalInsurance($employee, $request)
    {
        if(!is_null($request->accidental_insurance_coverage)){
            $employee->accidentalCoverage()->detach();
            $employee->accidentalCoverage()->attach($request->accidental_insurance_coverage, ['amount' => $request->accidental_insurance_amount]);
        }else{
            $employee->accidentalCoverage()->detach();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Beneficiary update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildBeneficiary($employee, $beneficiary)
    {
            $storeBeneficiaries = array();
            foreach($beneficiary as $beneficiaryArray){
                if(isset($beneficiaryArray['update'])){
                    if(isset($beneficiaryArray['id'])){
                        $updateBeneficiary = Beneficiary::find($beneficiaryArray['id']);
                        $this->assignBeneficiaryInfo($updateBeneficiary, $beneficiaryArray);
                    }else{
                        $updateBeneficiary = new Beneficiary();
                        $this->assignBeneficiaryInfo($updateBeneficiary, $beneficiaryArray);
                    }
                    $employee->beneficiary()->save($updateBeneficiary);
                    $storeBeneficiaries[] = $updateBeneficiary->id;
                }
            }
            Beneficiary::where('employee_id', $employee->id)->whereNotIn('id', $storeBeneficiaries)->delete();

    }
    public function assignBeneficiaryInfo($updateBeneficiary, $beneficiaryArray)
    {
        $updateBeneficiary->name = $beneficiaryArray['name']; 
        $updateBeneficiary->percentage = $beneficiaryArray['percentage'];    
    }
    public function deleteBeneficiary($employee)
    {
        $employee->beneficiary()->delete();
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
    // public function deleteVisionVoucher($employee)
    // {
    //     $employee->visionVoucher()->delete();
    // }

    /*
    |--------------------------------------------------------------------------
    | Disciplinary update and delete methods
    |--------------------------------------------------------------------------
    */
    public function buildDisciplinary($employee, $request)
    {
            // $storeDisciplinaries = array();
            // foreach($request->disciplinary as $disciplinaryArray){
            //     if(isset($disciplinaryArray['update'])){
            //         if(isset($disciplinaryArray['id'])){
            //             $updateDisciplinary = Disciplinary::find($disciplinaryArray['id']);
            //             $this->assignDisciplinaryInfo($updateDisciplinary, $disciplinaryArray, $request);
            //         }else{
                        $updateDisciplinary = new Disciplinary();
                        $this->assignDisciplinaryInfo($updateDisciplinary, $request);
                    // }
                    $employee->disciplinary()->save($updateDisciplinary);
                    // $storeDisciplinaries[] = $updateDisciplinary->id;
            //     }
            // }
            // Disciplinary::where('employee_id', $employee->id)->whereNotIn('id', $storeDisciplinaries)->delete();

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
        // dd($employee);
        Disciplinary::where('id', $request->disciplinary_id)->delete();
    }
}