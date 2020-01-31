@extends('layouts.principal_nav')
@section('content')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <div>
        <button id="cse" type="button" value="1" class="btn btn-light sel_btn">CSE</button>
        <button id="ece" type="button" value="2" class="btn btn-danger sel_btn">ECE</button>
        <button id="mech" type="button" value="3" class="btn btn-danger sel_btn">MECH</button>
        <button id="civil" type="button" value="4" class="btn btn-danger sel_btn">CIVIL</button>
        <button id="eee" type="button" value="5" class="btn btn-danger sel_btn">EEE</button>
        <button id="mba" type="button" value="6" class="btn btn-danger sel_btn">MBA</button>


    </div>
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
                    url:"{{Route('principal.ajax_dashboard')}}",
                    data:{
                        dept_id:1,
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
                                text: "Department of"
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
                    }

                }
            );
            $(".sel_btn").on('click',function (e) {
                e.preventDefault();
                var id=this.id;
                var dept_id=$("#"+id).val();
                $(".sel_btn").removeClass("btn-light");
                $(".sel_btn").removeClass("btn-danger");
                $(".sel_btn").addClass("btn-danger");
                $("#"+id).addClass("btn-light").removeClass("btn-danger");
                $.ajax(
                    {
                        type:'POST',
                        url:"{{Route('principal.ajax_dashboard')}}",
                        data:{
                            dept_id:dept_id,
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
                                    text: "Department of"
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
                        }

                    }
                );

            });


        });
    </script>
@endsection
