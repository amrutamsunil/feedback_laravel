<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table="feedbacks";
    protected $fillable=[
        'student_id','sa_id','q1','q2','q3','q4','q5',
        'q6','q7','q8','q9','q10','sum','phase'
    ];
    public function student(){
        return $this->belongsto('App\Student','student_id');
    }
}
