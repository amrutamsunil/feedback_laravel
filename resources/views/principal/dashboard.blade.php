@extends('layouts.principal_nav.')
<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:index.php');
}
@$info=$_GET['info'];
if($info!="")
{
if($info=="print_all_faculty_wise_cse")
{
    $_SESSION['dept_id']=1;
    header('location:all_faculty_print.php');
}
else if($info=="print_all_faculty_wise_ece")
{
    $_SESSION['dept_id']=2;
    header('location:all_faculty_print.php');
}
else if($info=="print_all_faculty_wise_mech")
{
    $_SESSION['dept_id']=3;
    header('location:all_faculty_print.php');
}
else if($info=="print_all_faculty_wise_civil")
{
    $_SESSION['dept_id']=4;
    header('location:all_faculty_print.php');
}
else if($info=="print_all_faculty_wise_eee")
{
    $_SESSION['dept_id']=5;
    header('location:all_faculty_print.php');
}
else if($info=="print_all_faculty_wise_mba")
{
    $_SESSION['dept_id']=6;
    header('location:all_faculty_print.php');
}
else if($info=="print_all_class_wise_cse")
{
    $_SESSION['dept_id']=1;
    header('location:all_class_print.php');
}

else if($info=="print_all_class_wise_ece")
{
    $_SESSION['dept_id']=2;
    header('location:all_class_print.php');
}
else if($info=="print_all_class_wise_mech")
{
    $_SESSION['dept_id']=3;
    header('location:all_class_print.php');
}
else if($info=="print_all_class_wise_civil")
{
    $_SESSION['dept_id']=4;
    header('location:all_class_print.php');
}
else if($info=="print_all_class_wise_eee")
{
    $_SESSION['dept_id']=5;
    header('location:all_class_print.php');
}
else if($info=="print_all_class_wise_mba")
{
    $_SESSION['dept_id']=6;
    header('location:all_class_print.php');
}

}
include('../dbconfig.php');
?>
@section('content')
<div class="flex-column">
    <div class="row">
        <div class="col-lg-12">
            <?php
            @$info=$_GET['info'];
            if($info!="")
            {

                if($info=="faculty_wise_cse")
                {
                    $_SESSION['dept_id']=1;
                    include('faculty_wise_feedback.php');
                }
                else if($info=="faculty_wise_ece")
                {
                    $_SESSION['dept_id']=2;
                    include('faculty_wise_feedback.php');
                }
                else if($info=="faculty_wise_mech")
                {
                    $_SESSION['dept_id']=3;
                    include('faculty_wise_feedback.php');
                }
                else if($info=="faculty_wise_civil")
                {
                    $_SESSION['dept_id']=4;
                    include('faculty_wise_feedback.php');
                }
                else if($info=="faculty_wise_eee")
                {
                    $_SESSION['dept_id']=5;
                    include('faculty_wise_feedback.php');
                }
                else if($info=="faculty_wise_mba")
                {
                    $_SESSION['dept_id']=6;
                    include('faculty_wise_feedback.php');
                }
                if($info=="class_wise_cse")
                {
                    $_SESSION['dept_id']=1;
                    include('class_wise_feedback.php');
                }

            else if($info=="class_wise_cse")
            {
                $_SESSION['dept_id']=1;
                include('class_wise_feedback.php');
            }

                else if($info=="class_wise_ece")
                {
                    $_SESSION['dept_id']=2;
                    include('class_wise_feedback.php');
                }
                else if($info=="class_wise_mech")
                {
                    $_SESSION['dept_id']=3;
                    include('class_wise_feedback.php');
                }
                else if($info=="class_wise_civil")
                {
                    $_SESSION['dept_id']=4;
                    include('class_wise_feedback.php');
                }
                else if($info=="class_wise_eee")
                {
                    $_SESSION['dept_id']=5;
                    include('class_wise_feedback.php');
                }
                else if($info=="class_wise_mba")
                {
                    $_SESSION['dept_id']=6;
                    include('class_wise_feedback.php');
                }

                else if($info=="statistics")
                {
                    include('statistics.php');
                }

                else if($info=="update_password")
                {
                    include('update_password.php');
                }
            }
            else
            {
                include('dashboard_home.php');
            }
            ?>

        </div>
    </div>
</div>
@endsection