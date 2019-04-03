@extends('layout.app4')

@section('cabecera')

<style>
    #table1  th {
        font-size: 11px !important;
        font-weight: bold;
    }
    #table1  tr {
         font-size: 11px !important;
     }
    #table1 tr td {
        font-size: 11px !important;
    }
</style>

@endsection


@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                 <div class="portlet-body">
                    <div class="table">
                        <table class="table table-hover table-bordered " id="table1"  >
                            <thead>
                            <tr >
                                 <th colspan="5" > </th>

                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th><th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>

                            </tr>
                            <tr style="background-color: #b9dff2">
                                 <th colspan="5"  >1- Ingresos por servicios educativos </th>


                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th><th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>

                            </tr>


                            </thead>
                            <tbody>


<?php

        $esp="";
?>

                            @foreach($n1 as $deta1)

                                @if($esp!=$deta1["lineaN"])
                                <tr>
                                    <th><i class="fa fa-chevron-up"></i> </th>
                                    <th colspan="4" > {{$deta1["lineaN"]}}  </th>

                                    <th>  </th>
                                    <th>  </th>
                                    <th>  </th>
                                    <th>  </th>
                                    <th>  </th>
                                    <th> </th>
                                    <th>  </th>
                                    <th>  </th>
                                    <th> </th>

                                </tr>
                                    <?php
                                    $esp=$deta1["lineaN"];
                                    ?>
                                @endif


                                <tr class="header">
                                    <td>   </td>

                                    <td>  @if((($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_MONTO"])>0))
                                            <i class="fa fa-chevron-up" style="color:blue"></i>
                                        @else
                                            <i class="fa fa-chevron-down" style="color:red"></i>
                                        @endif </td>

                                    <td  colspan="3"  >{{$deta1->especialidadN}} </td>

                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_REAL"],2,".","")}} </td>
                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_MONTO"],2,".","")}}  </td>
                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_MONTO"],2,".","")}}  </td>

                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_REAL"],2,".","")}} </td>
                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_MONTO"],2,".","")}}  </td>
                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_MONTO"],2,".","")}}  </td>


                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_REAL"],2,".","")}} </td>
                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_MONTO"],2,".","")}}  </td>
                                    <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_MONTO"],2,".","")}}  </td>


                                    </td>

                                </tr>
                                @foreach($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["presupuesto"] as $item)

                                    <tr

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

                                        <td class="text-right">{{number_format($item["CIT_EXC_REAL"],2,".",",")}} </td>
                                        <td class="text-right">{{number_format($item["CIT_EXC_MONTO"],2,".",",")}}  </td>
                                        <td class="text-right">{{number_format($item["CIT_EXC_REAL"]-$item["CIT_EXC_MONTO"],2,".",",")}}  </td>


                                        <td class="text-right">{{number_format($item["AQP_EXC_REAL"],2,".",",")}} </td>
                                        <td class="text-right">{{number_format($item["AQP_EXC_MONTO"],2,".",",")}}  </td>
                                        <td class="text-right">{{number_format($item["AQP_EXC_REAL"]-$item["AQP_EXC_MONTO"],2,".",",")}}  </td>


                                        </td>

                                    </tr>


                                @endforeach


                             @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection
@section ('script')


@endsection
