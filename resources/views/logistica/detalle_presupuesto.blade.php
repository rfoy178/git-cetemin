

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                 <div class="portlet-body">
                    <div class="table">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                            <tr>
                                <th>   </th>
                                <th colspan="4" > </th>
                                <th colspan="3" style="text-align: center">Lima </th>
                                <th colspan="3" style="text-align: center" class="success">Arequipa </th>
                                <th colspan="3" style="text-align: center">Corporativo </th>
                            </tr>
                            <tr>
                                <th>   </th>
                                <th colspan="4" > </th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th class="success">Ejecutado </th>
                                <th class="success">Presupuestado </th>
                                <th class="success">Diferencia</th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <th> <i class="fa fa-chevron-up"></i> </th>
                                <th colspan="4" >  </th>
                                <th  class="text-right">{{number_format($sueldo["LIM_EXC_REAL"]+$gastos["LIM_EXC_REAL"],2,".",",")}} </th>
                                <th  class="text-right">{{number_format($sueldo["LIM_EXC_MONTO"]+$gastos["LIM_EXC_MONTO"],2,".",",")}}  </th>
                                <th  class="text-right">{{number_format(($sueldo["LIM_EXC_REAL"]-$sueldo["LIM_EXC_MONTO"]+($gastos["LIM_EXC_REAL"]-$gastos["LIM_EXC_MONTO"])),2,".",",")}}</th>
                                <th  class="text-right success">{{number_format($sueldo["AQP_EXC_REAL"]+$gastos["AQP_EXC_REAL"],2,".",",")}} </th>
                                <th  class="text-right success">{{number_format($sueldo["AQP_EXC_MONTO"]+$gastos["AQP_EXC_MONTO"],2,".",",")}}  </th>
                                <th  class="text-right success" >{{number_format(($sueldo["AQP_EXC_REAL"]-$sueldo["AQP_EXC_MONTO"]+($gastos["AQP_EXC_REAL"]-$gastos["AQP_EXC_MONTO"])),2,".",",")}}</th>
                                <th  class="text-right">{{number_format($sueldo["EXC_REAL"]+$gastos["EXC_REAL"],2,".",",")}} </th>
                                <th  class="text-right">{{number_format($sueldo["U_EXC_MONTO"]+$gastos["U_EXC_MONTO"],2,".",",")}}  </th>
                                <th  class="text-right">{{number_format(($sueldo["EXC_REAL"]-$sueldo["U_EXC_MONTO"]+($gastos["EXC_REAL"]-$gastos["U_EXC_MONTO"])),2,".",",")}}</th>

                            </tr>

                            <tr class="header">
                                <td>   </td>

                                <td>  @if((($sueldo["LIM_EXC_REAL"]-$sueldo["LIM_EXC_MONTO"])>0))
                                        <i class="fa fa-chevron-up" style="color:blue"></i>
                                    @else
                                        <i class="fa fa-chevron-down" style="color:red"></i>
                                    @endif </td>

                                <td  colspan="3"  >SUELDOS </td>

                                <td class="text-right">{{number_format($sueldo["LIM_EXC_REAL"],2,".",",")}} </td>
                                <td class="text-right">{{number_format($sueldo["LIM_EXC_MONTO"],2,".",",")}}  </td>
                                <td class="text-right">{{number_format($sueldo["LIM_EXC_REAL"]-$sueldo["LIM_EXC_MONTO"],2,".",",")}}  </td>

                                <td class="text-right success">{{number_format($sueldo["AQP_EXC_REAL"],2,".",",")}} </td>
                                <td class="text-right success">{{number_format($sueldo["AQP_EXC_MONTO"],2,".",",")}}  </td>
                                <td class="text-right success">{{number_format($sueldo["AQP_EXC_REAL"]-$sueldo["AQP_EXC_MONTO"],2,".",",")}}  </td>


                                <td class="text-right">{{number_format($sueldo["EXC_REAL"],2,".",",")}} </td>
                                <td class="text-right">{{number_format($sueldo["U_EXC_MONTO"],2,".",",")}}  </td>
                                <td class="text-right">{{number_format($sueldo["EXC_REAL"]-$sueldo["U_EXC_MONTO"],2,".",",")}}  </td>



                                </td>

                            </tr>
                            @foreach($presupuesto as $item)

                                    <tr style="display: none"

                                    @if(($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"]>0))

                                    @else
                                    class="danger"
                                        @endif



                                >
                                    <td>   </td>

                                    <td>  </td>
                                    <td>
                                        @if(($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"]>0))
                                            <i class="fa fa-chevron-up" style="color:blue"></i>
                                        @else
                                            <i class="fa fa-chevron-down" style="color:red"></i>
                                        @endif
                                    </td>


                                    <td   >{{$item["EXC_CUECON_F"]}} </td>

                                    <td   >{{$item["AcctName"]}} </td>

                                    <td class="text-right">{{number_format($item["LIM_EXC_REAL"],2,".",",")}} </td>
                                    <td class="text-right">{{number_format($item["LIM_EXC_MONTO"],2,".",",")}}  </td>
                                    <td class="text-right">{{number_format($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"],2,".",",")}}  </td>

                                        <td class="text-right success">{{number_format($item["AQP_EXC_REAL"],2,".",",")}} </td>
                                        <td class="text-right success">{{number_format($item["AQP_EXC_MONTO"],2,".",",")}}  </td>
                                        <td class="text-right success">{{number_format($item["AQP_EXC_REAL"]-$item["AQP_EXC_MONTO"],2,".",",")}}  </td>


                                        <td class="text-right">{{number_format($item["EXC_REAL"],2,".",",")}} </td>
                                        <td class="text-right">{{number_format($item["U_EXC_MONTO"],2,".",",")}}  </td>
                                        <td class="text-right">{{number_format($item["EXC_REAL"]-$item["U_EXC_MONTO"],2,".",",")}}  </td>


                                        </td>

                                </tr>

                            @endforeach

                            <tr class="header">
                                <td>   </td>
                                <td> @if((($gastos["LIM_EXC_REAL"]-$gastos["LIM_EXC_MONTO"])>0))
                                        <i class="fa fa-chevron-up" style="color:blue"></i>
                                    @else
                                        <i class="fa fa-chevron-down" style="color:red"></i>
                                    @endif </td>

                                <td  colspan="3"  >GASTOS </td>

                                <td class="text-right">{{number_format($gastos["LIM_EXC_REAL"],2,".",",")}} </td>
                                <td class="text-right">{{number_format($gastos["LIM_EXC_MONTO"],2,".",",")}}  </td>
                                <td class="text-right">{{number_format($gastos["LIM_EXC_REAL"]-$gastos["LIM_EXC_MONTO"],2,".",",")}}  </td>

                                <td class="text-right success">{{number_format($gastos["AQP_EXC_REAL"],2,".",",")}} </td>
                                <td class="text-right success">{{number_format($gastos["AQP_EXC_MONTO"],2,".",",")}}  </td>
                                <td class="text-right success">{{number_format($gastos["AQP_EXC_REAL"]-$gastos["AQP_EXC_MONTO"],2,".",",")}}  </td>


                                <td class="text-right">{{number_format($gastos["EXC_REAL"],2,".",",")}} </td>
                                <td class="text-right">{{number_format($gastos["U_EXC_MONTO"],2,".",",")}}  </td>
                                <td class="text-right">{{number_format($gastos["EXC_REAL"]-$gastos["U_EXC_MONTO"],2,".",",")}}  </td>


                                </td>

                            </tr>
                            @foreach($presupuesto2 as $item)

                                <tr  style="display: none"


                                     @if(($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"]>0))

                                     @else
                                     class="danger"
                                        @endif

                                >
                                    <td>   </td>

                                    <td>  </td>
                                    <td>

                                        @if(($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"]>0))
                                            <i class="fa fa-chevron-up" style="color:blue"></i>
                                        @else
                                            <i class="fa fa-chevron-down" style="color:red"></i>
                                        @endif
                                    </td>

                                    <td   >{{$item["EXC_CUECON_F"]}} </td>

                                    <td   >{{$item["AcctName"]}} </td>

                                    <td class="text-right">{{number_format($item["LIM_EXC_REAL"],2,".",",")}} </td>
                                    <td class="text-right">{{number_format($item["LIM_EXC_MONTO"],2,".",",")}}  </td>
                                    <td class="text-right">{{number_format($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"],2,".",",")}}  </td>

                                    <td class="text-right success">{{number_format($item["AQP_EXC_REAL"],2,".",",")}} </td>
                                    <td class="text-right success">{{number_format($item["AQP_EXC_MONTO"],2,".",",")}}  </td>
                                    <td class="text-right success">{{number_format($item["AQP_EXC_REAL"]-$item["AQP_EXC_MONTO"],2,".",",")}}  </td>


                                    <td class="text-right">{{number_format($item["EXC_REAL"],2,".",",")}} </td>
                                    <td class="text-right">{{number_format($item["U_EXC_MONTO"],2,".",",")}}  </td>
                                    <td class="text-right">{{number_format($item["EXC_REAL"]-$item["U_EXC_MONTO"],2,".",",")}}  </td>



                                    </td>

                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Lima </span>
                        <span class="caption-helper">Control presupuestal mensual</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                         <a href="" class="fullscreen" data-original-title="" title=""> </a>
                     </div>
                </div>
                <div class="portlet-body">
<?php

                    $n=count($char1);
$i=1;
?>



                    <!-- Chart code -->
                    <script>
                        var chart = AmCharts.makeChart( "chartdiv",{
                            "type": "serial",
                            "categoryField": "date",
                            "dataDateFormat": "YYYY-MM",
                            "language": "es",

                            "theme": "light",
                            "export": {
                                "enabled": true
                            },
                            "categoryAxis": {
                                "minPeriod": "MM",
                                "parseDates": true
                            },
                            "chartCursor": {
                                "enabled": true,
                                "categoryBalloonDateFormat": "MMM YYYY"
                            },
                            "chartScrollbar": {
                                "enabled": true
                            },
                            "trendLines": [],
                            "graphs": [
                                {
                                    "bullet": "round",
                                    "id": "AmGraph-3",
                                    "title": "Ejecutado Ingreso",
                                    "valueField": "column-3","dashLength": 3

                                },{
                                    "bullet": "round",
                                    "id": "AmGraph-1",
                                    "title": "Ejecutado Gastos",
                                    "valueField": "column-1",
                                    "balloonText": "<b>[[porcentajeE]]%<b>",
                                    "dashLength": 3
                                },

                                {
                                    "bullet": "square",
                                    "id": "AmGraph-4",
                                    "title": "Presupuestado Ingreso",
                                    "valueField": "column-4"
                                },
                                {
                                    "bullet": "square",
                                    "id": "AmGraph-2",
                                    "title": "Presupuestado Gastos",
                                    "valueField": "column-2",
                                    "balloonText": "<b>[[porcentajeP]]%<b>"

                                }

                            ],
                            "guides": [],
                            "valueAxes": [],
                            "allLabels": [],
                            "balloon": {},
                            "legend": {
                                "enabled": true,
                                "useGraphSettings": true
                            },
                            "titles": [],
                            "dataProvider": [
                                @foreach($char1 as $item)
                                {{"{"}}
                                    "date": "{{substr($item["mes"],0,4)."-".substr($item["mes"],4,2)}}",
                                    "column-1": {{$item["LIM_EXC_REAL"]}},

                        "column-2": {{$item["LIM_EXC_MONTO"]}},
                        @if($item["p"]["LIM_EXC_REAL"]>0)
                        "porcentajeE":"{{number_format(($item["LIM_EXC_REAL"]*100)/$item["p"]["LIM_EXC_REAL"],1,".","")}}",
                        @else
                            "porcentajeE":"-",

                            @endif

                                    @if($item["p"]["LIM_EXC_MONTO"]>0)
                                "porcentajeP":"{{number_format(($item["LIM_EXC_MONTO"]*100)/$item["p"]["LIM_EXC_MONTO"],1,".","")}}",
                        @else
                            "porcentajeP":"-",
                            @endif

                            "column-3": {{$item["p"]["LIM_EXC_REAL"]}},
                        "column-4": {{$item["p"]["LIM_EXC_MONTO"]}}
                        <?php
                        if($i<$n){
                            ?>
                        ,"dashLengthColumn": 5,
                            "alpha": 0.2}
                        <?php
                        }else{
                        ?>
                        {{"}"}}
                        <?php  }?>
                        <?php
                        if($i<$n){
                            echo ",";
                        }
                        $i++;
                        ?>@endforeach
                            ]
                        }


                           );
                    </script>

                    <!-- HTML -->
    <div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>


        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Lima </span>
                        <span class="caption-helper">Control presupuestal acumulado</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                <?php

                $n=count($char2);
                $i=1;
                ?>


                <!-- Resources -->

                    <!-- Chart code -->
                    <script>
                        var chart2 = AmCharts.makeChart( "chartdiv2",{
                            "type": "serial",
                            "categoryField": "date",
                            "dataDateFormat": "YYYY-MM",
                            "language": "es",

                            "theme": "light",
                            "categoryAxis": {
                                "minPeriod": "MM",
                                "parseDates": true
                            }, "export": {
                                "enabled": true
                            },
                            "chartCursor": {
                                "enabled": true,
                                "categoryBalloonDateFormat": "MMM YYYY"
                            },
                            "chartScrollbar": {
                                "enabled": true
                            },
                            "trendLines": [],
                            "graphs": [
                                {
                                    "id": "AmGraph-3",
                                    "title": "Ejecutado Ingresos",
                                    "valueField": "column-3",
                                    "bullet": "round","dashLength": 3
                                },{
                                     "id": "AmGraph-1",
                                     "title": "Ejecutado Gastos",
                                    "valueField": "column-1",
                                    "bullet": "round",
                                    "balloonText": "<b>[[porcentajeE]]%<b>"
                                ,"dashLength": 3

                                },
                                {
                                    "id": "AmGraph-4",
                                    "title": "Presupuestado Ingresos",
                                    "valueField": "column-4",
                                    "bullet": "square"
                                },
                                {
                                     "id": "AmGraph-2",
                                     "title": "Presupuestado Gastos",
                                    "valueField": "column-2",
                                    "bullet": "square",
                                    "balloonText": "<b>[[porcentajeP]]%<b>",

                                }
                            ],
                            "guides": [],
                            "valueAxes": [],
                            "allLabels": [],
                            "balloon": {},

                            "legend": {
                                "enabled": true,
                                "useGraphSettings": true
                            },
                            "titles": [],
                            "dataProvider": [
                                @foreach($char2 as $item)
                                        {{"{"}}
                                    "date": "{{substr($item["mes"],0,4)."-".substr($item["mes"],4,2)}}",
                            "column-1": {{$item["LIM_EXC_REAL"]}},
                        "column-2": {{$item["LIM_EXC_MONTO"]}},
                        "column-3": {{$item["p"]["LIM_EXC_REAL"]}},
                        "column-4": {{$item["p"]["LIM_EXC_MONTO"]}},

                        @if($item["p"]["LIM_EXC_REAL"]>0)
                            "porcentajeE":"{{number_format(($item["LIM_EXC_REAL"]*100)/$item["p"]["LIM_EXC_REAL"],1,".","")}}",
                                @else
                                    "porcentajeE":"-",

                                @endif

                                        @if($item["p"]["LIM_EXC_MONTO"]>0)
                                    "porcentajeP":"{{number_format(($item["LIM_EXC_MONTO"]*100)/$item["p"]["LIM_EXC_MONTO"],1,".","")}}"
                                @else
                                    "porcentajeP":"-"
                        @endif


                        <?php
                        if($i<$n){
                        ?>
                        ,"dashLengthColumn": 5,
                            "alpha": 0.2}
                        <?php
                        }else{
                        ?>
                        {{"}"}}
                        <?php  }?>

                        <?php
                        if($i<$n){
                            echo ",";
                        }
                        $i++;
                        ?>@endforeach

                        ]
                        } );
                    </script>

                    <!-- HTML -->
                    <div id="chartdiv2" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>


    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Arequipa </span>
                        <span class="caption-helper">Control presupuestal mensual</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                <?php

                $n=count($char1);
                $i=1;
                ?>



                <!-- Chart code -->
                    <script>
                        var chart3 = AmCharts.makeChart( "chartdiv3",{
                            "type": "serial",
                            "categoryField": "date",
                            "dataDateFormat": "YYYY-MM",
                            "language": "es",

                            "theme": "light",
                            "export": {
                                "enabled": true
                            },
                            "categoryAxis": {
                                "minPeriod": "MM",
                                "parseDates": true
                            },
                            "chartCursor": {
                                "enabled": true,
                                "categoryBalloonDateFormat": "MMM YYYY"
                            },
                            "chartScrollbar": {
                                "enabled": true
                            },
                            "trendLines": [],
                            "graphs": [
                                {
                                    "bullet": "round",
                                    "id": "AmGraph-3",
                                    "title": "Ejecutado Ingreso",
                                    "valueField": "column-3","dashLength": 3

                                },{
                                    "bullet": "round",
                                    "id": "AmGraph-1",
                                    "title": "Ejecutado Gastos",
                                    "valueField": "column-1",
                                    "balloonText": "<b>[[porcentajeE]]%<b>",
                                    "dashLength": 3
                                },

                                {
                                    "bullet": "square",
                                    "id": "AmGraph-4",
                                    "title": "Presupuestado Ingreso",
                                    "valueField": "column-4"
                                },
                                {
                                    "bullet": "square",
                                    "id": "AmGraph-2",
                                    "title": "Presupuestado Gastos",
                                    "valueField": "column-2",
                                    "balloonText": "<b>[[porcentajeP]]%<b>"

                                }

                            ],
                            "guides": [],
                            "valueAxes": [],
                            "allLabels": [],
                            "balloon": {},
                            "legend": {
                                "enabled": true,
                                "useGraphSettings": true
                            },
                            "titles": [],
                            "dataProvider": [
                                @foreach($char1 as $item)
                                        {{"{"}}
                                    "date": "{{substr($item["mes"],0,4)."-".substr($item["mes"],4,2)}}",
                            "column-1": {{$item["AQP_EXC_REAL"]}},

                        "column-2": {{$item["AQP_EXC_MONTO"]}},

                        @if($item["p"]["AQP_EXC_REAL"]>0)
                            "porcentajeE":"{{number_format(($item["AQP_EXC_REAL"]*100)/$item["p"]["AQP_EXC_REAL"],1,".","")}}",
                                @else
                                    "porcentajeE":"-",

                                @endif

                                        @if($item["p"]["AQP_EXC_MONTO"]>0)
                                    "porcentajeP":"{{number_format(($item["AQP_EXC_MONTO"]*100)/$item["p"]["AQP_EXC_MONTO"],1,".","")}}",
                                @else
                                    "porcentajeP":"-",
                                @endif


                            "column-3": {{$item["p"]["AQP_EXC_REAL"]}},
                        "column-4": {{$item["p"]["AQP_EXC_MONTO"]}}
                        <?php
                        if($i<$n){
                        ?>
                        ,"dashLengthColumn": 5,
                            "alpha": 0.2}
                        <?php
                        }else{
                        ?>
                        {{"}"}}
                        <?php  }?>
                        <?php
                        if($i<$n){
                            echo ",";
                        }
                        $i++;
                        ?>@endforeach
                        ]
                        }


                        );
                    </script>

                    <!-- HTML -->
                    <div id="chartdiv3" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>


        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Arequipa </span>
                        <span class="caption-helper">Control presupuestal acumulado</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                <?php

                $n=count($char2);
                $i=1;
                ?>


                <!-- Resources -->

                    <!-- Chart code -->
                    <script>
                        var chart4 = AmCharts.makeChart( "chartdiv4",{
                            "type": "serial",
                            "categoryField": "date",
                            "dataDateFormat": "YYYY-MM",
                            "theme": "light",
                            "language": "es",

                            "export": {
                                "enabled": true
                            },
                            "categoryAxis": {
                                "minPeriod": "MM",
                                "parseDates": true
                            },
                            "chartCursor": {
                                "enabled": true,
                                "categoryBalloonDateFormat": "MMM YYYY"
                            },
                            "chartScrollbar": {
                                "enabled": true
                            },
                            "trendLines": [],
                            "graphs": [
                                {
                                    "id": "AmGraph-3",
                                    "title": "Ejecutado Ingresos",
                                    "valueField": "column-3",
                                    "bullet": "round","dashLength": 3
                                },{
                                    "id": "AmGraph-1",
                                    "title": "Ejecutado Gastos",
                                    "valueField": "column-1",
                                    "bullet": "round",
                                    "balloonText": "<b>[[porcentajeE]]%<b>"
                                    ,"dashLength": 3

                                },
                                {
                                    "id": "AmGraph-4",
                                    "title": "Presupuestado Ingresos",
                                    "valueField": "column-4",
                                    "bullet": "square"
                                },
                                {
                                    "id": "AmGraph-2",
                                    "title": "Presupuestado Gastos",
                                    "valueField": "column-2",
                                    "bullet": "square",
                                    "balloonText": "<b>[[porcentajeP]]%<b>",

                                }
                            ],
                            "guides": [],
                            "valueAxes": [],
                            "allLabels": [],
                            "balloon": {},

                            "legend": {
                                "enabled": true,
                                "useGraphSettings": true
                            },
                            "titles": [],
                            "dataProvider": [
                                @foreach($char2 as $item)
                                        {{"{"}}
                                    "date": "{{substr($item["mes"],0,4)."-".substr($item["mes"],4,2)}}",
                            "column-1": {{$item["AQP_EXC_REAL"]}},
                        "column-2": {{$item["AQP_EXC_MONTO"]}},
                        "column-3": {{$item["p"]["AQP_EXC_REAL"]}},
                        "column-4": {{$item["p"]["AQP_EXC_MONTO"]}},
                        @if($item["p"]["AQP_EXC_REAL"]>0)
                            "porcentajeE":"{{number_format(($item["AQP_EXC_REAL"]*100)/$item["p"]["AQP_EXC_REAL"],1,".","")}}",
                                @else
                                    "porcentajeE":"-",

                                @endif

                                        @if($item["p"]["AQP_EXC_MONTO"]>0)
                                    "porcentajeP":"{{number_format(($item["AQP_EXC_MONTO"]*100)/$item["p"]["AQP_EXC_MONTO"],1,".","")}}"
                                @else
                                    "porcentajeP":"-"
                        @endif


                        <?php
                            if($i<$n){
                            ?>
                            ,"dashLengthColumn": 5,
                            "alpha": 0.2}
                        <?php
                        }else{
                        ?>
                        {{"}"}}
                        <?php  }?>

                        <?php
                        if($i<$n){
                            echo ",";
                        }
                        $i++;
                        ?>@endforeach

                        ]
                        } );
                    </script>

                    <!-- HTML -->
                    <div id="chartdiv4" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>


    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Corporativo </span>
                        <span class="caption-helper">Control presupuestal mensual</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                <?php

                $n=count($char1);
                $i=1;
                ?>



                <!-- Chart code -->
                    <script>
                        var chart5 = AmCharts.makeChart( "chartdiv5",{
                            "type": "serial",
                            "categoryField": "date",
                            "dataDateFormat": "YYYY-MM",
                            "language": "es",

                            "theme": "light",
                            "export": {
                                "enabled": true
                            },
                            "categoryAxis": {
                                "minPeriod": "MM",
                                "parseDates": true
                            },
                            "chartCursor": {
                                "enabled": true,
                                "categoryBalloonDateFormat": "MMM YYYY"
                            },
                            "chartScrollbar": {
                                "enabled": true
                            },
                            "trendLines": [],
                            "graphs": [
                                {
                                    "bullet": "round",
                                    "id": "AmGraph-3",
                                    "title": "Ejecutado Ingreso",
                                    "valueField": "column-3","dashLength": 3

                                },{
                                    "bullet": "round",
                                    "id": "AmGraph-1",
                                    "title": "Ejecutado Gastos",
                                    "valueField": "column-1",
                                    "balloonText": "<b>[[porcentajeE]]%<b>",
                                    "dashLength": 3
                                },

                                {
                                    "bullet": "square",
                                    "id": "AmGraph-4",
                                    "title": "Presupuestado Ingreso",
                                    "valueField": "column-4"
                                },
                                {
                                    "bullet": "square",
                                    "id": "AmGraph-2",
                                    "title": "Presupuestado Gastos",
                                    "valueField": "column-2",
                                    "balloonText": "<b>[[porcentajeP]]%<b>"

                                }

                            ],
                            "guides": [],
                            "valueAxes": [],
                            "allLabels": [],
                            "balloon": {},
                            "legend": {
                                "enabled": true,
                                "useGraphSettings": true
                            },
                            "titles": [],
                            "dataProvider": [
                                @foreach($char1 as $item)
                                        {{"{"}}
                                    "date": "{{substr($item["mes"],0,4)."-".substr($item["mes"],4,2)}}",
                            "column-1": {{$item["EXC_REAL"]}},

                        "column-2": {{$item["U_EXC_MONTO"]}},

                        @if($item["p"]["EXC_REAL"]>0)
                            "porcentajeE":"{{number_format(($item["EXC_REAL"]*100)/$item["p"]["EXC_REAL"],1,".","")}}",
                                @else
                                    "porcentajeE":"-",

                                @endif

                                        @if($item["p"]["U_EXC_MONTO"]>0)
                                    "porcentajeP":"{{number_format(($item["U_EXC_MONTO"]*100)/$item["p"]["U_EXC_MONTO"],1,".","")}}",
                                @else
                                    "porcentajeP":"-",
                                @endif


                                    "column-3": {{$item["p"]["EXC_REAL"]}},
                        "column-4": {{$item["p"]["U_EXC_MONTO"]}}
                        <?php
                        if($i<$n){
                        ?>
                        ,"dashLengthColumn": 5,
                            "alpha": 0.2}
                        <?php
                        }else{
                        ?>
                        {{"}"}}
                        <?php  }?>
                        <?php
                        if($i<$n){
                            echo ",";
                        }
                        $i++;
                        ?>@endforeach
                        ]
                        }


                        );
                    </script>

                    <!-- HTML -->
                    <div id="chartdiv5" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>


        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Corporativo </span>
                        <span class="caption-helper">Control presupuestal acumulado</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                <?php

                $n=count($char2);
                $i=1;
                ?>


                <!-- Resources -->

                    <!-- Chart code -->
                    <script>
                        var chart6 = AmCharts.makeChart( "chartdiv6",{
                            "type": "serial",
                            "categoryField": "date",
                            "language": "es",

                            "dataDateFormat": "YYYY-MM",
                            "theme": "light",
                            "export": {
                                "enabled": true
                            },
                            "categoryAxis": {
                                "minPeriod": "MM",
                                "parseDates": true
                            },
                            "chartCursor": {
                                "enabled": true,
                                "categoryBalloonDateFormat": "MMM YYYY"
                            },
                            "chartScrollbar": {
                                "enabled": true
                            },
                            "trendLines": [],
                            "graphs": [
                                {
                                    "id": "AmGraph-3",
                                    "title": "Ejecutado Ingresos",
                                    "valueField": "column-3",
                                    "bullet": "round","dashLength": 3
                                },{
                                    "id": "AmGraph-1",
                                    "title": "Ejecutado Gastos",
                                    "valueField": "column-1",
                                    "bullet": "round",
                                    "balloonText": "<b>[[porcentajeE]]%<b>"
                                    ,"dashLength": 3

                                },
                                {
                                    "id": "AmGraph-4",
                                    "title": "Presupuestado Ingresos",
                                    "valueField": "column-4",
                                    "bullet": "square"
                                },
                                {
                                    "id": "AmGraph-2",
                                    "title": "Presupuestado Gastos",
                                    "valueField": "column-2",
                                    "bullet": "square",
                                    "balloonText": "<b>[[porcentajeP]]%<b>",

                                }
                            ],
                            "guides": [],
                            "valueAxes": [],
                            "allLabels": [],
                            "balloon": {},

                            "legend": {
                                "enabled": true,
                                "useGraphSettings": true
                            },
                            "titles": [],
                            "dataProvider": [
                                @foreach($char2 as $item)
                                        {{"{"}}
                                    "date": "{{substr($item["mes"],0,4)."-".substr($item["mes"],4,2)}}",
                            "column-1": {{$item["EXC_REAL"]}},
                        "column-2": {{$item["U_EXC_MONTO"]}},
                        "column-3": {{$item["p"]["EXC_REAL"]}},
                        "column-4": {{$item["p"]["U_EXC_MONTO"]}},
                        @if($item["p"]["EXC_REAL"]>0)
                            "porcentajeE":"{{number_format(($item["EXC_REAL"]*100)/$item["p"]["EXC_REAL"],1,".","")}}",
                                @else
                                    "porcentajeE":"-",

                                @endif

                                        @if($item["p"]["U_EXC_MONTO"]>0)
                                    "porcentajeP":"{{number_format(($item["U_EXC_MONTO"]*100)/$item["p"]["U_EXC_MONTO"],1,".","")}}"
                        @else
                            "porcentajeP":"-"
                        @endif


                        <?php
                            if($i<$n){
                            ?>
                            ,"dashLengthColumn": 5,
                            "alpha": 0.2}
                        <?php
                        }else{
                        ?>
                        {{"}"}}
                        <?php  }?>

                        <?php
                        if($i<$n){
                            echo ",";
                        }
                        $i++;
                        ?>@endforeach

                        ]
                        } );
                    </script>

                    <!-- HTML -->
                    <div id="chartdiv6" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>


    </div>
 <script language="JavaScript">
    $('.header').click(function(){
        $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
    });
</script>