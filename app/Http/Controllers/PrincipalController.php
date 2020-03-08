<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Classes;
use App\Department;
use App\Developer;
use App\Faculty;
use App\Feedback;
use App\Principal;
use App\User;
use PDF;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:principal');


    }
    public function username(){
        return 'username';
    }
    public function find_average($subjects,$phase){
        $avg=0;$temp=0;$tot=1;
        foreach ($subjects as $index=>$subject){
            $temp=Feedback::where('sa_id','=',$subject->id)->where('phase','=',$phase)->avg('sum');
            $avg+=$temp;
            $tot=$index+1;
        }
        return (int)($avg/$tot);
    }
    public function dashboard(){


        return view('principal.dashboard');
    }
    public function ajax_dashboard(Request $request){
        $datapoints1=array();$datapoints2=array();
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        $faculties=Faculty::with(['subject_allocations'=>function($query) use($active_classes) {
            $query->whereIn('class_id',$active_classes);
        }])->where('department_id','=',$request->dept_id)->get();
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
        return response()->json($obj);
    }
    public function class_wise_page(){
        $departments=Department::all();
        return view('principal.class_Wise_feedback')->with('departments',$departments);
    }
    public function faculty_wise_page(){
        $departments=Department::all();
        return view('principal.faculty_Wise_feedback')->with('departments',$departments);
    }
    public function  pdf_faculty_wise_report(Request $request)
    {
        $this->validate($request, [
            'faculty_id' => 'required',
            'dept_select'=>'required'
        ]);

        $class_obj = new Classes();
        $active_classes = $class_obj->isActive();
        //$classes=Classes::all();
       // global $classes, $students, $departments, $feedbacks;

        //$students=User::all();
        //$departments=Department::all();

        $faculties = Faculty::with(['subjects' => function ($query) use ($active_classes) {
            $query->whereIn('class_id', $active_classes);
        }])->where('id', '=', $request->faculty_id)->get();
        $dept_name=Department::where('id','=',$request->dept_select)->first();
        $faculties[0]['department_name']=$dept_name->name;
        foreach ($faculties[0]->subjects as &$f) {
            $f['class'] = Classes::where('id', '=', $f->pivot->class_id)->first();
            $dep_name = Department::where('id', '=', $f->class->department_id)->first();
            $f['class']['department_name'] = $dep_name->short;
            $student_count =User::where('class_id', '=', $f->class->id)->count();
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
        $pdf=PDF::loadView('pdf_reports.faculty_wise_pdf',['faculty_obj'=>$faculties[0],'dept'=>$dept_name])->setPaper('a4','landscape');
        return $pdf->download($dept_name->first()->short."-FACULTY_WISE.pdf");

    }
    public function ajax_class_wise(Request $request){
        $this->validate($request,[
            'class_id'=>'required'
        ]);
        //  $feedbacks=Feedback::all();
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
    public function pdf_classwise_report(Request $request){
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
        $pdf=PDF::loadView('pdf_reports.class_wise_pdf',['class_obj'=>$subjects[0]])->setPaper('a4','landscape');
        return $pdf->download("class_wise_pdf.pdf");
    }
    public function ajax_classes_dept(Request $request){
        $this->validate($request,[
            'dept'=>'required'
        ]);
        $obj=array();
        $class_obj= new Classes();
        $classes=$class_obj->isActiveLists($request->dept);
        foreach ($classes as $class){
            $obj[$class->id]=$class->name;
        }
        return response()->json($obj);
    }
    public function ajax_faculty_dept(Request $request){
        $this->validate($request,[
            'dept'=>'required'
        ]);

        $obj=array();

        $faculty=Faculty::where('department_id','=',$request->dept)->get();

        foreach ($faculty as $f){
            $obj[$f->id]=$f->name;
        }
        return response()->json($obj);

    }
    public function ajax_faculty_wise(Request $request){
        $this->validate($request,[
            'faculty_id'=>'required'
        ]);
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        //$classes=Classes::all();
       // global $classes,$students,$departments,$feedbacks;
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
public function report_generator(){
        $departments=Department::all();
        return view('principal.report_generator')->with('departments',$departments);
}
public function pdf_question_wise_report(Request $request){
        $this->validate($request,[
            'dept_select'=>'required'
        ]);
    $obj=array();
    $class_obj=new Classes();
    $active_classes=$class_obj->isActive();
    $dept=Department::where('id','=',$request->dept_select)->first();
   // global $classes,$departments,$students,$feedbacks;
    $fs=Faculty::with(['subjects'=>function($query) use($active_classes) {
        $query->whereIn('class_id',$active_classes);
    }])->where('department_id','=',$request->dept_select)->get();
    foreach ($fs as $index=>&$f){
        $obj[$index]['faculty_name']=$f->name;
        $obj[$index]['lab']['subjects']=array();
        $obj[$index]['theory']['subjects']=array();
        $theory_count=$f->subjects->where('type','=','T')->count();
        $lab_count=$f->subjects->where('type','=','L')->count();
        $obj[$index]['theory']['count']=$theory_count;
        $obj[$index]['lab']['count']=$lab_count;
        foreach ($f->subjects as $i=>&$t) {
            $t['class'] = Classes::where('id', '=', $t->pivot->class_id)->first();
            $dep_name = Department::where('id', '=', $t->class->department_id)->first();
            $t['class']['department_name'] = $dep_name->short;
            $student_count = User::where('class_id', '=', $t->class->id)->count();
            $t['class']['student_count'] = $student_count;
            $p1_avg = Feedback::where('sa_id', '=', $t->pivot->id)
                ->where('phase', '=', 1)
                ->avg('sum');
            $p1_q=array();
            $p2_q=array();
            for($g=1;$g<=10;++$g){
                $temp1=Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 1)
                    ->avg("q".$g);
                $temp2=Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 2)
                    ->avg("q".$g);
                if($temp1==null) {$temp1=0;}
                if($temp2==null) {$temp2=0;}
             $p1_q[$g]=round($temp1);
             $p2_q[$g]=round($temp2);
            }
            $t['phase1_question_wise']=$p1_q;
            $t['phase2_question_wise']=$p2_q;
            if ($p1_avg == NULL) $p1_avg = 0;
            $t['phase1_avg'] = round($p1_avg);
            $p2_avg = Feedback::where('sa_id', '=', $t->pivot->id)
                ->where('phase', '=', 2)
                ->avg('sum');
            if ($p2_avg == NULL) $p2_avg = 0;
            $t['phase2_avg'] = round($p2_avg);
            $s1_count = Feedback::where('sa_id', '=', $t->pivot->id)
                ->where('phase', '=', 1)->count();
            if ($s1_count == NULL) $s1_count = 0;
            $s2_count = Feedback::where('sa_id', '=', $t->pivot->id)
                ->where('phase', '=', 2)->count();
            if ($s2_count == NULL) $s2_count = 0;
            $t['phase1_student_count'] = $s1_count;
            $t['phase2_student_count'] = $s2_count;
            if($t->type=="T") {
                array_push($obj[$index]['theory']['subjects'],$t);
            }else{
                array_push($obj[$index]['lab']['subjects'],$t);
            }
        }
    }
    $pdf=PDF::loadView('pdf_reports.faculty_report_pdf',['faculty_obj'=>$obj,'dept'=>$dept])->setPaper('a4','landscape');
    return $pdf->download("faculty_report_".$dept->short.".pdf");
}
public function test(){

        $obj=array();
        //global $classes,$departments,$students,$feedbacks;
        $dept=Department::where('id','=',1)->first();
        $active_classes=Classes::where('isActive','=',1)
            ->where('department_id','=',1)->get();
    $index=0;
        foreach ($active_classes as &$c) {
            $obj[$index]['class_data']=$c;
            $obj[$index]['lab']['subjects']=array();
            $obj[$index]['theory']['subjects']=array();

            $students = Classes::with('students')->where('id', '=', $c->id)->get();
            $students_count = $students[0]->students->count();
            $subjects = Classes::with(['subjects', 'faculties'])->where('id', '=', $c->id)->get();
            $obj[$index]['class_data']['student_count'] = $students_count;
            $theory_count=$subjects[0]->subjects->where('type','=','T')->count();
            $lab_count=$subjects[0]->subjects->where('type','=','L')->count();
            $obj[$index]["theory"]['count']=$theory_count;
            $obj[$index]['lab']['count']=$lab_count;


            foreach ($subjects[0]->subjects as $index2 => &$t) {


                $t['faculty'] = $subjects->first()->faculties->where('id', '=', $t->pivot->faculty_id)->first();

                $p1_avg = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 1)
                    ->avg('sum');
                if ($p1_avg == NULL)  {$p1_avg = 0;}
                $t['phase1_avg'] = round($p1_avg);
                $p2_avg = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 2)
                    ->avg('sum');

                if ($p2_avg == NULL) {$p2_avg = 0;}
                $t['phase2_avg'] = round($p2_avg);
                $p1_q=array();
                $p2_q=array();
                for($g=1;$g<=10;++$g){
                    $temp1=Feedback::where('sa_id', '=', $t->pivot->id)
                        ->where('phase', '=', 1)
                        ->avg("q".$g);
                    $temp2=Feedback::where('sa_id', '=', $t->pivot->id)
                        ->where('phase', '=', 2)
                        ->avg("q".$g);
                    if($temp1==null) {$temp1=0;}
                    if($temp2==null) {$temp2=0;}
                    $p1_q[$g]=round($temp1);
                    $p2_q[$g]=round($temp2);
                }
                $t['phase1_question_wise']=$p1_q;
                $t['phase2_question_wise']=$p2_q;

                $s1_count = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 1)->count();
                if ($s1_count == NULL) $s1_count = 0;
                $s2_count = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 2)->count();
                if ($s2_count == NULL) $s2_count = 0;
                $t['phase1_student_count'] = $s1_count;
                $t['phase2_student_count'] = $s2_count;

                if($t->type=="T") {
                    array_push($obj[$index]["theory"]["subjects"],$t);
                }else{
                   array_push($obj[$index]["lab"]["subjects"],$t);
                }

            }
            ++$index;
        }





    return view('dummy')->with('class_obj',$obj);
}
    public function all_class_report_page(){
        $departments=Department::all();
        return view('principal.all_classes_report')->with('departments',$departments);
    }
    public function pdf_all_classes_report(Request $request){
        $this->validate($request,[
            'dept_select'=>'required'
        ]);
        $obj=array();
        //global $classes,$departments,$students,$feedbacks;
        $dept=Department::where('id','=',$request->dept_select)->first();
        $active_classes=Classes::where('isActive','=',1)
            ->where('department_id','=',$request->dept_select)->get();

        foreach ($active_classes as $index=>&$c) {
            $obj[$index]['class_data']=$c;
            $obj[$index]['lab']['subjects']=array();
            $obj[$index]['theory']['subjects']=array();

            $students = Classes::with('students')->where('id', '=', $c->id)->get();
            $students_count = $students[0]->students->count();
            $subjects = Classes::with(['subjects', 'faculties'])->where('id', '=', $c->id)->get();
            $obj[$index]['class_data']['student_count'] = $students_count;
            $theory_count=$subjects[0]->subjects->where('type','=','T')->count();
            $lab_count=$subjects[0]->subjects->where('type','=','L')->count();
            $obj[$index]['theory']['count']=$theory_count;
            $obj[$index]['lab']['count']=$lab_count;


            foreach ($subjects[0]->subjects as $index2 => &$t) {
                $t['faculty'] = $subjects->first()->faculties->where('id', '=', $t->pivot->faculty_id)->first();
                $p1_avg = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 1)
                    ->avg('sum');
                if ($p1_avg == NULL)  {$p1_avg = 0;}
                $t['phase1_avg'] = round($p1_avg);
                $p2_avg = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 2)
                    ->avg('sum');

                if ($p2_avg == NULL) {$p2_avg = 0;}
                $t['phase2_avg'] = round($p2_avg);
                $p1_q=array();
                $p2_q=array();
                for($g=1;$g<=10;++$g){
                    $temp1=Feedback::where('sa_id', '=', $t->pivot->id)
                        ->where('phase', '=', 1)
                        ->avg("q".$g);
                    $temp2=Feedback::where('sa_id', '=', $t->pivot->id)
                        ->where('phase', '=', 2)
                        ->avg("q".$g);
                    if($temp1==null) {$temp1=0;}
                    if($temp2==null) {$temp2=0;}
                    $p1_q[$g]=round($temp1);
                    $p2_q[$g]=round($temp2);
                }
                $t['phase1_question_wise']=$p1_q;
                $t['phase2_question_wise']=$p2_q;

                $s1_count = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 1)->count();
                if ($s1_count == NULL) $s1_count = 0;
                $s2_count = Feedback::where('sa_id', '=', $t->pivot->id)
                    ->where('phase', '=', 2)->count();
                if ($s2_count == NULL) $s2_count = 0;
                $t['phase1_student_count'] = $s1_count;
                $t['phase2_student_count'] = $s2_count;
                if($t->type=="T") {
                    array_push($obj[$index]['theory']['subjects'],$t);
                }else{
                    array_push($obj[$index]['lab']['subjects'],$t);
                }

            }
        }
        $pdf=PDF::loadView('pdf_reports.all_classes_pdf',['class_obj'=>$obj,'dept'=>$dept])->setPaper('a4','landscape');
        return $pdf->download($dept->short.".pdf");

    }
}
