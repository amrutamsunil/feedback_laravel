<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Department;
use App\Faculty;
use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hod');
    }
    public function username(){
        return 'name';
    }
    public function find_average($subjects){
        $avg=0;$temp=0;
        $f=Feedback::all();
        foreach ($subjects as $subject){
        $temp=$f->where('sa_id','=',$subject->id)->avg('sum');
        $avg+=$temp;
        }

        return (int)$avg;
    }
    public function dashboard(){
        $datapoints=array();
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        $faculties=Faculty::with(['subject_allocations'=>function($query) use($active_classes) {
            $query->whereIn('class_id',$active_classes);
        }])->where('department_id','=',auth()->user()->dept_id)->get();
        //die(json_encode($faculties));
        foreach($faculties as $faculty){
            $t=array(
                'y'=>$this->find_average($faculty->subject_allocations),
                    'label'=>$faculty->name
        );
            array_push($datapoints,$t);
        }
        $department_name=Department::where('id','=',auth()->user()->dept_id)->get();

        return view('admin.dashboard')->with('datapoints',$datapoints)->with('dept_name',$department_name[0]->short);
    }
    public function ajax_class_wise(Request $request){
        $this->validate($request,[
            'class_id'=>'required'
        ]);
        $feedbacks=Feedback::all();
        $students_count=Classes::with('students')->where('id','=',$request->class_id)->count();
        $subjects=Classes::with(['subjects','faculties'])->where('id','=',$request->class_id)->get();
        $subjects[0]['student_count']=$students_count;
        foreach($subjects[0]->subjects as $index=>&$t) {
            //$t['faculty'] = $subjects[0]->faculties[$index]->name;
            /*$t['faculty']=$subjects[0]->faculties->where('id','=',$t->pivot->faculty_id)->first();
            $t['result']['phase1']=$feedbacks->where('sa_id','=',$t->pivot->id)
                                    ->where('phase','=',1)
                                    ->avg('sum');
            $t['result']['phase2']=$feedbacks->where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)
                ->avg('sum');
            $t['students_count']['phase1']=$feedbacks->where('sa_id','=',$t->pivot->id)
                                            ->where('phase','=',1)->count();
            $t['students_count']['phase2']=$feedbacks->where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)->count();
*/


        }
        echo json_encode($subjects);


    }
    public function ajax_faculty_wise(){

    }
    public function all_faculty_wise(){

    }
    public function class_wise_page(){
       /* $class_obj=new Classes();
        $class_list=$class_obj->isActiveLists(auth()->user()->dept_id);*/
        $feedbacks=Feedback::all();
        $students=Classes::with('students')->where('id','=',63)->get();
        $students_count=$students[0]->students->count();
        $subjects=Classes::with(['subjects','faculties'])->where('id','=',63)->get();
        $subjects[0]['student_count']=$students_count;

        foreach($subjects[0]->subjects as $index=>&$t) {
            //$t['faculty'] = $subjects[0]->faculties[$index]->name;
            $t['faculty']=$subjects[0]->faculties->where('id','=',$t->pivot->faculty_id)->first();

            $p1_avg=$feedbacks->where('sa_id','=',$t->pivot->id)
                ->where('phase','=',1)
                ->avg('sum');
            if($p1_avg==NULL) $p1_avg=0;
            $t['phase1_avg']=$p1_avg;

            $p2_avg=$feedbacks->where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)
                ->avg('sum');
            if($p2_avg==NULL) $p2_avg=0;
            $t['phase2_avg']=$p2_avg;

            $s1_count=$feedbacks->where('sa_id','=',$t->pivot->id)
                ->where('phase','=',1)->count();
            if($s1_count==NULL) $s1_count=0;
            $s2_count=$feedbacks->where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)->count();
            if($s2_count==NULL) $s2_count=0;
            $t['phase1_student_count']=$s1_count;
            $t['phase2_student_count']=$s2_count;



        }
        die(json_encode($subjects));

        return view('admin.class_wise_feedback')->with('classes',$class_list);
    }
    public function faculty_wise_page(){

    }
    public function all_faculty_wise_page(){

    }
}
