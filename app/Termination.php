<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Termination extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'date',
        'last_day',
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
        'last_day',
    ];

    // ----------------Mutators----------------
    // Set type format
    public function setTypeAttribute($type)
    {
        $this->attributes['type'] = strtolower($type);
    }

    // Get type format
    // public function getTypeAttribute($type)
    // {
    //     return ucWords($type);
    // }

    // Set date format
    public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date);
    }

    // Set last day format
    public function setLastDayAttribute($date)
    {
        $this->attributes['last_day'] = Carbon::parse($date);
    }
    // ----------------End Mutators----------------

    // ----------------Relationships----------------
    // Employee relationship
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
