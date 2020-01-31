<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Department;
use App\Faculty;
use App\Feedback;
use App\Subject;
use App\Subject_Alloc;
use App\User;
use Illuminate\Http\Request;
use PDF;


class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:faculty');
        global $feedbacks,$classes,$students,$departments;
        $feedbacks=Feedback::all();
        $classes=Classes::all();
        $students=User::all();
        $departments=Department::all();
    }
    public function username(){
        return 'employee_number';
    }
    public function dashboard(){
        return view('faculty.dashboard');
    }
    public function feedback_report(){
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        $faculties=Faculty::with(['subjects'=>function($query) use($active_classes) {
            $query->whereIn('class_id',$active_classes);
        }])->where('employee_number','=',auth()->user()->employee_number)->get();
        $obj=array();
        foreach ($faculties[0]->subjects as $index=>$subject){
            $obj[$index]["sa_id"]=$subject->pivot->id;
            $obj[$index]["name"]=$subject->name;
        }
        return view('faculty.feedback_report')->with('subjects',$obj);
    }
    public function ajax_subject_report(Request $request){
        $this->validate($request,[
            'sa_id'=>'required'
        ]);
        global $feedbacks;
        $sa=Subject_Alloc::where('id','=',$request->sa_id)->first();
        $subject_type=Subject::where('id','=',$sa->subject_id)->first();
        if($subject_type->type=="T"){
            $questions=[env("Q1","Set the questions in .env file"),
                env("Q2","Set the questions in .env file"),
                env("Q3","Set the questions in .env file"),
                env("Q4","Set the questions in .env file"),
                env("Q5","Set the questions in .env file"),
                env("Q6","Set the questions in .env file"),
                env("Q7","Set the questions in .env file"),
                env("Q8","Set the questions in .env file"),
                env("Q9","Set the questions in .env file"),
                env("Q10","Set the questions in .env file")];
        }else if($subject_type->type=="L"){
            $questions=[env("Q1_lab","Set the questions in .env file"),
                env("Q2_lab","Set the questions in .env file"),
                env("Q3_lab","Set the questions in .env file"),
                env("Q4_lab","Set the questions in .env file"),
                env("Q5_lab","Set the questions in .env file"),
                env("Q6_lab","Set the questions in .env file"),
                env("Q7_lab","Set the questions in .env file"),
                env("Q8_lab","Set the questions in .env file"),
                env("Q9_lab","Set the questions in .env file"),
                env("Q10_lab","Set the questions in .env file")];
        }
        $students_count=User::where('class_id','=',$sa->class_id)->count();
        $output="<hr style='border-top: dotted 1px;' />
<table style='margin-left: 17%;width: 80%'>
<tr>
<td width: 50%><h3 style='font-family: Arial'><b>SUBJECT NAME : <span style='color: #337ab7'>".$subject_type->name."</span></b></h3></td>
</tr>
</table>
 <hr style='border-top: dotted 1px;' />
 <br/>
 ";
        $output.="
         <table id='class_wise' class='table table-bordered'>
        <tr class='primary'>
            <th class='text-capitalize text-dark info'>S.NO </th>
           <th class='text-capitalize text-dark info'>  QUESTION </th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE I</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>STUDENT COUNT</th>
           <th class='text-capitalize text-dark info' style='text-align: center'>PHASE II</th>
           <th class='text-capitalize text-dark info'>AVG</th>
        </tr>
        ";
        for($i=1;$i<=10;++$i) {
            $p1 = $feedbacks->where('sa_id', '=',$request->sa_id)
                ->where('phase', '=', 1)
                ->avg('q'.$i);
            $c1=$feedbacks->where('sa_id', '=',$request->sa_id )
                ->where('phase', '=', 1)
                ->count();
            $c2=$feedbacks->where('sa_id', '=',$request->sa_id)
                ->where('phase', '=', 2)
                ->count();
            $p2 = $feedbacks->where('sa_id', '=',$request->sa_id)
                ->where('phase', '=', 2)
                ->avg('q'.$i);
            $output.="<tr>";
            $output.="<td>".($i)."</td>";
            $output.="<td>".$questions[($i-1)]."</td>";
            $output.="<td>".$c1."/".$students_count."</td>";
            $number1=(($p1)*10);
            $output.="<td>".number_format($number1, 2, '.', '')."%</td>";
            $output.="<td>".$c2."/".$students_count."</td>";
            $number2=(($p2)*10);
            $output.="<td>".number_format($number2, 2, '.', '')."</td>";
            $avg=(($number1+$number2)/2);
            $output.="<td>".number_format($avg, 2, '.', '')."%</td>";
            $output.="</tr>";

        }
        echo $output;

    }
    public function pdf_faculty_report(Request $request){
            $this->validate($request,[
                'sa_id'=>'required'
            ]);
        global $feedbacks;$obj=array();
        $dept=Department::where('id','=',auth()->user()->department_id)->first();
        $obj[0]['dept_name']=$dept->name;
        $obj[0]['name']=auth()->user()->name;
        $sa=Subject_Alloc::where('id','=',$request->sa_id)->first();
        $subject_type=Subject::where('id','=',$sa->subject_id)->first();
        $obj[0]['subject_name']=$subject_type->name;
        if($subject_type->type=="T"){
            $questions=[env("Q1","Set the questions in .env file"),
                env("Q2","Set the questions in .env file"),
                env("Q3","Set the questions in .env file"),
                env("Q4","Set the questions in .env file"),
                env("Q5","Set the questions in .env file"),
                env("Q6","Set the questions in .env file"),
                env("Q7","Set the questions in .env file"),
                env("Q8","Set the questions in .env file"),
                env("Q9","Set the questions in .env file"),
                env("Q10","Set the questions in .env file")];
        }else if($subject_type->type=="L"){
            $questions=[env("Q1_lab","Set the questions in .env file"),
                env("Q2_lab","Set the questions in .env file"),
                env("Q3_lab","Set the questions in .env file"),
                env("Q4_lab","Set the questions in .env file"),
                env("Q5_lab","Set the questions in .env file"),
                env("Q6_lab","Set the questions in .env file"),
                env("Q7_lab","Set the questions in .env file"),
                env("Q8_lab","Set the questions in .env file"),
                env("Q9_lab","Set the questions in .env file"),
                env("Q10_lab","Set the questions in .env file")];
        }
        $students_count=User::where('class_id','=',$sa->class_id)->count();
        $c1 = $feedbacks->where('sa_id', '=', $request->sa_id)
            ->where('phase', '=', 1)
            ->count();
        $c2 = $feedbacks->where('sa_id', '=', $request->sa_id)
            ->where('phase', '=', 2)
            ->count();
        $obj[0]['student_count']=$students_count;
        $obj[0]['st_count1']=$c1;
        $obj[0]['st_count2']=$c2;
        for($i=1;$i<=10;++$i) {
            $p1 = $feedbacks->where('sa_id', '=', $request->sa_id)
                ->where('phase', '=', 1)
                ->avg('q' . $i);

            $p2 = $feedbacks->where('sa_id', '=', $request->sa_id)
                ->where('phase', '=', 2)
                ->avg('q' . $i);
            $obj[$i]['question']=$questions[($i-1)];
            $obj[$i]['phase1']=number_format(($p1*10), 2, '.', '');
            $obj[$i]['phase2']=number_format(($p2*10), 2, '.', '');
            $obj[$i]['avg']=(($obj[$i]['phase1']+$obj[$i]['phase2'])/2);
        }
        $pdf=PDF::loadView('pdf_reports.faculty_report_pdf',['obj'=>$obj,'dept'=>$dept])->setPaper('a4','portrait');
        return $pdf->download();
    }

    public function ajax_dashboard(Request $request){
        $datapoints2=array();$datapoints1=array();$obj=array();
        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        global $feedbacks;
        $faculties=Faculty::with(['subject_allocations'=>function($query) use($active_classes) {
            $query->whereIn('class_id',$active_classes);
        }])->where('id','=',auth()->user()->id)->get();
        foreach ($faculties[0]->subject_allocations as &$f){
            $subject_name=Subject::where('id','=',$f->subject_id)->first();
            $avg1=$feedbacks->where('sa_id','=',$f->id)
                ->where('phase','=',1)
                ->avg('sum');
            $avg2=$feedbacks->where('sa_id','=',$f->id)
                ->where('phase','=',2)
                ->avg('sum');
            if($avg1==null) $avg1=0;
            if($avg2==null) $avg2=0;
            $t1=array(
                'y'=>$avg1,
                'label'=>$subject_name->name

            );
            $t2=array(
                'y'=>$avg2,
                'label'=>$subject_name->name
            );
            array_push($datapoints1,$t1);
            array_push($datapoints2,$t2);
        }
        $obj['one']=$datapoints1;
        $obj['two']=$datapoints2;
        return response()->json($obj);
    }
}
