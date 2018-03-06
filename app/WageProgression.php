<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WageProgression extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    

    // ----------------Mutators----------------
    // Set month format
    public function setMonthAttribute($month)
    {
        $this->attributes['month'] = (int)$month;
    }

    // Get month format
    public function getMonthAttribute($month)
    {
        return (int)$month;
    }
    // ----------------End Mutators----------------

    // ----------------Relationships----------------
    // Wage Title relationship
    public function wageTitle()
    {
        return $this->belongsToMany('App\WageTitle')->withPivot('amount')->orderBy('month', 'asc');
    }
}
