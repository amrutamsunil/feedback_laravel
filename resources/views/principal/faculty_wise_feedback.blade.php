@extends('layouts.principal_nav')
@section('content')
    <div class="jumbotron">
        <form method="post" action="{{Route('principal.pdf_faculty_wise_report')}}">
            @csrf
            <div class="row row d-flex p-3 bg-secondary">
                <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                    <label for="dept" style="font-size: 18px;font-family: Arial;">SELECT DEPARTMENT</label></div>
                <div class="col-md-8">
                    <select class="form-control mdb-select md-form chosen" id="dept" name="dept_select" required>
                        <option value="">CHOOSE A DEPARTMENT</option>
                        @foreach($departments as $dept)
                            <option value="{{$dept->id}}">{{$dept->short}}</option>
                        @endforeach
                    </select></div>
            </div>
            <br/>
            <div class="row  d-flex p-3 bg-secondary">
                <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                    <label for="stf" style="font-family: Arial;font-size: 18px">SELECT FACULTY</label></div>
                <div class="col-md-8">
                    <select class="form-control mdb-select md-form chosen" id="stf" name="faculty_id" required>
                        <option value="">Select Any Faculty</option>
                    </select></div>
                <div class="col-md-2">
                    <input name="go" type="submit" id="pdfb" value="" class="sunil_custom_pdf"/></div>
            </div>
        </form>
    </div>
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
    <div id ="facultytable" class="col-lg-12 col-md-6 ">
    </div>
    <script>
        $(".chosen").select2();
        $("#pdfb").on('click',function () {
            toastr.success("Downloading...");
        });
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
                            url:"{{Route('principal.dept_faculty')}}",
                            data:{dept:dept,
                                "_token": "{{ csrf_token() }}"
                            },
                            success:function(data) {
                                $('#stf').html('<option selected="selected" value="">Select Faculty</option>');
                                $.each(data, function(key, value) {
                                    console.log('key :'+ key + '  value :'+value);
                                    $('#stf').append('<option value="'+key+'">'+value+'</option>');
                                });
                                $("#pdfb").show();

                            }
                        });
                    }
                    else{
                        $('#stf').html('<option value="">Select Department First</option>');
                    }
                });

            }
        );
        $('#stf').on('change',function () {
            var staff_selected=$(this).val();
            if(staff_selected) {
                $.ajax({
                    type:'POST',
                    url:'{{Route('principal.ajax_faculty_wise')}}',
                    data:{
                        faculty_id:staff_selected,
                        "_token": "{{ csrf_token() }}"
                    },
                    beforeSend:function(){
                      $("#loading").modal();
                    },
                    success:function (response)
                    {
                        $('#facultytable').html(response);
                        $("#loading").modal('hide');
                    }

                });
            }else{
                toastr.warning("Choose a department");
            }



        });

    </script>
@endsection

