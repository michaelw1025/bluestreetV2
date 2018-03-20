<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCoverageMedicalPlan extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'insurance_coverage_medical_plan';

    // ----------------Relationships----------------
    //Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
