
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="{{asset('img/miet.png')}}" rel="icon">
    <title>FEEDBACK FORM</title>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <!--<link href="../css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <!--suppress JSUnresolvedLibraryURL -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/jquery_form.js')}}"></script>

    <!-- <script src="../js/star-rating.js" type="text/javascript"></script>-->
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

</head>
<body style="overflow-x: hidden">
<div id="tri">

</div>

<div class="navbar_miet float-left ">
    <a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> HOME </a>
    <div class="subnav_miet" style="float: right">
            <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>SignOut</a>
        </div>
</div>
    <br>
    <form method="post" >
<fieldset>
        <div class="row row d-flex p-3 bg-secondary">
            <div class="col-md-2"><label for="subsel" style="padding-left: 30%; font-size: 20px;font-family: Rockwell">Select Subject </label></div>
            <div class="col-md-8">
                <select name="subsel" id="subsel" class="form-control">
                    @foreach($feedback_obj->subjects as $subject)
                    @if($subject->flag=="Green")
                        <option style='background-color:#00FA9A;color:black;' value={{$subject->id."-".$subject->flag."-".$subject->type}}>{{$subject->short}} - {{$subject->faculty_name}}</option>";
                        @else
                            <option style='background-color:#FF9999;color:black;' value={{$subject->id."-".$subject->flag."-".$subject->type}}>{{$subject->short}} - {{$subject->faculty_name}}</option>";
                        @endif
                    @endforeach
                </select></div>
        </div>
</fieldset><br/>
            <div style="float: right">
            <table style="border: dashed 2px lightgray">
                <tr>
                    <td><div class="rectangle"></div></td>
                    <td>Green implies already feedback is given</td>
                </tr>
                <tr>
                    <td><div class="rect"></div></td>
                    <td>Red implies feedback is not given</td>
                </tr>
            </table>
            </div>
        <br/><br/>
        <div class="container" id="questions">

        </div>
    </form>
<textarea id="now" cols="40" rows="10"></textarea>
<?php
extract($_POST);

if(isset($ok)) {
    if ($ok == "") {
        echo "
        <script>
        alert('Select any Subject!!');
        </script>
        ";
    } else {
        $check = '';
        $subsel = $_POST['subsel'];
        $q1 = (int)$_POST['q1'];
        $q2 = (int)$_POST['q2'];
        $q3 = (int)$_POST['q3'];
        $q4 = (int)$_POST['q4'];
        $q5 = (int)$_POST['q5'];
        $q6 = (int)$_POST['q6'];
        $q7 = (int)$_POST['q7'];
        $q8 = (int)$_POST['q8'];
        $q9 = (int)$_POST['q9'];
        $q10 = (int)$_POST['q10'];
        $ratings = [$q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10];
        $check = $user_class->submit_feedback($subsel, $user_data, $check, $ratings, $phase);
        echo "<script type='text/javascript'>alert('$check');</script>";
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>
</body>
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

<script type="text/javascript">
    $('input').on('change',
     function() {
         var check=$('#subsel').val();
         if(check==""){
         alert('Select any  subject!');
         }

     });

           $('#subsel').on('change',function () {
               var subj_id = $(this).val();
               var ar = subj_id.split("-");
               var subject_id = ar[0];
               var flag = ar[1];
               var subject_type = ar[2];
               if (flag == "Green") {
                   toastr.success("Already Submitted");
               } else {
               $("#now").html("subject_id:" + subject_id + "  flag:" + ar[1] + "  type:" + ar[2]);
               if (subj_id) {
                   $.ajax({
                       type: 'POST',
                       url: '/ajax_questions',
                       data: {subject_id: subject_id, flag: flag, subject_type: subject_type,
                           "_token": "{{ csrf_token() }}"},
                       success: function (response) {
                           if (response) {
                               $("#questions").html(response);

                           }
                       }
                   });
               }
           }

            });


</script>
</html>
