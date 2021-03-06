<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    protected $table="admin";
    protected $fillable=[
        'name','password','dept_id','id'
    ];
    protected $hidden=[
        'password',
    ];
    public function department(){
        return $this->belongsTo('App\Department','dept_id');
    }

}
