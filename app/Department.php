<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table="departments";
    protected $fillable=[
        'name','short'
    ];
    public function admins(){
        return $this->hasMany('App\Admin','dept_id');
    }
    public function classes(){
        return $this->hasMany('App\Classes','department_id');
    }

    public function active_classes(){
        return $this->hasMany('App\Classes','department_id')->where('classes.isActive','=',1);
    }
}
