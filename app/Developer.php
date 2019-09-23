<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $table="developer";
    protected $fillable=[
       'username','password'
    ];
}
