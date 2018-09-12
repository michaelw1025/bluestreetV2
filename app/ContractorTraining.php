<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContractorTraining extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contractor_employee_name',
        'training_completion_date',
        're_training_due_date',
        'active',
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
        'training_completion_date', 
        're_training_due_date',
    ];

    // ----------------Mutators----------------
    // Set contractor employee name format
    public function setContractorEmployeeNameAttribute($name)
    {
        $this->attributes['contractor_employee_name'] = strtolower($name);
    }

    // Get contractor employee name format
    public function getContractorEmployeeNameAttribute($name)
    {
        return ucWords($name);
    }

    // Set training completion date format
    public function setTrainingCompletionDateAttribute($date)
    {
        $this->attributes['training_completion_date'] = Carbon::parse($date);
    }

    // Set re_training due date format
    public function setReTrainingDueDateAttribute($date)
    {
        $this->attributes['re_training_due_date'] = Carbon::parse($date);
    }

    // ----------------Relationships----------------
    // Contractor relationship
    public function contractor()
    {
        return $this->belongsTo('App\Contractor');
    }
}
