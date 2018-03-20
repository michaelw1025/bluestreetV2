<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCoverage extends Model
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

    /**
     * The attributes that should be dates.
     *
     * @var array
     */
    protected $dates = [
        
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
    // Medical Plan relationship
    public function medicalPlan()
    {
        return $this->belongsToMany('App\MedicalPlan')->withPivot('id', 'amount');
    }

    // Dental Plan relationship
    public function dentalPlan()
    {
        return $this->belongsToMany('App\DentalPlan')->withPivot('id', 'amount');
    }

    // Vision Plan relationship
    public function visionPlan()
    {
        return $this->belongsToMany('App\VisionPlan')->withPivot('id', 'amount');
    }
}
