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
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/css/nav.css')}}" rel="stylesheet">
</head>
<body style="overflow-y: scroll">
<div class="navbar_miet float-left ">
    <a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> HOME</a>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-comments-o" aria-hidden="true"></i> CLASS_WISE <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=class_wise_cse" style="margin-left:7%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CSE </a>
            <a href="dashboard.php?info=class_wise_ece"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ECE </a>
            <a href="dashboard.php?info=class_wise_eee"><i class="fa fa-hand-o-right" aria-hidden="true"></i> EEE </a>
            <a href="dashboard.php?info=class_wise_civil"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CIVIL </a>
            <a href="dashboard.php?info=class_wise_mech"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MECH </a>
            <a href="dashboard.php?info=class_wise_mba"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MBA </a>
        </div>
    </div>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-comments-o" aria-hidden="true"></i> FACULTY_WISE <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=faculty_wise_cse" style="margin-left:18%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CSE </a>
            <a href="dashboard.php?info=faculty_wise_ece"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ECE </a>
            <a href="dashboard.php?info=faculty_wise_eee"><i class="fa fa-hand-o-right" aria-hidden="true"></i> EEE </a>
            <a href="dashboard.php?info=faculty_wise_civil"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CIVIL </a>
            <a href="dashboard.php?info=faculty_wise_mech"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MECH </a>
            <a href="dashboard.php?info=faculty_wise_mba"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MBA </a>
        </div>
    </div>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-file" aria-hidden="true"></i> CLASSES REPORT <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=print_all_class_wise_cse" style="margin-left:30%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CSE </a>
            <a href="dashboard.php?info=print_all_class_wise_ece"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ECE </a>
            <a href="dashboard.php?info=print_all_class_wise_eee"><i class="fa fa-hand-o-right" aria-hidden="true"></i> EEE </a>
            <a href="dashboard.php?info=print_all_class_wise_civil"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CIVIL </a>
            <a href="dashboard.php?info=print_all_class_wise_mech"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MECH </a>
            <a href="dashboard.php?info=print_all_class_wise_mba"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MBA </a>
        </div>
    </div>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa-file" aria-hidden="true"></i> FACULTIES REPORT <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=all_faculty_print.php" style="margin-left:40%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CSE </a>
            <a href="dashboard.php?info=print_all_faculty_wise_ece"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ECE </a>
            <a href="dashboard.php?info=print_all_faculty_wise_eee"><i class="fa fa-hand-o-right" aria-hidden="true"></i> EEE </a>
            <a href="dashboard.php?info=print_all_faculty_wise_civil"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CIVIL </a>
            <a href="dashboard.php?info=print_all_faculty_wise_mech"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MECH </a>
            <a href="dashboard.php?info=print_all_faculty_wise_mba"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MBA </a>
        </div>
    </div>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-comments-o" aria-hidden="true"></i>ALL FACULTY_WISE <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="dashboard.php?info=all_faculty_wise_cse" style="margin-left:18%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CSE </a>
            <a href="dashboard.php?info=all_faculty_wise_ece"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ECE </a>
            <a href="dashboard.php?info=all_faculty_wise_eee"><i class="fa fa-hand-o-right" aria-hidden="true"></i> EEE </a>
            <a href="dashboard.php?info=all_aculty_wise_civil"><i class="fa fa-hand-o-right" aria-hidden="true"></i> CIVIL </a>
            <a href="dashboard.php?info=all_faculty_wise_mech"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MECH </a>
            <a href="dashboard.php?info=all_faculty_wise_mba"><i class="fa fa-hand-o-right" aria-hidden="true"></i> MBA </a>
        </div>
    </div>


    <a href="dashboard.php?info=statistics"> STATISTICS </a>
    <div class="subnav_miet" style="float: right">
        <a href="dashboard.php?info=update_password"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>SignOut</a>
    </div>

</div>
@yield('content')
<script src="{{asset('css/jquery.min.js')}}"></script>
<script src="{{asset('css/bootstrap.min.js')}}"></script>
<script src="{{asset('css/metisMenu.min.js')}}"></script>
<script src="{{asset('css/sb-admin-2.js')}}"></script>
</body>
</html>