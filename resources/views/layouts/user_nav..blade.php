<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select Phase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                <a class="navbar-brand">Hello <?php echo $user_data['name'];?></a>

            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                    <li class="active"><a href="dashboard.php">Home</a></li>
                    <li><a href="dashboard.php?page=change_password">Change Password</a></li>
                    <li><a href="logout.php">Signout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</section>
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
</html>