@extends('layouts.faculty_nav')
@section('content')
    <br/><br/>
    <form method="post" action="{{Route('faculty.pdf_faculty_report')}}" >
        @csrf
        <div class="row  d-flex p-3 bg-secondary">
            <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                <label for="stf" style="font-family: Arial;font-size: 18px">SELECT SUBJECT</label></div>
            <div class="col-md-8">
                <select class="form-control mdb-select md-form chosen" id="stf" name="sa_id" required>
                    <option value="">Select Any Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{$subject['sa_id']}}">{{$subject['name']}}</option>
                    @endforeach
                </select></div>
            <div class="col-md-2">
                <input name="go" type="submit" id="pdfb" value="" class="sunil_custom_pdf"/></div>
        </div>
    </form>
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
    @endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(
            function () {
                $(".chosen").select2();
                $("#stf").on('change',function () {
                    var sa_id=$(this).val();
                    $.ajax({
                        type:'POST',
                        url:"{{Route('faculty.ajax_subject_report')}}",
                        data:{
                          sa_id:sa_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        beforeSend:function () {
                            $("#loading").modal();
                        },
                        success:function (response) {
                            $("#facultytable").html(response);
                            $("#loading").modal('hide');
                        },
                        complete:function () {
                            $("#loading").modal('hide');
                        }

                    });
                });
            }
        );
    </script>
    @endsection
