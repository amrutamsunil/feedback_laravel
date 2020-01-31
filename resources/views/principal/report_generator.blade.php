@extends('layouts.principal_nav')
@section('content')
    <center><h1>ALL FACULTY_WISE REPORT</h1></center><br/>

    <div class="jumbotron">
        <form method="post" action="{{Route('principal.pdf_question_wise_report')}}">
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
                    <center><h2>Download Started...</h2></center>
                </div>
            </div>
        </div>
    </div>
    <div id ="facultytable" class="col-lg-12 col-md-6 ">
    </div>
    <script>
        $(".chosen").select2();

        $("#pdfb").on('click',function () {
            toastr.success("Downloading...");
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

