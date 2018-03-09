<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Spouse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'ssn',
        'birth_date',
        'gender',
        'domestic_partner',
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
        'birth_date',
    ];

    // ----------------Mutators----------------
    // Set first name format
    public function setFirstNameAttribute($firstName)
    {
        $this->attributes['first_name'] = strtolower($firstName);
    }

    // Get first name format
    public function getFirstNameAttribute($firstName)
    {
        return ucWords($firstName);
    }

    // Set last name format
    public function setLastNameAttribute($lastName)
    {
        $this->attributes['last_name'] = strtolower($lastName);
    }

    // Get last name format
    public function getLastNameAttribute($lastName)
    {
        return ucWords($lastName);
    }

    // Set middle initial format
    public function setMiddleInitialAttribute($middleInitial)
    {
        $this->attributes['middle_initial'] = strtolower($middleInitial);
    }

    // Get middle initial format
    public function getMiddleInitialAttribute($middleInitial)
    {
        return ucWords($middleInitial);
    }

    // Set ssn format
    public function setSsnAttribute($ssn)
    {
        $this->attributes['ssn'] = preg_replace('/[^0-9]/', '', $ssn);
    }

    // Get ssn format
    public function getSsnAttribute($ssn)
    {
        $formattedSSN = substr_replace($ssn, '-', 5, 0);
        $formattedSSN = substr_replace($formattedSSN, '-', 3, 0);
        return $formattedSSN;
    }

    // Set birth date format
    public function setBirthDateAttribute($date)
    {
        $this->attributes['birth_date'] = Carbon::parse($date);
    }
    // ----------------End Mutators----------------

    // ----------------Relationships----------------
    // Employee relationship
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
