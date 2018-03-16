<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WageProgressionWageTitle extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'wage_progression_wage_title';

    // ----------------Relationships----------------
    //Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
