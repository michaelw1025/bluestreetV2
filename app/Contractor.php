<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contractor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contractor_name',
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'general_liability_insurance_date',
        'work_comp_employment_insurance_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be dates.
     *
     * @var array
     */
    protected $dates = [
        'general_liability_insurance_date', 
        'work_comp_employment_insurance_date',
    ];

    // ----------------Mutators----------------
    // Set contractor name format
    public function setContractorNameAttribute($name)
    {
        $this->attributes['contractor_name'] = strtolower($name);
    }

    // Get contractor name format
    public function getContractorNameAttribute($name)
    {
        return ucWords($name);
    }

    // Set contact name format
    public function setContactNameAttribute($name)
    {
        $this->attributes['contact_name'] = strtolower($name);
    }

    // Get contact name format
    public function getContactNameAttribute($name)
    {
        return ucWords($name);
    }

    // Set general liability insurance date format
    public function setGeneralLiabilityInsuranceDateAttribute($date)
    {
        $this->attributes['general_liability_insurance_date'] = Carbon::parse($date);
    }

    // Set work comp employment insurance date format
    public function setWorkCompEmploymentInsuranceDateAttribute($date)
    {
        $this->attributes['work_comp_employment_insurance_date'] = Carbon::parse($date);
    }

    // ----------------Relationships----------------
    // Contractor Training relationship
    public function contractorTraining()
    {
        return $this->hasMany('App\ContractorTraining');
    }
}
