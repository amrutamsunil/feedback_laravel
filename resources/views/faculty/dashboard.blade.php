@extends('layouts.faculty_nav')
@section('content')

    <div id="chartContainer" style="height: 100%; width: 100%;"></div>
<script type="text/javascript">
    $(document).ready(function () {
        var name="{{auth()->user()->name}}";
        toastr.info(name);
    var d1=[];var d2=[];

    $.ajax(
    {
    type:'POST',
    url:"{{Route('faculty.ajax_dashboard')}}",
    data:{
    "_token": "{{ csrf_token() }}"
    },
    beforeSend:function(){
    $(".modal").modal();
    },
    success:function (response) {

    d1=response.one;
    d2=response.two;

    CanvasJS.addColorSet("barcolors",
    [
    "#185BD8 ",
    "#22C1F0 ",
    ]);

    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    width:(screen.width-200),
    height:(screen.height-200),

    colorSet: "barcolors",

    title:{

    backgroundColor: "#D6EAF8",
    fontFamily: "Times New Roman",
    text: "Welcome {{auth()->user()->name}}"
    },
    animationDuration: 2000,



    exportEnabled: true,
    axisX:{
    interval:1,

    },
    axisY2:{
    interlacedColor: "rgba(1,77,101,.2)",
    gridColor: "rgba(1,77,101,.1)",
    title: "Average Of All Faculty"
    },
    data: [
    {
    type: "bar",
    dataPoints: d1
    },
    {
    type: "bar",
    dataPoints:d2
    },

    ]

    });

    chart.render();
        $(".modal").modal('hide');
    },
        complete:function () {
            $(".modal").modal('hide');
        }

    }
    );
    });
</script>
@endsection
