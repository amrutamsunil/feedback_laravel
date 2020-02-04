<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select Phase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/loading.css')}}">

    <!-- Favicon -->

    <!-- Font awesome -->
    <link href="{{asset('vendor/student_dashboard/assets/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{asset('vendor/student_dashboard/assets/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/student_dashboard/assets/css/slick.css')}}">
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="{{asset('vendor/student_dashboard/assets/css/jquery.fancybox.css')}}" type="text/css" media="screen" />
    <!-- Theme color -->
    <link id="switcher" href="{{asset('vendor/student_dashboard/assets/css/theme-color/default-theme.css')}}" rel="stylesheet">

    <!-- Main style sheet -->
    <link href="{{asset('vendor/student_dashboard/assets/css/style.css')}}" rel="stylesheet">


    <!-- Google Fonts -->
    <link href="{{asset('https://fonts.googleapis.com/css?family=Montserrat:400,700')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700')}}" rel='stylesheet' type='text/css'>

</head>
<body>
<!-- Start menu -->
<section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Hello {{auth()->user()->name}}</a>

            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#">Change Password</a></li>
                    <li><a href="{{Route('user.logout')}}">Signout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</section>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@yield('content')
<!-- jQuery library -->
<script src="{{asset('vendor/student_dashboard/assets/js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('vendor/student_dashboard/assets/js/bootstrap.js')}}"></script>
<!-- Slick slider -->
<script type="text/javascript" src="{{asset('vendor/student_dashboard/assets/js/slick.js')}}"></script>
<!-- Counter -->
<script type="text/javascript" src="{{asset('vendor/student_dashboard/assets/js/waypoints.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/student_dashboard/assets/js/jquery.counterup.js')}}"></script>
<!-- Mixit slider -->
<script type="text/javascript" src="{{asset('vendor/student_dashboard/assets/js/jquery.mixitup.js')}}"></script>
<!-- Add fancyBox -->
<script type="text/javascript" src="{{asset('vendor/student_dashboard/assets/js/jquery.fancybox.pack.js')}}"></script>
<!-- Custom js -->
<script src="{{asset('vendor/student_dashboard/assets/js/custom.js')}}"></script>

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
