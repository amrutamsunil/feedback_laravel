<?php
include ('../dbconfig.php');
if(isset($_SESSION['phase'])){
    $phase=$_SESSION['phase'];
}
if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="{{asset('img/miet.png')}}" rel="icon">
    <title>FEEDBACK FORM</title>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!--<link href="../css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <!--suppress JSUnresolvedLibraryURL -->
    <script src="{{asset('js/vendor/jquery-2.1.4.min.js')}}"></script>
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
                    <?php echo $user_class->fill_subjects($user_data,$phase); ?>
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
<script type="text/javascript">
    $('input').on('change',
     function() {
         var check=$('#subsel').val();
         if(check==""){
         alert('Select any  subject!');
         }

     });

            $('#subsel').on('change',function () {
                var subj_id=$(this).val();
                var p="<?php echo $phase;?>";
                var u="<?php echo $user;?>";

                if(subj_id){
                    $.ajax({
                        type:'POST',
                        url:'ajax_subj_status.php',
                        data:{subjsel:subj_id,phase:p,user:u},
                        success:function (response) {
                            if(response){
                            $("#questions").html(response);

                            }
                        }
                    });
                }

            });


</script>
</body>
</html>
