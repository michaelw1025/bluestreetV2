<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'is_primary',
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
        
    ];

    // ----------------Mutators----------------
    // Set number format
    public function setNumberAttribute($number)
    {
        $this->attributes['number'] = preg_replace('/[^0-9]/', '', $number);
    }

    // Get number format
    public function getNumberAttribute($number)
    {
        $formattedNumber = substr_replace($number, '-', 6, 0);
        $formattedNumber = substr_replace($formattedNumber, '-', 3, 0);
        return $formattedNumber;
    }
    // ----------------End Mutators----------------

    // ----------------Relationships----------------
    // Employee relationship
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
