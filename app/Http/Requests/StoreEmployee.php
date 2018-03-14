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
        /*
            |--------------------------------------------------------------------------
            | Employee validation rules
            |--------------------------------------------------------------------------
        */
        $rulesArray = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'oracle_number' => 'required',
            'birth_date' => 'required',
            'hire_date' => 'required',
            'service_date' => 'required',
            'gender' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'county' => 'required',
            'status' => 'required',
            'rehire' => 'required',
        ];
        if(isset($this->update_employee)){
            $rulesArray += [
                'ssn' => 'required|unique:spouses|unique:dependants|unique:employees,ssn,'.$this->id,
            ];
        }else{
            $rulesArray += [
                'ssn' => 'required|unique:employees|unique:spouses|unique:dependants',
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
        $rulesArray += [
            'dependant.*.first_name' => 'required_with:dependant.*.update',
            'dependant.*.last_name' => 'required_with:dependant.*.update',
            'dependant.*.birth_date' => 'required_with:dependant.*.update',
            'dependant.*.gender' => 'required_with:dependant.*.update',
        ];
        // foreach($this->dependant as $dependant){
        //     if(isset($dependant['id'])){
        //         $rulesArray += [
        //             'dependant.*.ssn' => 'required_with:dependant.*.update|unique:employees|unique:spouses|unique:dependants,ssn,'.$dependant['id'],
        //         ];
        //     }else{
        //         $rulesArray += [
        //             'dependant.*.ssn' => 'required_with:dependant.*.update|unique:employees|unique:dependants|unique:dependants',
        //         ];
        //     }
        // }

        

        // dd($rulesArray);
        return $rulesArray;
    }
}
