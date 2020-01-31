<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Department;
use App\Faculty;
use App\Feedback;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Subject_Alloc;
use PDF;

class HodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hod');
        //global $feedbacks,$classes,$students,$departments;

         /*$feedbacks=Feedback::all();
        $classes=Classes::all();
        $students=User::all();
        $departments=Department::all();*/
    }
    public function pdf(){
        $check="Hello Its working";
        $pdf=PDF::loadView('dummy',['check'=>$check])->setPaper('a4','portrait');
        return $pdf->stream();
    }
    public function username(){
        return 'name';
    }
    public function find_average($subjects,$phase){
        $avg=0;$temp=0;$count=0;
       // $f=Feedback::all();
        foreach ($subjects as $index=>$subject){
        $temp=Feedback::where('sa_id','=',$subject->id)->where('phase','=',$phase)->avg('sum');
        $avg+=$temp;
        $count=$index+1;
        }if($count==0) return 0;
        return (int)($avg/$count);
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function ajax_dashboard(Request $request){
        $datapoints1=array();$datapoints2=array();
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        $faculties=Faculty::with(['subject_allocations'=>function($query) use($active_classes) {
            $query->whereIn('class_id',$active_classes);
        }])->where('department_id','=',auth()->user()->dept_id)->get();
        //die(json_encode($faculties));
        foreach($faculties as $faculty){
            $t1=array(
                'y'=>$this->find_average($faculty->subject_allocations,1),
                    'label'=>$faculty->name
        );
            $t2=array(
                'y'=>$this->find_average($faculty->subject_allocations,2),
                'label'=>$faculty->name
            );
            array_push($datapoints1,$t1);
            array_push($datapoints2,$t2);


    }
$obj=array();
$obj['one']=$datapoints1;
$obj['two']=$datapoints2;
$department_name=Department::where('id','=',auth()->user()->dept_id)->first();
$obj['dept_name']=$department_name->short;

return response()->json($obj);

}
    public function show_old_faculty_wise(){
        $faculties=Faculty::where('department_id','=',auth()->user()->dept_id)->get();
        return view('admin.old_faculty_wise')->with('faculties',$faculties);
    }
    public function ajax_class_wise(Request $request){
       $this->validate($request,[
            'class_id'=>'required'
        ]);
        //global $feedbacks;
        $students=Classes::with('students')->where('id','=',$request->class_id)->get();
        $students_count=$students[0]->students->count();
        $subjects=Classes::with(['subjects','faculties'])->where('id','=',$request->class_id)->get();
        $subjects[0]['student_count']=$students_count;
        $department_name=Department::where('id','=',$subjects->first()->department_id)->get();

        $subjects[0]['department_name']=$department_name->first()->name;
        $subjects[0]['deaprtment_short_name']=$department_name->first()->short;
        foreach($subjects[0]->subjects as $index=>&$t) {
            //$t['faculty'] = $subjects[0]->faculties[$index]->name;
            $t['faculty']=$subjects->first()->faculties->where('id','=',$t->pivot->faculty_id)->first();

            $p1_avg=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',1)
                ->avg('sum');
            if($p1_avg==NULL) $p1_avg=0;
            $t['phase1_avg']=round($p1_avg);

            $p2_avg=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)
                ->avg('sum');
            if($p2_avg==NULL) $p2_avg=0;
            $t['phase2_avg']=round($p2_avg);

            $s1_count=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',1)->count();
            if($s1_count==NULL) $s1_count=0;
            $s2_count=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)->count();
            if($s2_count==NULL) $s2_count=0;
            $t['phase1_student_count']=$s1_count;
            $t['phase2_student_count']=$s2_count;



        }
        $output="<hr style='border-top: dotted 1px;' />
<table style='margin-left: 17%;width: 80%'>
<tr>
<td width: 50%><h3 style='font-family: Arial'><b>CLASS NAME : <span style='color: #337ab7'>".$subjects->first()->name."</span></b></h3></td>
<td width: 50%><h3  style='font-family: Arial'><b> BATCH : <span style='color: #337ab7'>".$subjects->first()->batch."</span></b></h3></td></tr>
<tr>
 <td style='width: 40%'><h3  style='font-family: Arial'><b>SEMESTER : <span style='color: #337ab7'>".$subjects->first()->sem."</span></b></h3></td>
 <td width: 50%><h3 style='font-family: Arial'><b>DEPARTMENT NAME : <span style='color: #337ab7'>".$subjects->first()->department_name."</span></b></h3></td>

 </tr></table>
 <hr style='border-top: dotted 1px;' />
 <br/>
 ";
        $output.="
         <table id='class_wise' class='table table-bordered'>
        <tr class='primary'>
            <th class='text-capitalize text-dark info'>S.NO </th>
           <th class='text-capitalize text-dark info'>SUBJECT NAME </th>
           <th class='text-capitalize text-dark info'>FACULTY NAME</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE I</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE II</th>
           <th class='text-capitalize text-dark info'>AVG</th>
        </tr>
        ";
        foreach ($subjects[0]->subjects as $index=>$subject){
            $output.="<tr>";
            $output.="<td>".($index+1)."</td>";
            $output.="<td>".$subject->name."</td>";
            $output.="<td>".$subject->faculty->name."</td>";
            $output.="<td style='text-align: center'>".$subject->phase1_student_count." / ".$subjects->first()->student_count."</td>";
            $output.="<td style='text-align: center'>".$subject->phase1_avg."% </td>";
            $output.="<td style='text-align: center'>".$subject->phase2_student_count." / ".$subjects->first()->student_count."</td>";
            $output.="<td style='text-align: center'>".$subject->phase2_avg."% </td>";
            $output.="<td>".(($subject->phase1_avg + $subject->phase2_avg)/2)."% </td>";
            $output.="</tr>";
        }
        echo $output;


    }
    public function ajax_old_faculty_wise(Request $request)
    {
        $this->validate($request,[
            'faculty_id'=>'required'
        ]);

        //$classes=Classes::all();
        //global $classes,$students,$departments,$feedbacks;
        //$students=User::all();
        //$departments=Department::all();

        $faculties=Faculty::with(['subjects'])->where('id','=',$request->faculty_id)->get();
        foreach ($faculties[0]->subjects as &$f ){
            $f['class']=Classes::where('id','=',$f->pivot->class_id)->first();
            $dep_name=Department::where('id','=',$f->class->department_id)->first();
            $f['class']['department_name']=$dep_name->short;
            $student_count=User::where('class_id','=',$f->class->id)->count();
            $f['class']['student_count']=$student_count;

            $p1_avg=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',1)
                ->avg('sum');
            if($p1_avg==NULL) $p1_avg=0;
            $f['phase1_avg']=round($p1_avg);

            $p2_avg=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',2)
                ->avg('sum');
            if($p2_avg==NULL) $p2_avg=0;
            $f['phase2_avg']=round($p2_avg);

            $s1_count=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',1)->count();
            if($s1_count==NULL) $s1_count=0;
            $s2_count=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',2)->count();
            if($s2_count==NULL) $s2_count=0;
            $f['phase1_student_count']=$s1_count;
            $f['phase2_student_count']=$s2_count;

        }

        $output="<hr style='border-top: dotted 1px;' />
<table style='margin-left: 17%;width: 80%'>
<tr>
<td width: 50%><h3 style='font-family: Arial'><b>FACULTY NAME : <span style='color: #337ab7'>".$faculties->first()->name."</span></b></h3></td>
</tr>
</table>
 <hr style='border-top: dotted 1px;' />
 <br/>
 ";
        $output.="
         <table id='class_wise' class='table table-bordered'>
        <tr class='primary'>
            <th class='text-capitalize text-dark info'>S.NO </th>
           <th class='text-capitalize text-dark info'>DEPARTMENT </th>
           <th class='text-capitalize text-dark info'>CLASS NAME</th>
                      <th class='text-capitalize text-dark info' style='text-align: center'>BACTH</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>SEMESTER</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>SUBJECT NAME</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE I</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE II</th>
           <th class='text-capitalize text-dark info'>AVG</th>
        </tr>
        ";
        foreach ($faculties[0]->subjects as $index=>$subject){
            $output.="<tr>";
            $output.="<td>".($index+1)."</td>";
            $output.="<td>".$subject->class->department_name."</td>";
            $output.="<td>".$subject->class->name."</td>";
            $output.="<td>".$subject->class->batch."</td>";
            $output.="<td>".$subject->class->sem."</td>";
            $output.="<td>".$subject->name."</td>";
            $output.="<td style='text-align: center'>".$subject->phase1_student_count." / ".$subject->class->student_count."</td>";
            $output.="<td style='text-align: center'>".$subject->phase1_avg."% </td>";
            $output.="<td style='text-align: center'>".$subject->phase2_student_count." / ".$subject->class->student_count."</td>";
            $output.="<td style='text-align: center'>".$subject->phase2_avg."% </td>";
            $output.="<td>".(($subject->phase1_avg + $subject->phase2_avg)/2)."% </td>";
            $output.="</tr>";
        }
        echo $output;

    }
        public function ajax_faculty_wise(Request $request){
    $this->validate($request,[
        'faculty_id'=>'required'
    ]);
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        //$classes=Classes::all();
        //global $classes,$students,$departments,$feedbacks;
        //$students=User::all();
        //$departments=Department::all();

        $faculties=Faculty::with(['subjects'=>function($query) use($active_classes) {
            $query->whereIn('class_id',$active_classes);
        }])->where('id','=',$request->faculty_id)->get();

        foreach ($faculties[0]->subjects as &$f ){
            $f['class']=Classes::where('id','=',$f->pivot->class_id)->first();
            $dep_name=Department::where('id','=',$f->class->department_id)->first();
            $f['class']['department_name']=$dep_name->short;
            $student_count=User::where('class_id','=',$f->class->id)->count();
            $f['class']['student_count']=$student_count;

            $p1_avg=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',1)
                ->avg('sum');
            if($p1_avg==NULL) $p1_avg=0;
            $f['phase1_avg']=round($p1_avg);

            $p2_avg=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',2)
                ->avg('sum');
            if($p2_avg==NULL) $p2_avg=0;
            $f['phase2_avg']=round($p2_avg);

            $s1_count=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',1)->count();
            if($s1_count==NULL) $s1_count=0;
            $s2_count=Feedback::where('sa_id','=',$f->pivot->id)
                ->where('phase','=',2)->count();
            if($s2_count==NULL) $s2_count=0;
            $f['phase1_student_count']=$s1_count;
            $f['phase2_student_count']=$s2_count;

        }

        $output="<hr style='border-top: dotted 1px;' />
<table style='margin-left: 17%;width: 80%'>
<tr>
<td width: 50%><h3 style='font-family: Arial'><b>FACULTY NAME : <span style='color: #337ab7'>".$faculties->first()->name."</span></b></h3></td>
</tr>
</table>
 <hr style='border-top: dotted 1px;' />
 <br/>
 ";
        $output.="
         <table id='class_wise' class='table table-bordered'>
        <tr class='primary'>
            <th class='text-capitalize text-dark info'>S.NO </th>
           <th class='text-capitalize text-dark info'>DEPARTMENT </th>
           <th class='text-capitalize text-dark info'>CLASS NAME</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>SEMESTER</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>SUBJECT NAME</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE I</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE II</th>
           <th class='text-capitalize text-dark info'>AVG</th>
        </tr>
        ";
        foreach ($faculties[0]->subjects as $index=>$subject){
            $output.="<tr>";
            $output.="<td>".($index+1)."</td>";
            $output.="<td>".$subject->class->department_name."</td>";
            $output.="<td>".$subject->class->name."</td>";
            $output.="<td>".$subject->class->sem."</td>";
            $output.="<td>".$subject->name."</td>";
            $output.="<td style='text-align: center'>".$subject->phase1_student_count." / ".$subject->class->student_count."</td>";
            $output.="<td style='text-align: center'>".$subject->phase1_avg."% </td>";
            $output.="<td style='text-align: center'>".$subject->phase2_student_count." / ".$subject->class->student_count."</td>";
            $output.="<td style='text-align: center'>".$subject->phase2_avg."% </td>";
            $output.="<td>".(($subject->phase1_avg + $subject->phase2_avg)/2)."% </td>";
            $output.="</tr>";
        }
        echo $output;


    }
    public function all_faculty_wise(){

    }
    public function class_wise_page(){
       $class_obj=new Classes();
        $class_list=$class_obj->isActiveLists(auth()->user()->dept_id);
        return view('admin.class_wise_feedback')->with('classes',$class_list);
    }
    public function faculty_wise_page(){
        $faculties=Faculty::where('department_id','=',auth()->user()->dept_id)->get();
        return view('admin.faculty_wise_feedback')->with('faculties',$faculties);

    }
    public function all_faculty_wise_page(){
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        //$classes=Classes::all();
        //$students=User::all();
        //$departments=Department::all();
        //global $classes,$students,$departments,$feedbacks;
        $all_faculty=Faculty::where('department_id','=',auth()->user()->dept_id)->get('id');
        foreach ($all_faculty as $index=>$af) {
            $faculties[$index] = Faculty::with(['subjects' => function ($query) use ($active_classes) {
                $query->whereIn('class_id', $active_classes);
            }])->where('id', '=', $af->id)->get();
            $faculties[$index][0]['subject_count']=$faculties[$index][0]->subjects->count();
            foreach ($faculties[$index][0]->subjects as &$f) {
                $f['class'] = Classes::where('id', '=', $f->pivot->class_id)->first();
                $dep_name = Department::where('id', '=', $f->class->department_id)->first();
                $f['class']['department_name'] = $dep_name->short;
                $student_count = User::where('class_id', '=', $f->class->id)->count();
                $f['class']['student_count'] = $student_count;

                $p1_avg = Feedback::where('sa_id', '=', $f->pivot->id)
                    ->where('phase', '=', 1)
                    ->avg('sum');
                if ($p1_avg == NULL) $p1_avg = 0;
                $f['phase1_avg'] = $p1_avg;

                $p2_avg = Feedback::where('sa_id', '=', $f->pivot->id)
                    ->where('phase', '=', 2)
                    ->avg('sum');
                if ($p2_avg == NULL) $p2_avg = 0;
                $f['phase2_avg'] = $p2_avg;

                $s1_count = Feedback::where('sa_id', '=', $f->pivot->id)
                    ->where('phase', '=', 1)->count();
                if ($s1_count == NULL) $s1_count = 0;
                $s2_count =Feedback::where('sa_id', '=', $f->pivot->id)
                    ->where('phase', '=', 2)->count();
                if ($s2_count == NULL) $s2_count = 0;
                $f['phase1_student_count'] = $s1_count;
                $f['phase2_student_count'] = $s2_count;

            }
        }
        //die(json_encode($faculties));
        return view('admin.all_faculty_wise_report')->with('faculties',$faculties);


    }
    public function student_status(){
        $class_obj=new Classes();
        $class_list=$class_obj->isActiveLists(auth()->user()->dept_id);
        return view('admin.display_student')->with('classes',$class_list);
    }
    public function student_status_live(Request $request){
        $this->validate($request,[
            'class_id'=>'required'
        ]);
       // global $feedbacks;
        $students=Classes::with('students','subjects')
                    ->where('id','=',$request->class_id)
                    ->get();
        $subject_count=$students->first()->subjects->count();
        /*$output="<table class='table table-responsive table-bordered table-striped table-hover' style='margin:15px;'>
            <tr class='primary' >
            <th class='text-capitalize text-dark info'>S.NO </th>
            <th class='text-capitalize text-dark info'>Registration NO.</th>
            <th class='text-capitalize text-dark info'>Name</th>
            <th class='text-capitalize text-dark info' >PHASE I COUNT</th>
            <th class='text-capitalize text-dark info' >PHASE I</th>
            <th class='text-capitalize text-dark info' >PHASE II COUNT</th>
            <th class='text-capitalize text-dark info' >PHASE II</th>
            </tr>";*/
        //print selected class_name
        foreach ($students->first()->students as $index=>$student) {
            $student['student_feedback_phase1_count'] = Feedback::where('student_id', '=', $student->id)
                ->where('phase', '=', 1)->count();
            $student['student_feedback_phase2_count'] = Feedback::where('student_id', '=', $student->id)
                ->where('phase', '=', 2)->count();
            if ($subject_count == $student->student_feedback_phase1_count) {
                $student['phase1_flag'] = "green";
            } else {
                $student['phase1_flag'] = "red";
            }
            if ($subject_count == $student->student_feedback_phase2_count) {
                $student['phase2_flag'] = "green";
            } else {
                $student['phase2_flag'] = "red";
            }
        }
/*
            $output.="<tr>";
            $output.="<td>".($index+1)."</td>";
            $output.="<td>".$student->student_reg."</td>";
            $output.="<td>".$student->name."</td>";
            $output.="<td style='text-align: center'>".$student_feedback_phase1_count."/".$subject_count."</td>";
            if($student->phase1_flag=="green"){
            $output.="<td style='background-color:#4CAF50'></td>";
            }else{
                $output.="<td style='background-color:#FF9999'></td>";
            }
            $output.="<td style='text-align: center'>".$student_feedback_phase2_count."/".$subject_count."</td>";
            if($student->phase2_flag=="green"){
                $output.="<td style='background-color:#4CAF50'></td>";
            }else{
                $output.="<td style='background-color:#FF9999'></td>";
            }

            $output.="</tr>";

        }*/
       // $output.="</table>";
        return redirect()->back()->with('students',$students)->with('subject_count',$subject_count);
    }
    public function scheduler(Request $request){
        $this->validate($request,[
            'class_id'=>'required'
        ]);
        Session::forget('success','error');
        $subjects=Subject::all();
        $faculties=Faculty::all();
        $time_table_data=Classes::with(['subjects','faculties'])->where('id','=',$request->class_id)->get();
        foreach($time_table_data[0]->subjects as $index=>&$t){
            //$t['faculty_name']=$time_table_data[0]->faculties[$index]->name;
            $t['faculty']=$time_table_data[0]->faculties->where('id','=',$t->pivot->faculty_id)->first();
        }
        $class_obj=new Classes();
        $class_list=$class_obj->isActiveLists(auth()->user()->dept_id);
        Session::put('prev_class_id',$request->class_id);
        return view('admin.Show_Time_Table')->with('classes',$class_list)
                                        ->with('time_table',$time_table_data[0])
                                        ->with('faculties',$faculties)
                                        ->with('subjects',$subjects);
    }
    public function show_time_table_page(){
        $class_obj=new Classes();
        $subjects=Subject::all();
        $faculties=Faculty::all();
        $class_list=$class_obj->isActiveLists(auth()->user()->dept_id);
        return view('admin.Show_Time_Table')->with('classes',$class_list)
                                                ->with('faculties',$faculties)
                                                ->with('subjects',$subjects);
    }
    public function delete_subject_alloc(Request $request){
        $this->validate($request,[
            'subj_alloc_id'=>'required'
        ]);
        $subj_alloc_obj=Subject_Alloc::find($request->subj_alloc_id);
        if($subj_alloc_obj->delete()){
            Session::flash('success','Deleted Successfully');
        }else{
            Session::flash('error','Unable to Delete!!');
        }
        return redirect()->action('HodController@time_table_initialize',Session::get('prev_class_id'));

    }
    public function add_subject_alloc(Request $request){
        $this->validate($request,[
            'subject_id'=>'required',
            'faculty_id'=>'required',
            'selected_class_id'=>'required'
        ]);
        $duplicate=Subject_Alloc::where('class_id','=',$request->selected_class_id)
                                    ->where('faculty_id','=',$request->faculty_id)
                                    ->where('subject_id','=',$request->subject_id)->count();

        if($duplicate==0) {
            $obj = new Subject_Alloc();
            $obj->class_id = $request->selected_class_id;
            $obj->faculty_id = $request->faculty_id;
            $obj->subject_id = $request->subject_id;
            if ($obj->save()) {
                Session::flash('success', 'New Record Added Successfully');
            } else {
                Session::flash('Error', 'Error in Adding');
            }
        }else{
            Session::flash('Error','Record Already Found!!');
        }
        return redirect()->action('HodController@time_table_initialize',$request->selected_class_id);


    }
    public function edit_subject_alloc(Request $request)
    {
        $this->validate($request, [
            'faculty_name' => 'required',
            'subject_name' => 'required',
            'subj_alloc_id'=>'required'
        ]);
        $faculty = Faculty::find($request->faculty_name);
        $subject = Subject::find($request->subject_name);
        $subj_alloc=Subject_Alloc::find($request->subj_alloc_id);
        $subj_alloc->faculty_id=$faculty->id;
        $subj_alloc->subject_id=$subject->id;

        if ($subj_alloc->save()) {
                Session::flash('success', 'Edited Successfully');
            }
        else{
            Session::flash('error', 'Unable to Edit!!');
        }

     return redirect()->action('HodController@time_table_initialize',Session::get('prev_class_id'));


    }
    public function  time_table_initialize($class_id){
        $subjects=Subject::all();
        $faculties=Faculty::all();
        $time_table_data=Classes::with(['subjects','faculties'])->where('id','=',$class_id)->get();
        foreach($time_table_data[0]->subjects as $index=>&$t){
            //$t['faculty_name']=$time_table_data[0]->faculties[$index]->name;
            $t['faculty']=$time_table_data[0]->faculties->where('id','=',$t->pivot->faculty_id)->first();
        }
        $class_obj=new Classes();
        $class_list=$class_obj->isActiveLists(auth()->user()->dept_id);
        return view('admin.Show_Time_Table')->with('classes',$class_list)
            ->with('time_table',$time_table_data[0])
            ->with('faculties',$faculties)
            ->with('subjects',$subjects);
    }
    public function pdf_classwise_report(Request $request){
        $this->validate($request,[
            'class_id'=>'required'
        ]);

       // global $feedbacks,$classes;
        $c_pdf_name=Classes::where('id',$request->class_id)->first();
        $students=Classes::with('students')->where('id','=',$request->class_id)->get();
        $students_count=$students[0]->students->count();
        $subjects=Classes::with(['subjects','faculties'])->where('id','=',$request->class_id)->get();
        $subjects[0]['student_count']=$students_count;
        $department_name=Department::where('id','=',$subjects->first()->department_id)->get();
        $subjects[0]['department_name']=$department_name->first()->name;
        $subjects[0]['deaprtment_short_name']=$department_name->first()->short;
        foreach($subjects[0]->subjects as $index=>&$t) {
            //$t['faculty'] = $subjects[0]->faculties[$index]->name;
            $t['faculty']=$subjects->first()->faculties->where('id','=',$t->pivot->faculty_id)->first();

            $p1_avg=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',1)
                ->avg('sum');
            if($p1_avg==NULL) $p1_avg=0;
            $t['phase1_avg']=round($p1_avg);

            $p2_avg=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)
                ->avg('sum');
            if($p2_avg==NULL) $p2_avg=0;
            $t['phase2_avg']=round($p2_avg);

            $s1_count=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',1)->count();
            if($s1_count==NULL) $s1_count=0;
            $s2_count=Feedback::where('sa_id','=',$t->pivot->id)
                ->where('phase','=',2)->count();
            if($s2_count==NULL) $s2_count=0;
            $t['phase1_student_count']=$s1_count;
            $t['phase2_student_count']=$s2_count;



        }
        $pdf=PDF::loadView('pdf_reports.class_wise_pdf',['class_obj'=>$subjects[0]])->setPaper('a4','portrait');
        return $pdf->download($c_pdf_name->name.".pdf");
    }
    public function  pdf_faculty_wise_report(Request $request)
    {
        $this->validate($request, [
            'faculty_id' => 'required'
        ]);
        $dept=Department::where('id','=',auth()->user()->dept_id)->first();
        $class_obj = new Classes();
        $active_classes = $class_obj->isActive();
        //$classes=Classes::all();
        //global $classes, $students, $departments, $feedbacks;
        $f_name=Faculty::where('id',$request->faculty_id)->first();
        //$students=User::all();
        //$departments=Department::all();

        $faculties = Faculty::with(['subjects' => function ($query) use ($active_classes) {
            $query->whereIn('class_id', $active_classes);
        }])->where('id', '=', $request->faculty_id)->get();
        $faculties[0]['department_name']=auth()->user()->department->name;
        foreach ($faculties[0]->subjects as &$f) {
            $f['class'] = Classes::where('id', '=', $f->pivot->class_id)->first();
            $dep_name = Department::where('id', '=', $f->class->department_id)->first();
            $f['class']['department_name'] = $dep_name->short;
            $student_count = User::where('class_id', '=', $f->class->id)->count();
            $f['class']['student_count'] = $student_count;

            $p1_avg = Feedback::where('sa_id', '=', $f->pivot->id)
                ->where('phase', '=', 1)
                ->avg('sum');
            if ($p1_avg == NULL) $p1_avg = 0;
            $f['phase1_avg'] = round($p1_avg);

            $p2_avg = Feedback::where('sa_id', '=', $f->pivot->id)
                ->where('phase', '=', 2)
                ->avg('sum');
            if ($p2_avg == NULL) $p2_avg = 0;
            $f['phase2_avg'] = round($p2_avg);

            $s1_count = Feedback::where('sa_id', '=', $f->pivot->id)
                ->where('phase', '=', 1)->count();
            if ($s1_count == NULL) $s1_count = 0;
            $s2_count = Feedback::where('sa_id', '=', $f->pivot->id)
                ->where('phase', '=', 2)->count();
            if ($s2_count == NULL) $s2_count = 0;
            $f['phase1_student_count'] = $s1_count;
            $f['phase2_student_count'] = $s2_count;

        }
        $pdf=PDF::loadView('pdf_reports.faculty_wise_pdf',['faculty_obj'=>$faculties[0],'dept'=>$dept])->setPaper('a4','portrait');
        return $pdf->download($f_name->name.".pdf");

    }
    public function show_old_class_wise(){
        $batches=Classes::select('batch')->distinct()->get();
        return view('admin.old_class_wise')->with('batches',$batches);
    }
    public function class_batch(Request $request){
        $this->validate($request,[
            'batch'=>'required'
        ]);
        $classes=Classes::select('id','name')->where('batch','=',$request->batch)->where('department_id',auth()->user()->dept_id)->get();
        $obj=array();
        foreach ($classes as $class){
            $obj[$class->id]=$class->name;
        }
        return response()->json($obj);

    }
}
