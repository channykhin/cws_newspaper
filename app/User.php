<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'first_name','last_name','username','profile','status','phone', 'email', 'password',
    ];
    protected $dates = [
        'last_logged','created_at', 'updated_at'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function roles() {
        return $this->belongsTo('App\Role', 'role_id');
    }
    public function categories() {
        return $this->hasMany('App\Categories', 'created_by');
    }
}
