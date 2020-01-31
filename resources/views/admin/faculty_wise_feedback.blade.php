@extends('layouts.admin_nav')
@section('content')
    <br/><br/>
<div>
<form method="post" action="{{Route('hod.pdf_faculty_wise_report')}}" >
    @csrf
<div class="row  d-flex p-3 bg-secondary">
    <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
        <label for="stf" style="font-family: Arial;font-size: 18px">SELECT FACULTY</label></div>
    <div class="col-md-8">
                    <select class="form-control mdb-select md-form chosen" id="stf" name="faculty_id" required>
                    <option value="">Select Any Faculty</option>
                        @foreach($faculties as $faculty)
                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                        @endforeach
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
        $('#stf').on('change',function () {
            var staff_selected=$(this).val();
            if(staff_selected) {
                $.ajax({
                    type:'POST',
                    url:'{{Route('hod.ajax_faculty_wise')}}',
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
            }



        });

</script>
@endsection

