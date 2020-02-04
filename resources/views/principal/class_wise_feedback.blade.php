@extends('layouts.principal_nav')
@section('content')
    <div class="jumbotron">
        <form method="post" action="{{Route('principal.pdf_classwise_report')}}">
            @csrf
            <div class="row row d-flex p-3 bg-secondary">
                <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                    <label for="dept" style="font-size: 18px;font-family: Arial;">SELECT DEPARTMENT</label></div>
                <div class="col-md-8">
                    <select class="form-control mdb-select md-form chosen" id="dept" name="batch_select" id="btch" required>
                        <option value="">CHOOSE A DEPARTMENT</option>
                        @foreach($departments as $dept)
                            <option value="{{$dept->id}}">{{$dept->short}}</option>
                        @endforeach
                    </select></div>
            </div>
            <br/>
            <div class="row row d-flex p-3 bg-secondary">
                <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                    <label for="clssel_" style="font-size: 18px;font-family: Arial;">SELECT CLASS</label></div>
                <div class="col-md-8">
                    <select class="form-control mdb-select md-form chosen" id="class_select" name="class_id"  required>
                    </select></div>
                <div class="col-md-2">
                    <input name="ok" type="submit" id="pdfb" value="" class="sunil_custom_pdf"/></div>
            </div>
        </form></div>
    <div class="modal" id="loading" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center><div class="loader"></div></center>
                    <center><h2>Loading...</h2></center>
                </div>
            </div>
        </div>
    </div>
    <div id ="classtable" class="col-lg-12 col-md-6 col-sm-6">
    </div>
    <script type="text/javascript">
        $(document).ready(
            function () {
                $("#pdfb").hide();
                toastr.warning("Choose a Department");

                $('#dept').on('change',function () {
                    var dept=$(this).val();
                    if(dept){
                        $.ajax({
                            type:'POST',
                            dataType: "json",
                            url:"{{Route('principal.dept_class')}}",
                            data:{dept:dept,
                                "_token": "{{ csrf_token() }}"
                            },
                            success:function(data) {

                                $('#class_select').html('<option selected="selected" value="">Select Class</option>');
                                $.each(data, function(key, value) {
                                    $('#class_select').append('<option value="'+key+'">'+value+'</option>');
                                });
                                $("#pdfb").show();

                            }
                        });
                    }
                    else{
                        $('#class_select').html('<option value="">Select Batch First</option>');
                    }
                });

            }
        );

        $("#class_select").on('change',function (e) {
            e.preventDefault();
            var class_id=$(this).val();
            if(class_id){
                $.ajax(
                    {
                        type:'POST',
                        url:"{{Route('principal.ajax_class_wise')}}",
                        data:{
                            class_id:class_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        beforeSend:function(){
                            $("#loading").modal();
                        },
                        success:function (response) {
                            $('#classtable').html(response);
                            $("#loading").modal('hide');
                        }

                    }
                );
            }
        });
        $(".chosen").select2();
    </script>
@endsection
