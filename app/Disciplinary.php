<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Disciplinary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'level',
        'date',
        'cost_center',
        'issued_by',
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

    // Get type format
    // public function getTypeAttribute($type)
    // {
    //     return ucWords($type);
    // }

    // Set level format
    public function setLevelAttribute($level)
    {
        $this->attributes['level'] = strtolower($level);
    }

    // Get level format
    // public function getLevelAttribute($level)
    // {
    //     return ucWords($level);
    // }

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
