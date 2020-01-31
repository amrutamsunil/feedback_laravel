<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta id="token" name="token" content="{{csrf_token()}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <link href="{{asset('img/miet.png')}}" rel="icon">
    <link rel="stylesheet" type="text/css" href="{{asset('css/loading.css')}}">

    <script type="text/javascript" src="{{asset('js/canvasjs.js')}}"></script>

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
    <script src="{{asset('vendor/bootstrap/bootstrap-3.3.7/dist/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/dist/css/select2.css')}}">
    <script src="{{asset('vendor/select2/dist/js/select2.full.js')}}"></script>

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
</head>
<body style="overflow-y: scroll">
<div class="navbar_miet float-left ">
    <a href="{{Route('principal.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> HOME</a>
    <div class="subnav_miet">
        <button class="subnavbtn_miet"><i class="fa fa fa-comments-o" aria-hidden="true"></i> FEEDBACK <i class="fa fa-caret-down"></i></button>
        <div class="subnav_miet-content">
            <a href="{{Route('principal.class_wise_page')}}" style="margin-left:7%"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Class-wise</a>
            <a href="{{Route('principal.faculty_wise_page')}}"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Faculty-wise</a>
        </div>
    </div>
    <a href="{{Route('principal.report_generator')}}"> REPORT GENERATOR </a>
    <a href="{{Route('principal.classes_report')}}"> ALL CLASSES REPORT </a>
    <a href="{{Route('principal.test')}}"> TESTING </a>

    <div class="subnav_miet" style="float: right">
       <!-- <a href="#"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>-->
        <a href="{{Route('principal.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>SignOut</a>
    </div>

</div>
@yield('content')
<script src="{{asset('css/metisMenu.min.js')}}"></script>
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
