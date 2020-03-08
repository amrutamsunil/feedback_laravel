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
        .bold_custom{
            font-weight: bold;
        }
        .no-break {
            page-break-inside: avoid;
        }

    </style>
</head>
<body>
@foreach($faculty_obj as $faculty)
    @if($faculty['theory']['subjects']!=null||$faculty['lab']['subjects']!=null)
        <div class="no-break">
            <div class="page-header">
                <img src='{{asset('img/miet.png')}}' class="sunil_logo" height="80px" width="100px">
                <center><h6><b>M.I.E.T ENGINEERING COLLEGE</b></h6></center>
                <center><h6><b>STUDENT FEEDBACK ANALYSIS REPORT</b></h6></center>
                <center><h6><b>FACULTY REPORT</b></h6></center><br/>
                <center><h6><b>DEPARTMENT OF {{$dept->name}}</b></h6></center><br/>
                <center><h6><b>ACADEMIC YEAR : {{config('questions.academic_year')}} ( {{config('questions.current_sem')}} )</b></h6></center>
                <center><h6><b>FACULTY NAME : {{$faculty['faculty_name']}}</b></h6></center>
            </div>


        <table class="table table-sm table-bordered">

            <tr class="bold_custom table-info table-bordered">
                <td>#</td>
                <td >DEPT. NAME</td>
                <td>CLASS NAME</td>
                <td class="text-center" >SUBJECT NAME</td>
                @if(config("buttons.phase_one_report")==="enable")
                <td class="text-center" >STUDENTS COUNT</td>
                <td class="text-center" >PHASE-I</td>
                @endif
                @if(config("buttons.phase_two_report")==="enable")
                <td class="text-center" >STUDENTS COUNT</td>
                <td class="text-center" >PHASE-II</td>
                @endif
                @if(config("buttons.phase_one_report")==="enable" &&
                config("buttons.phase_two_report")==="enable")
                <td class="text-center" >AVG</td>
                    @endif

            </tr>


            @foreach($faculty['theory']['subjects'] as $index=>$f)
                @if($f!=null)
                    <tr>
                        <td>{{($index+1)}}</td>
                        <td>{{$f->class->department_name}}</td>
                        <td>{{$f->class->name}}</td>
                        <td>{{$f->name}}</td>
                        @if(config("buttons.phase_one_report")==="enable")
                        <td class="text-center">{{$f->phase1_student_count}} / {{$f->class->student_count}}</td>
                        <td class="text-center">{{$f->phase1_avg}}%</td>
                        @endif
                        @if(config("buttons.phase_two_report")==="enable")
                        <td class="text-center">{{$f->phase2_student_count}} / {{$f->class->student_count}}</td>
                        <td class="text-center">{{$f->phase2_avg}}%</td>
                        @endif
                        @if(config("buttons.phase_one_report")==="enable" &&
            config("buttons.phase_two_report")==="enable")
                        <td class="text-center">{{(($f->phase1_avg + $f->phase2_avg)/2)}}%</td>
                    @endif
                    </tr>
                @endif
            @endforeach

            @foreach($faculty['lab']['subjects'] as $t)
                @if($t!=null)
                    <tr>
                        <td>{{($index++)}}</td>
                        <td>{{$t->class->department_name}}</td>
                        <td>{{$t->class->name}}</td>
                        <td>{{$t->name}}</td>
                        @if(config("buttons.phase_one_report")==="enable")
                        <td class="text-center">{{$t->phase1_student_count}} / {{$t->class->student_count}}</td>
                        <td class="text-center">{{$t->phase1_avg}}%</td>
                        @endif
                        @if(config("buttons.phase_two_report")==="enable")
                        <td class="text-center">{{$t->phase2_student_count}} / {{$t->class->student_count}}</td>
                        <td class="text-center">{{$t->phase2_avg}}%</td>
                        @endif
                        @if(config("buttons.phase_one_report")==="enable" &&
      config("buttons.phase_two_report")==="enable")
                        <td class="text-center">{{(($t->phase1_avg + $t->phase2_avg)/2)}}%</td>
                            @endif
                    </tr>
                @endif
            @endforeach
        </table>
            <div class="footer">
                <h6 class="float-left">HOD</h6>
                <h6 class="float-right">PRINCIPAL</h6>
            </div>
        </div>

        @if($faculty['theory']['count']>0)
            <table class="table table-sm table-bordered no-break">
                <tr class="bold_custom table-info table-bordered">
                    <td class="text-center" rowspan="3" >#</td>
                    <td class="text-center" rowspan="3" >QUESTIONS</td>
                    @if(config("buttons.phase_one_report")==="enable" &&
      config("buttons.phase_two_report")==="enable")
                    <td class="text-center" colspan="{{($faculty['theory']['count']*2)}}" >THEORY SUBJECTS</td>
                        @else
                        <td class="text-center" colspan="{{($faculty['theory']['count'])}}" >THEORY SUBJECTS</td>
                        @endif

                </tr>

                <tr class="bold_custom table-info table-bordered">
                    @foreach($faculty['theory']['subjects'] as $k)
                        @if(config("buttons.phase_one_report")==="enable" &&
     config("buttons.phase_two_report")==="enable")
                        <td class="text-center" colspan="2" >{{$k->name}}</td>
                        @else
                            <td class="text-center" colspan="1" >{{$k->name}}</td>
                        @endif

                            @endforeach
                </tr>
                <tr class="bold_custom table-info table-bordered">
                    @for($temp=1;$temp<=($faculty['theory']['count']);++$temp)
                        @if(config("buttons.phase_one_report")==="enable")
                        <td class="text-center" >PHASE-I</td>
                        @endif
                    @if(config("buttons.phase_two_report")==="enable")
                        <td class="text-center" >PHASE-II</td>
                            @endif

                    @endfor
                </tr>


                @for($j=1;$j<=10;++$j)
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{config("questions.Q".$j)}}</td>
                        @foreach($faculty['theory']['subjects'] as $z)
                            @if(config("buttons.phase_one_report")==="enable")
                            <td class="text-center">{{$z['phase1_question_wise'][$j]}}/10</td>
                            @endif
                        @if(config("buttons.phase_two_report")==="enable")
                            <td class="text-center">{{$z['phase2_question_wise'][$j]}}/10</td>
                                    @endif
                                    @endforeach
                    </tr>
                @endfor
            </table>
        @endif
        @if($faculty['lab']['count']>0)
            <table class="table table-sm table-bordered no-break">
                <tr class="bold_custom table-info table-bordered">
                    <td class="text-center" rowspan="3" >#</td>
                    <td class="text-center" rowspan="3" >QUESTIONS</td>
                    @if(config("buttons.phase_one_report")==="enable" &&
   config("buttons.phase_two_report")==="enable")
                    <td class="text-center" colspan="{{($faculty['lab']['count']*2)}}" >LAB SUBJECTS</td>
                        @else
                        <td class="text-center" colspan="{{($faculty['lab']['count'])}}" >LAB SUBJECTS</td>
                        @endif

                </tr>

                <tr class="bold_custom table-info table-bordered">
                    @foreach($faculty['lab']['subjects'] as $k)
                        @if(config("buttons.phase_one_report")==="enable" &&
   config("buttons.phase_two_report")==="enable")
                        <td class="text-center" colspan="2" >{{$k->name}}</td>
                        @else
                            <td class="text-center" colspan="1" >{{$k->name}}</td>
                        @endif

                            @endforeach
                </tr>
                <tr class="bold_custom table-info table-bordered">
                    @for($temp=1;$temp<=($faculty['lab']['count']);++$temp)
                        @if(config("buttons.phase_one_report")==="enable")
                        <td class="text-center" >PHASE-I</td>
                        @endif
                    @if(config("buttons.phase_two_report")==="enable")
                        <td class="text-center" >PHASE-II</td>
                            @endif

                    @endfor
                </tr>


                @for($j=1;$j<=10;++$j)
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{config("questions.Q".$j."_lab")}}</td>
                        @foreach($faculty['lab']['subjects'] as $z)
                            @if(config("buttons.phase_one_report")==="enable")
                            <td class="text-center">{{$z['phase1_question_wise'][$j]}}/10</td>
                            @endif
                            @if(config("buttons.phase_two_report")==="enable")
                            <td class="text-center">{{$z['phase2_question_wise'][$j]}}/10</td>
                                @endif
                        @endforeach
                    </tr>
                @endfor
            </table>
        @endif

    @endif
@endforeach


</body>

</html>
