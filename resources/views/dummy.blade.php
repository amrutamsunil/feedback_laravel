<html>
<head>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <style>
        .sunil_logo{
            position: absolute;
            left: 0;
            right: 0;
        }
        tr {
            font-family: "Calibri";
            font-size: 0.875em;
        }
        table.table-bordered{
            border:1px solid black;
            margin-top:20px;
        }
        table.table-bordered > thead > tr > th{
            border:1px solid black;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid black;
        }
        .footer {
            position: fixed;
            left: 10px;
            bottom: 20px;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="page-header">
    <img src='{{asset('img/miet.png')}}' class="sunil_logo" height="80px" width="100px">
    <center><h6><b>M.I.E.T ENGINEERING COLLEGE</b></h6></center>
    <center><h6><b>STUDENT FEEDBACK ANALYSIS REPORT</b></h6></center>
    <center><h6><b>FACULTY REPORT</b></h6></center><br/>
    <center><h6><b>DEPARTMENT OF {{$dept->dept_short}}</b></h6></center><br/>

</div>
@foreach($class_obj as $class)
    @if($class['theory']['subjects']!=null||$class['lab']['subjects']!=null)
    <br/><br/>&nbsp;
    <div class="float-left">
        <h6><b>CLASS NAME : {{$class['class_data']['name']}}</b></h6>
    </div>

    <table class="table table-sm table-bordered">
        <thead>
        <tr class="table-info">
            <th class="text-center" >#</th>
            <th class="text-center" >SUBJECT NAME</th>
            <th class="text-center" >FACULTY HANDLING</th>
            <th class="text-center" >STUDENT COUNT</th>
            <th class="text-center" >PHASE-I</th>
            <th class="text-center" >STUDENT COUNT</th>
            <th class="text-center" >PHASE-II</th>
            <th class="text-center" >AVG</th>

        </tr>
        </thead>
        <tbody>
        @foreach($class['theory']['subjects'] as $index=>$f)
            @if($f!=null)
            <tr>
                <td>{{($index+1)}}</td>
                <td>{{$f->name}}</td>
                <td>{{$f->faculty->name}}</td>
                <td class="text-center">{{$f->phase1_student_count}} / {{$class['class_data']['student_count']}}</td>
                <td class="text-center">{{$f->phase1_avg}}%</td>
                <td class="text-center">{{$f->phase2_student_count}} / {{$class['class_data']['student_count']}}</td>
                <td class="text-center">{{$f->phase2_avg}}%</td>
                <td class="text-center">{{(($f->phase1_avg + $f->phase2_avg)/2)}}%</td></tr>
            @endif
            @endforeach
                @foreach($class['lab']['subjects'] as $t)
                    @if($t!=null)
                    <tr>
                    <td>{{($index++)}}</td>
                    <td>{{$t->name}}</td>
                    <td>{{$t->faculty->name}}</td>
                    <td class="text-center">{{$t->phase1_student_count}} / {{$class['class_data']['student_count']}}</td>
                    <td class="text-center">{{$t->phase1_avg}}%</td>
                    <td class="text-center">{{$t->phase2_student_count}} / {{$class['class_data']['student_count']}}</td>
                    <td class="text-center">{{$t->phase2_avg}}%</td>
                    <td class="text-center">{{(($t->phase1_avg + $t->phase2_avg)/2)}}%</td>
                    </tr>
                    @endif
                @endforeach
        </tbody>
    </table><br/><br/>
    @if($class['theory']['count']>0)
    <table class="table table-sm table-bordered">
        <thead>
        <tr class="table-info">
            <th class="text-center" rowspan="3" >#</th>
            <th class="text-center" rowspan="3" >QUESTIONS</th>


            <th class="text-center" colspan="{{($class['theory']['count']*2)}}" >THEORY SUBJECTS</th>
        </tr>

        <tr>
            @foreach($class['theory']['subjects'] as $k)
                <th class="text-center" colspan="2" >{{$k->name}}</th>
                @endforeach
            </tr>
        <tr>
            @for($temp=1;$temp<=($class['theory']['count']);++$temp)
                <th class="text-center" >PHASE-I</th>
                <th class="text-center" >PHASE-II</th>

            @endfor
        </tr>

        </thead>
        <tbody>

        @for($j=1;$j<=10;++$j)
        <tr>
            <td>{{$j}}</td>
            <td>{{"q".$j}}</td>
            @foreach($class['theory']['subjects'] as $z)
                <td>{{$z->phase1_question_wise[$j]}}</td>
                <td>{{$z->phase2_question_wise[$j]}}</td>
                @endforeach
        </tr>
        @endfor
        </tbody>
    </table>
    @endif
    <br/>
    @if($class['lab']['count']>0)
    <table class="table table-sm table-bordered">
        <thead>
        <tr class="table-info">
            <th class="text-center" rowspan="3" >#</th>
            <th class="text-center" rowspan="3" >QUESTIONS</th>


            <th class="text-center" colspan="{{($class['lab']['count']*2)}}" >LAB SUBJECTS</th>
        </tr>

        <tr>
            @foreach($class['lab']['subjects'] as $k)
                <th class="text-center" colspan="2" >{{$k->name}}</th>
            @endforeach
        </tr>
        <tr>
            @for($temp=1;$temp<=($class['lab']['count']);++$temp)
                <th class="text-center" >PHASE-I</th>
                <th class="text-center" >PHASE-II</th>

            @endfor
        </tr>

        </thead>
        <tbody>

        @for($j=1;$j<=10;++$j)
            <tr>
                <td>{{$j}}</td>
                <td>{{"q".$j}}</td>
                @foreach($class['lab']['subjects'] as $z)
                    <td>{{$z->phase1_question_wise[$j]}}</td>
                    <td>{{$z->phase2_question_wise[$j]}}</td>
                @endforeach
            </tr>
        @endfor
        </tbody>
    </table>
    @endif


    <h6 class="float-left">REVIEW :</h6><br/>
    <textarea style="width: 100%;height: 10%;" ></textarea>

    <div class="footer">
        <h6 class="float-left">HOD</h6>
        <h6 class="float-right">PRINCIPAL</h6>
    </div>
    @endif
@endforeach
</body>
</html>
