<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table="subjects";
    protected $fillable=[
        'name','subject_type','short'
    ];
    /*public function classes(){
       return $this->belongsToMany('App\Classes','subject_allocations','');
    }*/
    public function faculties(){
        return $this->belongsToMany('App\Faculty','subject_allocations','subject_id','faculty_id')->withPivot('class_id','id');
    }
}
