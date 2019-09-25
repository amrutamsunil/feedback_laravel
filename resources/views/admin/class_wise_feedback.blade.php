<html>
<head>
    <meta id="token" name="token" content="{{csrf_token()}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
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

    </style>
</head>
<body style="max-width:100%;overflow-x:hidden;">
<br/><br/>
<div>
<form method="post" action="pdf_classwise_report.php">
    @csrf
    <div class="row row d-flex p-3 bg-secondary">
        <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
            <label for="clss" style="font-family: 'Arial';font-size: 18px">SELECT CLASS</label></div>
        <div class="col-md-8">
            <select class="form-control mdb-select md-form chosen" name="classSelect" id="clss" required>
               @foreach($classes as $class)
                <option value="{{$class->id}}">
                   {{$class->name}}
               </option>
                   @endforeach
            </select></div>
        <div class="col-md-2">
            <input name="ok" type="submit" value="" class="sunil_custom_pdf"/></div>
    </div>
</form>
</div>

<div id ="classtable" class="col-lg-12 col-md-6 col-sm-6">

</div>

<script type="text/javascript">
    $(".chosen").select2();
    $("#clss").on('change',function (e) {
        e.preventDefault();
        var class_id=$(this).val();
        if(class_id){
            $.ajax(
                {
                    type:'POST',
                    url:"{{Route('hod.ajax_class_wise')}}",
                    data:{
                        class_id:class_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success:function (response) {
                        $('#classtable').html(response);
                    }

                }
            );
        }
    });
</script>
</body>
</html>
