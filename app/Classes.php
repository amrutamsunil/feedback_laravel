<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table="classes";
    protected $fillable=[
        'name','semester','section','batch','isActive','dept_id'
    ];
    public function subjects(){
       return $this->belongsToMany('App\Subject','subject_allocations','class_id','subject_id')->withPivot('faculty_id','id');
    }
    public function faculties(){
        return $this->belongsToMany('App\Faculty','subject_allocations','class_id','faculty_id')->withPivot('subject_id','id');
    }
    public function students(){
        return $this->belongsTo('App\User','class_id');
    }
     public function isActive(){
        return $this->where('isActive','=',1)->get('id');
    }

}
