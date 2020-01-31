<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link href="{{asset('img/miet.png')}}" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/css/nav.css')}}" rel="stylesheet">


</head>

<body style="overflow-y: scroll">


<div class="navbar_miet float-left ">
    <a href="{{Route("developer.dashboard")}}"><i class="fa fa-home" aria-hidden="true"></i> HOME</a>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-graduation-cap" aria-hidden="true"></i> MANAGE STUDENT <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="{{Route("developer.show_add_student")}}" style="margin-left:8%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ADD STUDENT</a>
            <a href="{{Route("developer.show_alter_feedback")}}"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ALTER FEEDBACK SUBMISSION</a>
        </div>
    </div>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa-user" aria-hidden="true"></i> MANAGE FACULTY <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="{{Route("developer.show_add_faculty")}}" style="margin-left:22%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ADD FACULTY</a>

        </div>
    </div>
    <div class="subnav_miet" style="float: right">
        <a href="update_password"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
        <a href="{{Route('developer.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>SignOut</a>
    </div>
    <a href="{{Route("developer.show_add_subject")}}"><i class="fa fa-angle-double-down" aria-hidden="true"></i> ADD SUBJECT </a>
    <a href="{{Route("developer.promote")}}"><i class="fa fa-forward" aria-hidden="true"></i> PR0MOTE </a>
</div>

@yield('content')
<!-- jQuery -->
<script src="{{asset('css/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('css/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('css/metisMenu.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/canvasjs.js')}}"></script>



<!-- Custom Theme JavaScript -->
<script src="{{asset('css/sb-admin-2.js')}}"></script>

</body>
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
<script type='text/javascript'>
    toastr.options.closeDuration = 200;
    toastr.options.closeEasing = 'swing';
    toastr.options.showMethod = 'slideDown';
    toastr.options.hideMethod = 'slideUp';
    //toastr.options.closeMethod = 'slideUp';
    toastr.options.newestOnTop = false;
    toastr.options.preventDuplicates = true;
    toastr.options.extendedTimeOut = 60;
    //toastr.options.progressBar = true;
    toastr.options.positionClass='toast-bottom-center';
    @foreach ($errors->all() as $error)
    toastr.error("{{$error}}");
    @endforeach
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @elseif(Session::has('Error'))
    toastr.error("{{Session::get('error')}}");
    @elseif(Session::has('info'))
    toastr.info("{{Session::get('info')}}");
    @endif
</script>
</html>
