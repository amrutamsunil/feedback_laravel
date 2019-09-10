<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <link href="{{asset('img/miet.png')}}" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        Admin Dashboard
    </title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">



    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">



    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('vendor/css/nav.css')}}" rel="stylesheet">


</head>

<body style="overflow-y: scroll">
<div class="navbar_miet float-left ">
    <a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> HOME</a>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-comments-o" aria-hidden="true"></i> FEEDBACK <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=class_wise" style="margin-left:7%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Class-wise</a>
            <a href="dashboard.php?info=faculty_wise"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Faculty-wise</a>
            <a href="dashboard.php?info=all_faculty_wise"><i class="fa fa-hand-o-right" aria-hidden="true"></i>All Faculty-wise</a>

        </div>
    </div>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa-graduation-cap" aria-hidden="true"></i> STUDENT <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=display_student" style="margin-left:18%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Manage Student</a>
        </div>
    </div>
    <a href="dashboard.php?info=time_table"><i class="fa fa-calendar" aria-hidden="true"></i>TIME TABLE</a>
    <a href="dashboard.php?info=show_time_table"><i class="fa fa-calendar" aria-hidden="true"></i>SHOW TIME TABLE</a>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-history" aria-hidden="true"></i> OLD RECORDS <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=old_class_wise" style="margin-left:36%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Class-wise</a>
            <a href="dashboard.php?info=old_faculty_wise"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Faculty-wise</a>

        </div>
    </div>

    <div class="subnav_miet" style="float: right">
        <a href="dashboard.php?info=update_password"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>SignOut</a>
    </div>
</div>
@yield('content')
<script src="{{asset('css/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('css/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('css/metisMenu.min.js')}}"></script>


<!-- Custom Theme JavaScript -->
<script src="{{asset('css/sb-admin-2.js')}}"></script>

</body>

</html>
