<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reduction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currently_active',
        'type',
        'displacement',
        'date',
        'home_cost_center',
        'bump_to_cost_center',
        'home_shift',
        'fiscal_week',
        'fiscal_year',
        'comments',
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
        'date',
    ];

    // ----------------Mutators----------------
    // Set type format
    public function setTypeAttribute($type)
    {
        $this->attributes['type'] = strtolower($type);
    }

    // Set displacement format
    public function setDisplacementAttribute($displacement)
    {
        $this->attributes['displacement'] = strtolower($displacement);
    }

    // Set date format
    public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date);
    }

    // ----------------End Mutators----------------

    // ----------------Relationships----------------
    // Employee relationship
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
