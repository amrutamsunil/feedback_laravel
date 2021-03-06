<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;



class Developer extends Authenticatable
{
    protected $table="developer";
    protected $fillable=[
       'username','password','id',
    ];
    protected $hidden=[
        'password'
    ];

}
