@extends('layouts.admin_nav')
@section('content')
    <br/>
    <table id='faculty_wise' class='table table-bordered'>
        <tr class='primary'>
            <th  class='text-capitalize text-dark info'>S.NO</th>
            <th  class='text-capitalize text-dark info'>FACULTY NAME</th>
            <th  class='text-capitalize text-dark info'>DEPARTMENT</th>
            <th  class=' text-capitalize text-dark info'>CLASS NAME </th>
            <th  class=' text-capitalize text-dark info'>SEM </th>
            <th class='text-capitalize text-dark info' >BATCH </th>
            <th  class='text-capitalize text-dark info'>SUBJECT NAME </th>
            <th class='text-capitalize text-dark info' > PHASE I</th>
            <th  class='text-capitalize text-dark info'> PHASE II </th>
            <th  class='text-capitalize text-dark info'> AVG </th>

        </tr>
        @foreach($faculties as $index=>$faculty)

            <?php $toggle=true;?>
        @foreach($faculty[0]->subjects as $subject)
                <tr>
                    @if($toggle)
                    <td rowspan="{{$faculty->first()->subject_count}}">{{($index+1)}}</td>
                    <td rowspan="{{$faculty->first()->subject_count}}">{{$faculty->first()->name}}</td>
                    @endif
                    <?php $toggle=false;?>
                    <td>{{$subject->class->department_name}}</td>
                <td>{{$subject->class->name}}</td>
                <td>{{$subject->class->sem}}</td>
                        @if(preg_match("/ME/",$subject->class->name))
                <td>{{$subject->class->batch."-".($subject->class->batch+2)}}</td>
                        @else
                            <td>{{$subject->class->batch."-".($subject->class->batch+4)}}</td>
                        @endif

                <td>{{$subject->name}}</td>
                <td>{{$subject->phase1_avg}}</td>
                    <td>{{$subject->phase2_avg}}</td>
                <td>{{(($subject->phase1_avg+$subject->phase2_avg)/2)}}</td>
            </tr>
            @endforeach
            @endforeach
    </table>

@endsection
