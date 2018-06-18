<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    // ----------------Mutators----------------
    // Set description format
    public function setDescriptionAttribute($description)
    {
        $this->attributes['description'] = strtolower($description);
    }

    // Get description format
    public function getDescriptionAttribute($description)
    {
        return ucWords($description);
    }

    // ----------------End Mutators----------------

    // ----------------Relationships----------------
    // Staff Manager relationship
    public function employeeStaffManager()
    {
        return $this->belongsToMany('App\Employee', 'cost_center_staff_manager');
    }
    // Day Team Manager relationship
    public function employeeDayTeamManager()
    {
        return $this->belongsToMany('App\Employee', 'cost_center_day_team_manager');
    }
    // Night Team Manager relationship
    public function employeeNightTeamManager()
    {
        return $this->belongsToMany('App\Employee', 'cost_center_night_team_manager');
    }
    // Day Team Leader relationship
    public function employeeDayTeamLeader()
    {
        return $this->belongsToMany('App\Employee', 'cost_center_day_team_leader');
    }
    // Night Team Leader relationship
    public function employeeNightTeamLeader()
    {
        return $this->belongsToMany('App\Employee', 'cost_center_night_team_leader');
    }
    // Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
