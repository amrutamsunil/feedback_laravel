<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8"/>
    <link href="{{asset('img/miet.png')}}" rel="icon">
    <title>FEEDBACK FORM</title>
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/loading.css')}}">


    <!--<link href="../css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <!--suppress JSUnresolvedLibraryURL -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/jquery_form.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/bootstrap-3.3.7/dist/js/bootstrap.min.js')}}"></script>


    <!-- <script src="../js/star-rating.js" type="text/javascript"></script>-->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/css/nav.css')}}" rel="stylesheet">
    <style>
    .rectangle {
        height: 30px;
        width: 70px;
        background-color: #00FA9A;
    }
    .rect {
        height: 30px;
        width: 70px;
        background-color: #FF9999;
    }
</style>

</head>
<body style="overflow-x: hidden">
<div id="tri">

</div>

<div class="navbar_miet float-left ">
    <a href="{{Route('user.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> HOME </a>
    <div class="subnav_miet" style="float: right">
            <a href="{{Route('user.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>SignOut</a>
        </div>
</div>
    <br>
    <form method="post" id="f" action="{{Route('user.submit_feedback')}}">
<fieldset>
    @csrf
        <div class="row row d-flex p-3 bg-secondary">
            <div class="col-md-2"><label for="subsel" style="padding-left: 30%; font-size: 20px;font-family: Rockwell">Select Subject </label></div>
            <div class="col-md-8">
                <select name="subsel" id="subsel" class="form-control">
                    <option value="0">Select Any Subject</option>

                @foreach($feedback_obj->subjects as $subject)
                    @if($subject->flag=="Green")
                        <option style='background-color:#00FA9A;color:black;' value={{$subject->pivot->id."-".$subject->flag."-".$subject->type."-".$subject->short}}>{{$subject->short}} - {{$subject->faculty_name}}</option>";
                        @else
                            <option style='background-color:#FF9999;color:black;' value={{$subject->pivot->id."-".$subject->flag."-".$subject->type."-".$subject->short}}>{{$subject->short}} - {{$subject->faculty_name}}</option>";
                        @endif
                    @endforeach
                </select></div>
        </div>
</fieldset><br/>
            <div style="float: right">
            <table style="border: dashed 2px lightgray">
                <tr>
                    <td><div class="rectangle"></div></td>
                    <td>Green implies already feedback is given</td>
                </tr>
                <tr>
                    <td><div class="rect"></div></td>
                    <td>Red implies feedback is not given</td>
                </tr>
            </table>
            </div>
        <br/><br/>

        <div class="container" id="questions">

        </div>
    </form>

<div class="modal" id="loading" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center><div class="loader"></div></center>
                <center><h2>Submiting...</h2></center>
            </div>
        </div>
    </div>
</div>
</body>
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

<script type="text/javascript">
    $('input').on('change',
     function() {
         var check=$('#subsel').val();
         if(check==""){
         alert('Select any  subject!');
         }

     });
    $(document).ready(function () {
        toastr.warning("Select Any Subject!!");
        $("#loading").modal("hide");
    });
        $("form").submit(function () {
            $("#loading").modal();
        });

           $('#subsel').on('change',function () {

               var subj_id = $(this).val();
                if(subj_id==="0"){
                    toastr.error('Select Any Subject!!');
                }else{
               var ar = subj_id.split("-");
               var subject_alloc_id = ar[0];
               var flag = ar[1];
               var subject_type = ar[2];
               var subject_short=ar[3];
               if (flag == "Green") {
                   toastr.success("Already Submitted");
               } else {
                   toastr.info("You Have Selected "+subject_short);
                   if (subj_id) {
                       $.ajax({
                           type: 'POST',
                           url: 'user/ajax_questions',
                           data: {
                               sa_id: subject_alloc_id, flag: flag, subject_type: subject_type,
                               "_token": "{{ csrf_token() }}"
                           },
                           success: function (response) {
                               if (response) {
                                   $("#questions").html(response);

                               }
                           }
                       });
                   }
               }
           }
            });


</script>
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
