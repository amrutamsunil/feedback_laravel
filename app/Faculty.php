<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table="faculties";
    protected $fillable=[
        'employee_no','name','password','dept_id'
    ];
    public function subject_allocations(){
       return $this->hasMany('App\Subject_Alloc','faculty_id');
    }
}
