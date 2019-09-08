<html>
<?php
include('../dbconfig.php');
include('../admin/Admin_Class.php');
$time_table_obj=new admin_ns\Admin_Class($conn);
if(!(isset($_SESSION['prev_class_id']))){
    $_SESSION['prev_class_id']="";
    $_SESSION['prev_class_name']="";}
?>
<?php

extract($_POST);
if(isset($set_table)) {
    if ($set_table == "") {
    } elseif ($_POST['classSelect'] == "" ) {
    } else {
        $_SESSION['prev_class_id'] = $_POST['classSelect'];
        $prev_id = $_SESSION['prev_class_id'];
        $q22 = mysqli_query($conn, "select name from classes where id=$prev_id");
        $q23 = mysqli_fetch_array($q22);
        $_SESSION['prev_class_name'] = $q23[0];
    }
}
?>
<head>
    <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/dist/css/select2.css')}}">
    <script src="{{asset('vendor/select2/dist/js/select2.full.js')}}"></script>
</head>
<body>
<div class="jumbotron">
    <form method="post">
        <div class="row row d-flex p-3 bg-secondary">
            <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                <label for="clsel" style="font-size: 18px;font-family: Arial;">SELECT CLASS</label></div>
            <div class="col-md-10">
                <select class="form-control mdb-select md-form chosen" id="clsel" name="classSelect" >
                    <?php
                    echo $time_table_obj->Class_lists2($_SESSION['dept_id'],$_SESSION['prev_class_id'],$_SESSION['prev_class_name']);
                    ?>
                </select></div>
        <br/>

            <br/><br/><br/><br/>
        </div>
        <div class="row d-flex p-3 bg-secondary"><center><input type="submit" name="set_table" value="Show"> </center></div>
    </form></div>
<div class="row d-flex p-3 bg-secondary">
    <div class="col-lg-12">
        <table class='table table-responsive table-bordered table-striped table-hover' style='margin:15px;'>
            <tr class='info'>
                <th class='text-capitalize text-dark info'> S.No </th>
                <th class='text-capitalize text-dark info'>CLASS NAME </th>
                <th class='text-capitalize text-dark info'>SUBJECT NAME</th>
                <th class='text-capitalize text-dark info'>FACULTY NAME</th>
                <th class='text-capitalize text-dark info'>DELETE</th>

            </tr>
            <?php
            extract($_POST);
            if(isset($set_table)) {
                if ($set_table == "") {
                    echo "<script>alert('Select any Option!!');</script>";
                }
                elseif ($_POST['classSelect']==""){     echo "<script>alert('Select any Class!!');</script>";}
                else {
                    $_SESSION['prev_class_id']=$_POST['classSelect'];
                    $prev_id=$_SESSION['prev_class_id'];
                    $q22=mysqli_query($conn,"select name from classes where id=$prev_id");
                    $q23=mysqli_fetch_array($q22);
                    $_SESSION['prev_class_name']=$q23[0];
                    echo $time_table_obj->show_time_table($_POST['classSelect']);
                }
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
<script type="text/javascript">
    function delete_subj_alloc(id) {
        if (id) {
            $.ajax(
                {
                    type: 'post',
                    url: 'ajax_delete_subj_alloc.php',
                    data: {id:id},
                    success: function (response) {
                        alert(response);
                        location.reload();
                    }

                }
            );
        }
    }
    $(".chosen").select2();
</script>
