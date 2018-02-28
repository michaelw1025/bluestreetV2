<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
        return ucfirst($firstName);
    }

    // Set last name format
    public function setLastNameAttribute($lastName)
    {
        $this->attributes['last_name'] = strtolower($lastName);
    }

    // Get last name format
    public function getLastNameAttribute($lastName)
    {
        return ucfirst($lastName);
    }
    // ----------------End Mutators----------------



    // ----------------Relationships----------------
    // Role relationship
    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
    // ----------------End Relationships----------------



    // ----------------Auth functions----------------
    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
    if (is_array($roles)) {
        return $this->hasAnyRole($roles) || 
                abort(401, 'This action is unauthorized.');
    }
    return $this->hasRole($roles) || 
            abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
    return null !== $this->role()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
    return null !== $this->role()->where('name', $role)->first();
    }
    // ----------------End Auth functions----------------



    // ----------------Functions used for navigation authentication----------------
    public function navigationRoles($roles)
    {
        if ($this->hasAnyRole($roles))
        {
            return true;
        }
        return false;
    }
    // ----------------End of functions used for navigation authentication----------------
}
