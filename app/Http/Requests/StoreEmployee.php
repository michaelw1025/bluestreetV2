<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rulesArray = [];
        /*
            |--------------------------------------------------------------------------
            | Employee validation rules
            |--------------------------------------------------------------------------
        */
        $rulesArray += [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'hire_date' => 'required',
            'gender' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'county' => 'required',
            'position' => 'required',
            'job' => 'required',
            'cost_center' => 'required',
            'shift' => 'required',
            'progression' => 'required',
        ];
        if(isset($this->update_employee)){
            $rulesArray += [
                'ssn' => 'required|unique:spouses|unique:dependants|unique:employees,ssn,'.$this->id,
                'oracle_number' => 'nullable|unique:employees,oracle_number,'.$this->id,
                'service_date' => 'required',
                'status' => 'required',
                'rehire' => 'required',
                // Bid Eligible
                'bid_eligible_date' => 'required_if:bid_eligible,0',
                'bid_eligible_comment' => 'required_if:bid_eligible,0',
            ];
        }else{
            $rulesArray += [
                'ssn' => 'required|unique:employees|unique:spouses|unique:dependants',
                'oracle_number' => 'nullable|unique:employees',
            ];
        }

        /*
            |--------------------------------------------------------------------------
            | Spouse validation rules
            |--------------------------------------------------------------------------
        */
        $rulesArray += [
            'spouse.*.first_name' => 'required_with:spouse.*.update',
            'spouse.*.last_name' => 'required_with:spouse.*.update',
            'spouse.*.birth_date' => 'required_with:spouse.*.update',
            'spouse.*.gender' => 'required_with:spouse.*.update',
            'spouse.*.domestic_partner' => 'required_with:spouse.*.update',
        ];
        foreach($this->spouse as $spouse){
            if(isset($spouse['id'])){
                $rulesArray += [
                    'spouse.*.ssn' => 'required_with:spouse.*.update|unique:employees|unique:dependants|unique:spouses,ssn,'.$spouse['id'],
                ];
            }else{
                $rulesArray += [
                    'spouse.*.ssn' => 'required_with:spouse.*.update|unique:employees|unique:dependants|unique:spouses',
                ];
            }
        }


        /*
            |--------------------------------------------------------------------------
            | Dependant validation rules
            |--------------------------------------------------------------------------
        */
        $d = 0;
        foreach($this->dependant as $dependant){
            if(isset($dependant['update'])){
                $rulesArray += [
                    'dependant.'.$d.'.first_name' => 'required_with:dependant.'.$d.'.update',
                    'dependant.'.$d.'.last_name' => 'required_with:dependant.'.$d.'.update',
                    'dependant.'.$d.'.birth_date' => 'required_with:dependant.'.$d.'.update',
                    'dependant.'.$d.'.gender' => 'required_with:dependant.'.$d.'.update',
                ];
                if(isset($dependant['id'])){
                    $rulesArray += [
                        'dependant.'.$d.'.ssn' => 'required_with:dependant.'.$d.'.update|unique:employees,ssn|unique:spouses,ssn|unique:dependants,ssn,'.$dependant['id'],
                    ];
                }else{
                    $rulesArray += [
                        'dependant.'.$d.'.ssn' => 'required_with:dependant.'.$d.'.update|unique:employees,ssn|unique:spouses,ssn|unique:dependants,ssn',
                    ];
                }
            }
            $d++;
        }

        /*
            |--------------------------------------------------------------------------
            | Phone number validation rules
            |--------------------------------------------------------------------------
        */
        $p = 0;
        foreach($this->phone_number as $phoneNumber){
            if(isset($phoneNumber['update'])){
                $rulesArray += [
                    'phone_number.'.$p.'.number' => 'required_with:phone_number.'.$p.'.update',
                ];
            }
            $p++;
        }

        /*
            |--------------------------------------------------------------------------
            | Emergency contact validation rules
            |--------------------------------------------------------------------------
        */
        $e = 0;
        foreach($this->emergency_contact as $emergencyContact){
            if(isset($emergencyContact['update'])){
                $rulesArray += [
                    'emergency_contact.'.$e.'.name' => 'required_with:emergency_contact.'.$e.'.update',
                    'emergency_contact.'.$e.'.number' => 'required_with:emergency_contact.'.$e.'.update',
                ];
            }
            $e++;
        }

        /*
            |--------------------------------------------------------------------------
            | Disciplinary validation rules
            |--------------------------------------------------------------------------
        */
        $rulesArray += [
            'disciplinary_type' => 'required_with:disciplinary_update',
            'disciplinary_level' => 'required_with:disciplinary_update',
            'disciplinary_date' => 'required_with:disciplinary_update',
            'disciplinary_cost_center' => 'required_with:disciplinary_update',
            'disciplinary_issued_by' => 'required_with:disciplinary_update',
            'disciplinary_comments' => 'required_with:disciplinary_update',
        ];

        /*
            |--------------------------------------------------------------------------
            | Termination validation rules
            |--------------------------------------------------------------------------
        */
        $rulesArray += [
            'termination_type' => 'required_with:termination_update',
            'termination_date' => 'required_with:termination_update',
            'termination_last_day' => 'required_with:termination_update',
            'termination_comments' => 'required_with:termination_update',
        ];

        /*
            |--------------------------------------------------------------------------
            | Reduction validation rules
            |--------------------------------------------------------------------------
        */
        // $rulesArray += [
        //     'reduction_type' => 'required_with:reduction_update',
        //     'reduction_displacement' => 'required_with:reduction_update',
        //     'reduction_date' => 'required_with:reduction_update',
        //     'reduction_home_cost_center' => 'required_with:reduction_update',
        //     'reduction_comments' => 'required_with:reduction_update',
        // ];



        // dd($rulesArray);
        return $rulesArray;
    }
}
