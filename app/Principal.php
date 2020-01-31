<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Principal extends Authenticatable
{
    protected $table="principal";
    protected $fillable=[
        'username','password'
    ];
}
