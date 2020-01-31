<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta id="token" name="token" content="{{csrf_token()}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/dist/css/select2.css')}}">
    <script src="{{asset('vendor/select2/dist/js/select2.full.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/bootstrap-3.3.7/dist/css/bootstrap.min.css')}}">
    <script src="{{asset('vendor/bootstrap/bootstrap-3.3.7/dist/js/bootstrap.min.js')}}"></script>


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="{{asset('js/canvasjs.js')}}"></script>
<style>

    .sunil_custom_pdf {
        background-image: url( {{asset('images/PDF-icon-small-231x300.png')}} ) ;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        display: block;
        height: 80px;
        width: 80px;
    }
    .vasanth {
        background-color: white;
        width: 300px;
        border: 2px solid lightgrey;
        padding: 40px;
        margin: 1px;
        border-radius:10px;
        padding-right: 30% ;
        margin-left: 65%;
    }
</style>

    <title>Faculty dashboard</title>
    <link href="{{asset('img/miet.png')}}" rel="icon">

    <!-- Bootstrap Core CSS -->

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
    <a href="{{Route('faculty.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> HOME </a>
    <a href="{{Route('faculty.feedback_report')}}"><i class="fa fa fa-comments-o" aria-hidden="true"></i> FEEDBACK REPORT</a>
    <div class="subnav_miet" style="float: right">
        <!--<a href="home_page.php?info=update_password"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>-->
        <a href="{{Route('faculty.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>SignOut</a>
    </div>
</div>

@yield('content')
<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('css/metisMenu.min.js')}}"></script>


<!-- Custom Theme JavaScript -->
<script src="{{asset('css/sb-admin-2.js')}}"></script>

</body>
@yield('script')
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
