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
    </style>
</head>
<body>
<div class="page-header">
    <img src='{{asset('img/miet.png')}}' class="sunil_logo" height="80px" width="100px">
    <center><h6><b>M.I.E.T ENGINEERING COLLEGE</b></h6></center>
    <center><h6><b>STUDENT FEEDBACK ANALYSIS REPORT</b></h6></center>
    <center><h6><b>FACULTY REPORT</b></h6></center><br/>
    <center><h6><b>DEPARTMENT OF {{$dept->name}}</b></h6></center><br/>

</div>
<br/><br/>&nbsp;
<div class="float-left">
    <h6><b>FACULTY NAME : {{$faculty_obj->name}}</b></h6>
</div>

<table class="table table-sm table-bordered">
    <thead>
    <tr class="table-info">
        <th scope="col">#</th>
        <th scope="col">DEPT. NAME</th>
        <th scope="col">CLASS NAME</th>
        <th class="text-center" scope="col">SUBJECT NAME</th>
        <th class="text-center" scope="col">STUDENTS COUNT</th>
        <th class="text-center" scope="col">PHASE-I</th>
        <th class="text-center" scope="col">STUDENTS COUNT</th>
        <th class="text-center" scope="col">PHASE-II</th>
        <th class="text-center" scope="col">AVG</th>

    </tr>
    </thead>
    <tbody>
    @foreach($faculty_obj->subjects as $index=>$f)
        <tr>
            <td>{{($index+1)}}</td>
            <td>{{$f->class->department_name}}</td>
            <td>{{$f->class->name}}</td>
            <td>{{$f->name}}</td>
            <td class="text-center">{{$f->phase1_student_count}} / {{$f->class->student_count}}</td>
            <td class="text-center">{{$f->phase1_avg}}%</td>
            <td class="text-center">{{$f->phase2_student_count}} / {{$f->class->student_count}}</td>
            <td class="text-center">{{$f->phase2_avg}}%</td>
            <td class="text-center">{{(($f->phase1_avg + $f->phase2_avg)/2)}}%</td>
        </tr>
    @endforeach
    </tbody>
</table>


<h6 class="float-left">REVIEW :</h6><br/>
<textarea style="width: 100%;height: 10%;" ></textarea>

<div class="footer">
    <h6 class="float-left">HOD</h6>
    <h6 class="float-right">PRINCIPAL</h6>
</div>
</body>
</html>
