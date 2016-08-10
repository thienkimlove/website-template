<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    protected $fillable = ['name', 'email', 'permission_id', 'remember_token'];

    public function missingPermission($action)
    {
        return ($this->permission_id && in_array($action, config('permissions')[$this->permission_id]['permission']));
    }
}
