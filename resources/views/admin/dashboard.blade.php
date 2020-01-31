@extends('layouts.admin_nav')
@section('content')
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center><div class="loader"></div></center>
                    <center><h2>Loading...</h2></center>
                </div>
            </div>
        </div>
    </div>
    <div id="chartContainer" style="height: 100%; width: 100%;"></div>

    <script>

            $(document).ready(function () {
                $(".modal").hide();
                var d1=[];var d2=[];

                $.ajax(
                    {
                        type:'POST',
                        url:"{{Route('hod.ajax_dashboard')}}",
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
                                    text: "Department of "+response.dept_name
                                },
                                animationDuration: 2000,



                                exportEnabled: true,
                                axisX:{
                                    interval:1
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
                            $(".modal").modal('hide');
                            chart.render();
                        },
                        complete:function () {
                            $(".modal").modal('hide');

                        },
                        error:function () {
                            $(".modal").modal('hide');
                            toastr.error("Something went wrong!!");
                        }

                    }
                );


        });

    </script>
@endsection
