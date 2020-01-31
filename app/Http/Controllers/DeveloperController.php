<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Classes;
use App\Department;
use App\Developer;
use App\Faculty;
use App\Feedback;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('auth:developer');
        global $feedbacks,$classes,$students,$departments;
        $feedbacks=Feedback::all();
        $classes=Classes::all();
        $students=User::all();
        $departments=Department::all();
    }
    public function hashing(){
       /* $students=Faculty::all();
        foreach ($students as &$p){
            $p->password=bcrypt($p->password);
            $p->save();
        }*/

        return redirect()->back();

    }
    public function show_add_subject(){

        return view('developer.addSubject');
    }
    public function add_subject(Request $request){
        $this->validate($request,[
            'subject_name'=>'required',
        'short_name'=>'required',
        'subject_type'=>'required']
        );
        $subject=new Subject;
        $subject->name=$request->subject_name;
        $subject->type=$request->subject_type;
        $subject->short=$request->short_name;
        if($subject->save()){
            Session::flash('success','Successfully Added New Subject');
        }else{
            Session::flash('error','Unable to add the record ! Try again ');
        }

        return view('developer.addSubject');
    }
    public function dashboard(){
        return view('developer.dashboard');
    }
}
