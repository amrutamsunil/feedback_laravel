<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    protected $table="principal";
    protected $fillable=[
        'username','password'
    ];
}
