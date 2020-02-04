@extends('layouts.developer_nav')
@section('content')
    <html>

    <body>
    <form method="post" action="{{Route('upload')}}" enctype="multipart/form-data" style="margin:7%">
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
        <div class="row row d-flex p-3 bg-secondary">
            <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                <label for="clssel_" style="font-size: 18px;font-family: Arial;">SELECT CLASS</label></div>
            <div class="col-md-8">
                <select class="form-control mdb-select md-form chosen" id="class_select" name="class_id"  required>
                </select></div>
            <div class="col-md-2"></div>
        </div>
        <div class="form-group">
            <label for="emp_reg">Input file</label>
            <input name="file" type="file" required>
        </div>

        <button type="submit" name="sub" class="btn btn-primary">Submit</button>
    </form>
    <hr/>
    </body>

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
                                url:"{{Route('developer.dept_class')}}",
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


        $(".chosen").select2();
    </script>
    </html>
@endsection
