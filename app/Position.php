<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Job;

class Position extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
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
    // Job relationship
    public function job()
    {
        return $this->belongsToMany('App\Job');
    }
    // Wage Title relationship
    public function wageTitle()
    {
        return $this->belongsToMany('App\WageTitle');
    }
    //Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
