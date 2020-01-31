@extends('layouts.admin_nav')
@section('content')
<div class="jumbotron">
    <form method="post" action="{{Route('hod.pdf_classwise_report')}}">
        @csrf
        <div class="row row d-flex p-3 bg-secondary">
            <div style="text-align: center;padding-top: 8px;font-size:16px" class="col-md-2">
                <label for="btch" style="font-size: 18px;font-family: Arial;">SELECT BATCH</label></div>
            <div class="col-md-8">
                <select class="form-control mdb-select md-form " id="batch" name="batch_select" id="btch" required>
                    <option value="">CHOOSE A BATCH</option>
                 @foreach($batches as $batch)
                     <option value="{{$batch->batch}}">{{$batch->batch}}</option>
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
            toastr.warning("Choose a batch");

            $('#batch').on('change',function () {
                var batch=$(this).val();
                if(batch){
                    $.ajax({
                        type:'POST',
                        dataType: "json",
                        url:"{{Route('hod.class_batch')}}",
                        data:{batch:batch,
                            "_token": "{{ csrf_token() }}"
                        },
                        success:function(data) {

                            $('#class_select').html('<option selected="selected" value="">Select Class</option>');
                            $.each(data, function(key, value) {
                                console.log('key :'+ key + '  value :'+value);
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
    $(".chosen").select2();
</script>
@endsection
