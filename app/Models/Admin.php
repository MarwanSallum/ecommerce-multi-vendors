<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded=[];
    public $timestamps = true;
    protected $hidden = [
        'password', 'remember_token','created_at', 'updated_at'
    ];

    public function getAvatarAttribute($val){
        return ($val !== null) ? asset('assets/'. $val) : "";
    }
}
