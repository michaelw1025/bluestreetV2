<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // ----------------User Relationship----------------
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
