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
        .no-break {
            page-break-inside: avoid;
        }
        .pagenum:before{
            content: counter(page);
        }
    </style>
</head>
<body>
<div class="page-header">
    <img src='{{asset('img/miet.png')}}' class="sunil_logo" height="80px" width="100px">
    <center><h6><b>M.I.E.T ENGINEERING COLLEGE</b></h6></center>
    <center><h6><b>STUDENT FEEDBACK ANALYSIS REPORT</b></h6></center>
    <center><h6><b>ALL CLASSES REPORT</b></h6></center>
    <center><h6><b>DEPARTMENT OF {{$dept->short}}</b></h6></center>
    <center><h6><b>ACADEMIC YEAR : {{config('questions.academic_year')}} ( {{config('questions.current_sem')}} )</b></h6></center>


</div>
@foreach($class_obj as $class)
    @if($class['theory']['subjects']!=null||$class['lab']['subjects']!=null)
        <div class="no-break">
        <div class="float-center">
            <h6><b>CLASS NAME : {{$class['class_data']['name']}}</b></h6>
        </div>


        <table class="table table-sm table-bordered">
            <tr class="table-info table-bordered">
                <td class="text-center" >#</td>
                <td class="text-center" >SUBJECT NAME</td>
                <td class="text-center" >FACULTY HANDLING</td>
                <td class="text-center" >STUDENT COUNT</td>
                <td class="text-center" >PHASE-I</td>
                <td class="text-center" >STUDENT COUNT</td>
                <td class="text-center" >PHASE-II</td>
                <td class="text-center" >AVG</td>

            </tr>
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
        </table>
        </div>
        @if($class['theory']['count']>0)
            <table class="table table-sm table-bordered no-break">
                <tr class="table-info" >
                    <td class="text-center" rowspan="3" >#</td>
                    <td class="text-center" rowspan="3" >QUESTIONS</td>
                    <td class="text-center" colspan="{{($class['theory']['count']*2)}}" >THEORY SUBJECTS</td>
                </tr>

                <tr class="table-info ">
                    @foreach($class['theory']['subjects'] as $k)
                        <td class="text-center" colspan="2" >{{$k->name}}</td>
                    @endforeach
                </tr>
                <tr class="table-info table-bordered">
                    @for($temp=1;$temp<=($class['theory']['count']);++$temp)
                        <td class="text-center" >PHASE-I</td>
                        <td class="text-center" >PHASE-II</td>

                    @endfor
                </tr>

                @for($j=1;$j<=10;++$j)
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{config("questions.Q".$j)}}</td>
                        @foreach($class['theory']['subjects'] as $z)
                            <td class="text-center">{{$z->phase1_question_wise[$j]}}/10</td>
                            <td class="text-center">{{$z->phase2_question_wise[$j]}}/10</td>
                        @endforeach
                    </tr>
                @endfor
            </table>

        @endif

        @if($class['lab']['count']>0)
            <table class="table table-sm table-bordered no-break">
                <tr class="table-info table-bordered">
                    <td class="text-center" rowspan="3" >#</td>
                    <td class="text-center" rowspan="3" >QUESTIONS</td>

                    <td class="text-center" colspan="{{($class['lab']['count']*2)}}" >LAB SUBJECTS</td>
                </tr>

                <tr class="table-info table-bordered">
                    @foreach($class['lab']['subjects'] as $k)
                        <td class="text-center" colspan="2" >{{$k->name}}</td>
                    @endforeach
                </tr>
                <tr class="table-info table-bordered">
                    @for($temp=1;$temp<=($class['lab']['count']);++$temp)
                        <td class="text-center" >PHASE-I</td>
                        <td class="text-center" >PHASE-II</td>

                    @endfor
                </tr>


                @for($j=1;$j<=10;++$j)
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{config("questions.Q".$j."_lab")}}</td>
                        @foreach($class['lab']['subjects'] as $z)
                            <td class="text-center">{{$z->phase1_question_wise[$j]}}/10</td>
                            <td class="text-center">{{$z->phase2_question_wise[$j]}}/10</td>
                        @endforeach
                    </tr>
                @endfor
            </table>


        @endif
    @endif
@endforeach
<div style="width: 100%;height:50px;">

</div>

<div>
    <h6 class="float-left">HOD</h6>
    <h6 class="float-right">PRINCIPAL</h6>
</div>
</body>
</html>
