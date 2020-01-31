@extends('layouts.principal_nav')
@section('content')
    <center><h1>ALL CLASSS_WISE REPORT</h1></center><br/>
    <div class="jumbotron">
        <form method="post" id="pdf_class_form" action="{{Route('principal.pdf_all_classes_report')}}">
            @csrf
            <div class="row row d-flex p-3 bg-secondary">
                <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                    <label for="dept" style="font-size: 18px;font-family: Arial;">SELECT DEPARTMENT</label></div>
                <div class="col-md-8">
                    <select class="form-control mdb-select md-form chosen" id="dept" name="dept_select" required>
                        <option value="-1">CHOOSE A DEPARTMENT</option>
                        @foreach($departments as $dept)
                            <option value="{{$dept->id}}">{{$dept->short}}</option>
                        @endforeach
                    </select></div>
            </div>
            <br/>
            <center><input name="go" type="submit" id="pdfb" value="" class="sunil_custom_pdf"/></center>
        </form>
    </div>
    <div class="modal" id="loading" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center><div class="loader"></div></center>
                    <center><h2>Downloading ....</h2></center>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".chosen").select2();

      /*  $("#pdfb").on('click',function () {
            toastr.success("Downloading...");
        });*/
        $("#pdf_class_form").on('submit',function (e) {
            e.preventDefault();
            var dept_name=$("#dept").text();
            var dept = $("#dept").val();
            if (dept > 0) {

                $.ajax({
                    type:'POST',
                    url:"{{Route('principal.pdf_all_classes_report')}}",
                    xhrFields: {
                        responseType: 'blob'
                    },
                    data:{
                        dept_select:dept,
                        "_token": "{{ csrf_token() }}"
                    },
                    beforeSend:function(){
                        $("#loading").modal();
                    },
                    success: function (data) {
                        $("#loading").modal("hide");
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = dept_name+'_classes_report.pdf';
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);

                    },
                    error:function () {
                        $("#loading").modal("hide");
                        toastr.error("Something went wrong!!");
                    },
                    complete:function () {
                        $("#loading").modal("hide");

                    }
                });
            }else{
                toastr.warning("Choose a department");
            }

        });
        $(document).ready(
            function () {
                $("#loading").modal("hide");

                toastr.warning("Choose a Department");
                $("#pdfb").hide();
                $("#dept").on('change',function () {
                    var v=$(this).val();
                    if(v=="-1")
                    {
                        $("#pdfb").hide();
                    }else{
                        $("#pdfb").show();
                    }
                });
            });

    </script>

@endsection

