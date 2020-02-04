<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({
            placement : 'bottom'
        });
    });
</script>
<style type="text/css">
    .bs-example{
        margin: 100px 50px;
    }
</style>

<title>Login Page</title>
<link href="{{asset('img/miet.png')}}" rel="icon">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->
@yield('content')
<!--===============================================================================================-->
<!--===============================================================================================-->
<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
<script src="{{asset('js/main.js')}}"></script>
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
    toastr.options.positionClass='toast-top-center';
    @foreach ($errors->all() as $error)
    toastr.error("{{$error}}");
    @endforeach
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @elseif(Session::has('error'))
    toastr.error("{{Session::get('error')}}");
    @elseif(Session::has('info'))
    toastr.info("{{Session::get('info')}}");
    @endif
</script>
