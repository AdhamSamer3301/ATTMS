<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['role_id','name'];
    public function users() {
        return $this->belongsToMany('App\User');
    }

    // public function employee()
    // {
    //     return $this->belongsToMany('App\Employee');
    // }
}
