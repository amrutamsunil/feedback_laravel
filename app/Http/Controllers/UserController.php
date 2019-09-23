<?php

namespace App\Http\Controllers;

use App\Classes;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    public function username(){
        return 'student_reg';
    }
    public function dashboard(){
        return view('user.dashboard');
    }
    public function check_feedback_submit($sa_id,$student_feedbacks,$phase){
        foreach ($student_feedbacks as $temp){
            if($sa_id==$temp->sa_id && $phase==$temp->phase){
                return true;
            }
        }
        return false;
    }
    public function showFeedbackPage($phase){
        $subjects=Classes::with(['subjects','faculties'])->where('id','=',auth()->user()->class_id)->get();
        $student=User::with('feedbacks')->where('id','=',auth()->user()->id)->get();
        foreach($subjects[0]->subjects as $index=>&$t){
            $t['faculty_name']=$subjects[0]->faculties[$index]->name;
            if($this->check_feedback_submit($t->pivot->id,$student[0]->feedbacks,$phase)){
                $t['flag']="Green";
            }else{
                $t['flag']="Red";
            }

        }
        return view('user.feedback')->with('feedback_obj',$subjects[0]);
    }
    public function feedback_form(Request $request){
        die($request);
    }
}
