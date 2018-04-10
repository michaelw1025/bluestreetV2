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
        'contractor_employee_first_name',
        'contractor_employee_last_name',
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
    // Set contractor employee first name format
    public function setContractorEmployeeFirstNameAttribute($firstName)
    {
        $this->attributes['contractor_employee_first_name'] = strtolower($firstName);
    }

    // Get contractor employee first name format
    public function getContractorEmployeeFirstNameAttribute($firstName)
    {
        return ucWords($firstName);
    }

    // Set contractor employee last name format
    public function setContractorEmployeeLastNameAttribute($lastName)
    {
        $this->attributes['contractor_employee_last_name'] = strtolower($lastName);
    }

    // Get contractor employee last name format
    public function getContractorEmployeeLastNameAttribute($lastName)
    {
        return ucWords($lastName);
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
