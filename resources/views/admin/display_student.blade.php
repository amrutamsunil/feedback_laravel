@extends('layouts.admin_nav')
@section('content')
<div class="jumbotron">
    <form method="post" action="{{action('HodController@student_status_live')}}">
        @csrf
        <div class="row row d-flex p-3 bg-secondary">
            <div style="text-align: center;padding-top: 4px;padding-left:22px;font-size:16px" class="col-md-2">
                <label for="selcls" style="font-family: 'Arial';font-size: 18px" >SELECT CLASS</label></div>
            <div class="col-md-10">
                <select class="form-control mdb-select md-form chosen" id="selcls" name="class_id" required>
                  @foreach($classes as $class)
                      <option  value="{{$class->id}}">
                          {{$class->name}}
                      </option>
                      @endforeach
                </select>
                <button type="submit" class="btn-lg btn-primary" id="Refresh">REFRESH</button>
            </div>
        </div>

    </form></div>

<div id ="studenttable" class="col-lg-12 col-md-6 ">
    <table class='table table-responsive table-bordered table-striped table-hover' style='margin:15px;'>
        <tr class='primary' >
            <th class='text-capitalize text-dark info'>S.NO </th>
            <th class='text-capitalize text-dark info'>Registration NO.</th>
            <th class='text-capitalize text-dark info'>Name</th>
            <th class='text-capitalize text-dark info' >PHASE I COUNT</th>
            <th class='text-capitalize text-dark info' >PHASE I</th>
            <th class='text-capitalize text-dark info' >PHASE II COUNT</th>
            <th class='text-capitalize text-dark info' >PHASE II</th>
        </tr>
        @if(@$students!=NULL && @$subject_count!=NULL)
        @foreach ($students->first()->students as $index=>$student)
            <tr>
                <td>{{($index+1)}}</td>
                <td>{{$student->student_reg}}</td>
                <td>{{$student->name}}</td>
                <td style='text-align: center'>{{$student_feedback_phase1_count}}/{{$subject_count}}</td>
                @if($student->phase1_flag=="green")
                <td style='background-color:#4CAF50'></td>
                @else
                <td style='background-color:#FF9999'></td>
                @endif
                <td style='text-align: center'>{{$student_feedback_phase2_count}}/{{$subject_count}}</td>
                @if($student->phase2_flag=="green")
                <td style='background-color:#4CAF50'></td>
                @else
                <td style='background-color:#FF9999'></td>
                @endif

                </tr>
        @endforeach
            @endif


    </table>
</div>

<script type="text/javascript">
   /* $(".chosen").select2();
    $("#Refresh").on('click',function () {
        toastr.success("Loading...");
        var class_id=$("#selcls").val();
        if(class_id) {
            $.ajax(
                {
                    type:'POST',
                    url:'',
                    data:{
                        class_id:class_id,
                        "_token": ""
                    },
                    success:function (response) {
                        if(response){
                            $('#studenttable').html(response);
                        }
                    }
                }
            );
        }
    });

*/
</script>
    @endsection
