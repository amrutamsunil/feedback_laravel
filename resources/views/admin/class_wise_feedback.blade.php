@extends('layouts.admin_nav')
@section('content')
    <br/><br/>
<div>
<form method="post" action="{{Route('hod.pdf_classwise_report')}}">
    @csrf
    <div class="row row d-flex p-3 bg-secondary">
        <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
            <label for="clss" style="font-family: 'Arial';font-size: 18px">SELECT CLASS</label></div>
        <div class="col-md-8">
            <select class="form-control mdb-select md-form chosen" name="class_id" id="clss" required>
                <option value="">Select Any Class</option>
               @foreach($classes as $class)
                <option value="{{$class->id}}">
                   {{$class->name}}
               </option>
                   @endforeach
            </select></div>
        <div class="col-md-2">
            <input name="ok" type="submit" id="pdfb" value="" class="sunil_custom_pdf"/></div>
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
<div id ="classtable" class="col-lg-12 col-md-6 col-sm-6">
</div>

<script type="text/javascript">
    $(".chosen").select2();
    $("#pdfb").on('click',function () {
       toastr.success("Downloading...");
    });
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
</script>
@endsection
