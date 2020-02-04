<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Faculty extends Authenticatable
{
    protected $table="faculties";
    protected $fillable=[
        'employee_number','name','password','department_id','id'
    ];
    protected $hidden=[
        'password','created_at','updated_at',
    ];
    public function subject_allocations(){
       return $this->hasMany('App\Subject_Alloc','faculty_id');
    }
    public function subjects(){
        return $this->belongsToMany('App\Subject','subject_allocations','faculty_id','subject_id')->withPivot('class_id','id');
    }



}
