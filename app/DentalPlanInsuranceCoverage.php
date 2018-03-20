<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DentalPlanInsuranceCoverage extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'dental_plan_insurance_coverage';

    // ----------------Relationships----------------
    //Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
