<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisionVoucher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voucher_number',
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
    
    // ----------------End Mutators----------------

    // ----------------Relationships----------------
    // Employee relationship
    public function employee()
    {
        return $this->belongsTo('App\Employee')->orderBy('created_at', 'asc');
    }
}
