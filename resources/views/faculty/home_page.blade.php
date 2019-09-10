@extends('layouts.faculty_nav.')
<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:index.php');
}
include('../dbconfig.php');

?>
@section('content')
 <div class="row  d-flex p-3 bg-secondary">
            <div class="col-lg-12">

                        <?php
                        @$id=$_GET['id'];
                        @$info=$_GET['info'];
                        if($info!="")
                        {
                            if($info=="feedback_report")
                            {
                                include('feedback_report.php');
                            }
                            else if($info=="rating_report")
                            {
                                include('star_wise_report.php');
                            }
                            else if($info=="update_password"){
                                include ('update_password.php');
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

        <!-- /.row -->
<!-- /#wrapper -->
@endsection