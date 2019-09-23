<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_Alloc extends Model
{
    protected $table="subject_allocations";
    protected $fillable=[
        'class_id','faculty_id','subject_id'
    ];
    public $incrementing = true;


}
