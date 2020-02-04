<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="students";
    protected $fillable = [
        'name', 'class_id', 'student_reg','name','password','id'
    ];


    /*protected $hidden = [
        'password'
    ];*/
    public function classes(){
        return $this->belongsTo('App\Classes','class_id');
    }
    public function isActive(){
        return $this->hasOne('App\Classes','class_id')->where('isActive','=','1');
    }
    public function feedbacks(){
        return $this->hasMany('App\Feedback','student_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
