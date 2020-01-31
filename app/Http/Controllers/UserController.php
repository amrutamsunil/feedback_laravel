<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Faculty;
use App\Feedback;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        Session::put('phase',$phase);
        $subjects=Classes::with(['subjects','faculties'])->where('id','=',auth()->user()->class_id)->get();
        $student=User::with('feedbacks')->where('id','=',auth()->user()->id)->get();
        foreach($subjects[0]->subjects as $index=>&$t){
            $t['faculty_name']=$subjects[0]->faculties[$index]->name;
            //$t['faculty_name']=$subjects[0]->faculties->where('id','=',$t->pivot->faculty_id)->first('name'); Better Approach
            if($this->check_feedback_submit($t->pivot->id,$student[0]->feedbacks,$phase)){
                $t['flag']="Green";
            }else{
                $t['flag']="Red";
            }

        }
        return view('user.feedback')->with('feedback_obj',$subjects[0]);
    }
    public function feedback_form(Request $request){
        $output="<link rel='stylesheet' href=".asset('css/font-awesome.min.css').">
<link href=".asset('css/star-rating.css')." media='all' rel='stylesheet' type='text/css'/>
<script src=".asset('js/star-rating.js')." type='text/javascript'></script>
<link href=".asset('css/bootstrap.min.css')." rel='stylesheet'>
<link href=".asset('vendor/css/nav.css')." rel='stylesheet'>


<style>
    .rectangle {
            height: 30px;
        width: 70px;
        background-color: #00FA9A;
    }
    .rect {
            height: 30px;
        width: 70px;
        background-color: #FF9999;
    }
</style>";
        if($request->subject_type=="T"){
        $output.="
        <input name='sa_id' type='hidden' value='$request->sa_id'>
       <table class='table table-bordered' width='100%'>
        <thead>
        <tr class='primary'>
            <th style='padding-left: 1%; font-size:  17px ;background-color: #d9edf7'>S.NO</th>
            <th style='padding-left: 10%; font-size: 17px ;background-color: #d9edf7'>QUESTION</th>
            <th style='padding-left: 10%; font-size: 17px ;background-color: #d9edf7'>RATING</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width='5%'>1</td>
            <td width='55%'>
               <!--Does the Faculty come prepared on lessons?-->
               {{config('question.Q1')}}
               
            </td>
            <td width='45%'>
                <input name='q1' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                      id='abc' required title=''>
            </td>

        </tr>
        <tr>
            <td >2</td>
            <td>
                    <!--Does the Faculty present the lessons clearly and orderly?-->
                    {{config('question.Q2')}}
                </td>
            <td>
                <input name='q2' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>3</td>
            <td>
                <!--Does the Faculty speak with the voice clarity and good language ?-->
                {{config('question.Q3')}}
            </td>
            <td>
                <input name='q3' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>4</td>
            <td>
                    <!--Does the Faculty keep the class under discipline and control?-->
                    {{config('question.Q4')}}

            </td>
            <td>
                <input name='q4' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>5</td>
            <td>
                    Does the Faculty give response to students’ doubts and questions?
                </td>
            <td>
                <input name='q5' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>6</td>
            <td>
                    Does the Faculty possess depth of knowledge in subject?
                 </td>
            <td><input name='q6' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                                               required title=''>
            </td>

        </tr>
        <tr>
            <td>7</td>
            <td>
                    Does the Faculty give and assignments to improve the studies?
                 </td>
            <td>
                <input name='q7' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>8</td>
            <td>
                    Is the Faculty available outside class hours to clarify the doubts?
            </td>
            <td>
                <input name='q8' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                                              required title=''>
            </td>

        </tr>
        <tr>
            <td >9</td>
            <td>
                    Does the Faculty use the black board and modern techniques effectively?
            </td>
            <td>
                <input name='q9' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>

        <tr>
            <td>10</td>
            <td>
                Is the Faculty regular and punctual to classes?
                    </td>
            <td>
                    <input name='q10' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                           required title=''>
            </td>
        </tr>

        </tbody>
    </table>

            <div class='row row d-flex p-3 bg-secondary'>
                <center><input type='submit' value='SUBMIT' class=' btn btn-success btn-secondary btn-lg' name='ok'> </center>
            </div>
     ";

    }else{
$output.="
        <input name='sa_id' type='hidden' value='$request->sa_id'>
     <table class='table table-bordered' width='100%'>
        <thead>
        <tr class='primary'>
            <th style='padding-left: 1%; font-size:  17px ;background-color: #d9edf7'>S.NO</th>
            <th style='padding-left: 10%; font-size: 17px ;background-color: #d9edf7'>QUESTION</th>
            <th style='padding-left: 10%; font-size: 17px ;background-color: #d9edf7'>RATING</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width='5%'>1</td>
            <td width='55%'>
               1
            </td>
            <td width='45%'>
                <input name='q1' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                      id='abc' required title=''>
            </td>

        </tr>
        <tr>
            <td >2</td>
            <td>
                    2
                </td>
            <td>
                <input name='q2' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>3</td>
            <td>
                3
            </td>
            <td>
                <input name='q3' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>4</td>
            <td>
                   4

            </td>
            <td>
                <input name='q4' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>5</td>
            <td>
                   5
                </td>
            <td>
                <input name='q5' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>6</td>
            <td>
                   6
                 </td>
            <td><input name='q6' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                                               required title=''>
            </td>

        </tr>
        <tr>
            <td>7</td>
            <td>
                   7
                 </td>
            <td>
                <input name='q7' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>8</td>
            <td>
                   8
            </td>
            <td>
                <input name='q8' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                                              required title=''>
            </td>

        </tr>
        <tr>
            <td >9</td>
            <td>
                    9
            </td>
            <td>
                <input name='q9' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>

        <tr>
            <td>10</td>
            <td>
                10
                    </td>
            <td>
                    <input name='q10' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                           required title=''>
            </td>
        </tr>

        </tbody>
    </table>

            <div class='row row d-flex p-3 bg-secondary'>
                <center><input type='submit' value='SUBMIT' id='ok' class=' btn btn-success btn-secondary btn-lg' name='ok'> </center>
            </div>
    ";
}
echo $output;
    }
    public function submit_feedback(Request $request){
        $sum=0;
        $feedback_record=new Feedback;
        $marks_alloted=array();
        $q1=(int)$request->q1;
        $q2=(int)$request->q2;
        $q3=(int)$request->q3;
        $q4=(int)$request->q4;
        $q5=(int)$request->q5;
        $q6=(int)$request->q6;
        $q7=(int)$request->q7;
        $q8=(int)$request->q8;
        $q9=(int)$request->q9;
        $q10=(int)$request->q10;
        $marks_alloted=[($q1*2),($q2*2),($q3*2),($q4*2),($q5*2),
            ($q6*2),($q7*2),($q8*2),($q9*2),($q10*2)];
        $sum=array_sum($marks_alloted);
        $feedback_record->q1=$marks_alloted[0];
        $feedback_record->q2=$marks_alloted[1];
        $feedback_record->q3=$marks_alloted[2];
        $feedback_record->q4=$marks_alloted[3];
        $feedback_record->q5=$marks_alloted[4];
        $feedback_record->q6=$marks_alloted[5];
        $feedback_record->q7=$marks_alloted[6];
        $feedback_record->q8=$marks_alloted[7];
        $feedback_record->q9=$marks_alloted[8];
        $feedback_record->q10=$marks_alloted[9];
        $feedback_record->sa_id=$request->sa_id;
        $feedback_record->sum=$sum;
        $feedback_record->phase=Session::get('phase');
        $feedback_record->student_id=auth()->user()->id;
        if($feedback_record->save()){
            Session::flash('success','Successfully Submitted ');
        }else{
            Session::flash('error','Something went wrong!!');
        }
        return redirect()->back();


    }

}
