@extends('layouts.admin_nav')
@section('content')
    <div id="chartContainer" style="height: 100%; width: 100%;"></div>

    <script>
        $(document).ready(function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                width:(screen.width-200),
                height:(screen.height-200),
                title:{
                    text:"Department of {{$dept_name}}"
                },
                exportEnabled: true,
                axisX:{
                    interval:1
                },
                axisY2:{
                    interlacedColor: "rgba(1,77,101,.2)",
                    gridColor: "rgba(1,77,101,.1)",
                    title: "Average Of All Faculty"
                },
                data: [{
                    type: "bar",
                    name: "companies",
                    axisYType: "secondary",
                    color: "#014D65",
                    dataPoints: <?php echo json_encode($datapoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        });
    </script>
@endsection
