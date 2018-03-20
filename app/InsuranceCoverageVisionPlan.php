<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCoverageVisionPlan extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'insurance_coverage_vision_plan';

    // ----------------Relationships----------------
    //Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
