<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
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
    // ----------------End Mutators----------------
}
