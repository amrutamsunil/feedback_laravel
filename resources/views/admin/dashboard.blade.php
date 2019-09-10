@extends('layouts.admin_nav.')
<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:index.php');
}
include('dbconfig.php');
?>

@section('content')
<div class="flex-column">

    <!-- feedback-->
    <div class="row">
        <div class="col-lg-12">

            <?php
            @$id=$_GET['id'];
            @$info=$_GET['info'];
            if($info!="")
            {


                if($info=="display_student")
                {
                    include('display_student.php');
                }

                elseif($info=="time_table")
                {
                    include('alter_time_table.php');
                }
                elseif($info=="all_faculty_wise")
                {
                    include('all_faculty_wise_report.php');
                }
                elseif($info=="all_faculty_wise")
                {
                    //include('all_faculty_wise_report.php');
                }


                elseif($info=="class_wise")
                {
                    include('class_wise_feedback.php');
                }
                elseif($info=="show_time_table")
                {
                    include('Show_Time_Table.php');
                }

                elseif($info=="faculty_wise")
                {
                    include('faculty_wise_feedback.php');
                }
                else if($info=="update_password")
                {
                    include('update_password.php');
                }
                else if($info=="old_faculty_wise")
                {
                    include('old_record.php');
                }
                else if($info=="old_class_wise")
                {
                    include('old_class_wise.php');
                }



            }
            else
            {
                include('dashboard_home.php');
            }


            ?>

        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
@endsection