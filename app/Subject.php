<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table="subjects";
    protected $fillable=[
        'name','subject_type','short'
    ];
    public function classes(){
       return $this->belongsToMany('App\Classes','subject_allocations','');
    }
}
