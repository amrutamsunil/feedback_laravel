<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
<link href="{{asset('css/star-rating.css')}}" media="all" rel="stylesheet" type="text/css"/>
<!--suppress JSUnresolvedLibraryURL -->
<script src="{{asset('js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/star-rating.js')}}" type="text/javascript"></script>
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendor/css/nav.css')}}" rel="stylesheet">
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
</style>
<?php
include ('../dbconfig.php');
include ('User_Class.php');
session_start();
$output="";
$user_obj4=new user_ns\User_Class($conn);
extract($_POST);
$subject_selected=$_POST['subjsel'];
$phase=$_POST['phase'];
$user=$_POST['user'];
$query=NULL;$check=0;
$query=mysqli_query($conn,"select id from subjects where id=$subject_selected and subjects.type='T' ");
if($query!=NULL)
$check=mysqli_num_rows($query);
else $check=0;

if($check==1){
    $output="
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
               Does the Faculty come prepared on lessons?
            </td>
            <td width='45%'>
                <input name='q1' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                      id='abc' required title=''>
            </td>

        </tr>
        <tr>
            <td >2</td>
            <td>
                    Does the Faculty present the lessons clearly and orderly?
                </td>
            <td>
                <input name='q2' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>3</td>
            <td>
                Does the Faculty speak with the voice clarity and good language ?
            </td>
            <td>
                <input name='q3' type='text' class='rating' data-min=0 data-max=5 data-step=1 data-size='md'
                       required title=''>
            </td>

        </tr>
        <tr>
            <td>4</td>
            <td>
                    Does the Faculty keep the class under discipline and control?

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
    $output="
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
                <center><input type='submit' value='SUBMIT' class=' btn btn-success btn-secondary btn-lg' name='ok'> </center>
            </div>
    ";
}
    $users=$user_obj4->fetch_user($user);
    if(!($user_obj4->check_feedback_submit($subject_selected,$users,$phase))){
        $temp="You have already Given Feedback to this Subject !!";
        $output.="<script>alert('$temp');</script>" ;
    }
    echo $output;

?>
