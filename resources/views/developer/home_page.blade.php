@extends('layouts.developer_nav.')
<?php
session_start();
if(!isset($_SESSION['user']))
{
    header('location:index.php');
}
include('../dbconfig.php');
@$info1=$_GET['info'];
if($info1=="alter_dep"){
    header('location:select_dep.php');
}

?>
@section('content')
 <div class="row  d-flex p-3 bg-secondary">
            <div class="col-lg-12">

                        <?php
                        @$id=$_GET['id'];
                        @$info=$_GET['info'];
                        if($info!="")
                        {
                            if($info=="add_student")
                            {
                                include('AddStudent.php');
                            }
                            elseif($info=="add_subject")
                            {
                                include('addSubject.php');
                            }

                            elseif($info=="remove_student")
                            {
                                include('DeleteStudent.php');
                            }

                            elseif($info=="alter_feedback")
                            {
                                include('AlterFeedbackReport.php');
                            }
                            elseif ($info=="add_faculty")
                            {
                                include('addFaculty.php');
                            }
                            else if($info=="update_password")
                            {
                                include('update_password.php');
                            }
                            elseif ($info=="promote")
                            {
                                include('pramote.php');
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