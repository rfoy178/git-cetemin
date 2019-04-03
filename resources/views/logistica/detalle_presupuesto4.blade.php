@if($i=="I")

    <?php
    $LIM_EXC_REAL=0;
    $t2=0;
    $t3=0;
    $t4=0;
    $t5=0;
    $t6=0;
    $t7=0;
    $t8=0;
    $t9=0;
    $t10=0;
    $t11=0;
    $t12=0;
    ?>
@foreach($n1 as $deta1)

    <tr style="display: none" class="trI{{$deta1->linea}} N3">
        <th> </th>

        <td><i class="fa fa-plus-square tree" data-id="trI{{$deta1->linea}}{{$deta1->especialidad}}"></i></td>

      <td>  @if((($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_MONTO"])>0))
                                            <i class="fa fa-chevron-up" style="color:blue"></i>
                                        @else
                                            <i class="fa fa-chevron-down" style="color:red"></i>
                                        @endif </td>

      <td  colspan="3"  >{{$deta1->especialidadN}} </td>

      <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_REAL"],2,".","")}} </td>
      <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_MONTO"],2,".","")}}  </td>
      <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["LIM_EXC_MONTO"],2,".","")}}  </td>

      <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_REAL"],2,".","")}} </td>
      <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_MONTO"],2,".","")}}  </td>
      <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["CIT_EXC_MONTO"],2,".","")}}  </td>


      <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_REAL"],2,".","")}} </td>
      <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_MONTO"],2,".","")}}  </td>
      <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["AQP_EXC_MONTO"],2,".","")}}  </td>


        <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["EXC_REAL"],2,".","")}} </td>
        <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["U_EXC_MONTO"],2,".","")}}  </td>
        <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["ingresos"]["U_EXC_MONTO"],2,".","")}}  </td>








</tr>
    @foreach($return["1"][$deta1->linea][$deta1->especialidad]["ingresos"]["presupuesto"] as $item)
        <tr style="display: none"  class="trI{{$deta1->linea}}{{$deta1->especialidad}} trI{{$deta1->linea}} N4" >
            <td>   </td>
            <td>   </td>
            <td>  </td>
            <td>
                @if(($item["EXC_REAL"]-$item["U_EXC_MONTO"]>0))
                <i class="fa fa-chevron-up" style="color:blue"></i>
                @else
                <i class="fa fa-chevron-down" style="color:red"></i>
                @endif
            </td>
            <td>{{$item["EXC_CUECON_F"]}} </td>
            <td>{{$item["AcctName"]}} </td>
            <td class="text-right">{{number_format($item["LIM_EXC_REAL"],2,".",",")}} </td>
            <?php
            $LIM_EXC_REAL=$LIM_EXC_REAL+$item["LIM_EXC_REAL"];

            $t2=$t2+$item["LIM_EXC_MONTO"];
            $t3=$t3+($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"]);
            $t4=$t4+$item["CIT_EXC_REAL"];
            $t5=$t5+$item["CIT_EXC_MONTO"];
            $t6=$t6+($item["CIT_EXC_REAL"]-$item["CIT_EXC_MONTO"]);
            $t7=$t7+$item["AQP_EXC_REAL"];
            $t8=$t8+$item["AQP_EXC_MONTO"];
            $t9=$t9+($item["AQP_EXC_REAL"]-$item["AQP_EXC_MONTO"]);
            $t10=$t10+$item["EXC_REAL"];
            $t11=$t11+$item["U_EXC_MONTO"];
            $t12=$t12+($item["EXC_REAL"]-$item["U_EXC_MONTO"]);

            ?>

            <td class="text-right">{{number_format($item["LIM_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right">{{number_format($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right active">{{number_format($item["CIT_EXC_REAL"],2,".",",")}} </td>
            <td class="text-right active">{{number_format($item["CIT_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right active">{{number_format($item["CIT_EXC_REAL"]-$item["CIT_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right">{{number_format($item["AQP_EXC_REAL"],2,".",",")}} </td>
            <td class="text-right">{{number_format($item["AQP_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right">{{number_format($item["AQP_EXC_REAL"]-$item["AQP_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right active">{{number_format($item["EXC_REAL"],2,".",",")}} </td>
            <td class="text-right active">{{number_format($item["U_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right active">{{number_format($item["EXC_REAL"]-$item["U_EXC_MONTO"],2,".",",")}}  </td>
        </tr>
    @endforeach
    <script language="javascript">
        $("#D{{$deta1->linea}}I1").html("{{number_format($LIM_EXC_REAL,2,".",",")}}");
        $("#D{{$deta1->linea}}I2").html("{{number_format($t2,2,".",",")}}");
        $("#D{{$deta1->linea}}I3").html("{{number_format($t3,2,".",",")}}");
        $("#D{{$deta1->linea}}I4").html("{{number_format($t4,2,".",",")}}");
        $("#D{{$deta1->linea}}I5").html("{{number_format($t5,2,".",",")}}");
        $("#D{{$deta1->linea}}I6").html("{{number_format($t6,2,".",",")}}");
        $("#D{{$deta1->linea}}I7").html("{{number_format($t7,2,".",",")}}");
        $("#D{{$deta1->linea}}I8").html("{{number_format($t8,2,".",",")}}");
        $("#D{{$deta1->linea}}I9").html("{{number_format($t9,2,".",",")}}");
        $("#D{{$deta1->linea}}I10").html("{{number_format($t10,2,".",",")}}");
        $("#D{{$deta1->linea}}I11").html("{{number_format($t11,2,".",",")}}");
        $("#D{{$deta1->linea}}I12").html("{{number_format($t12,2,".",",")}}");

    </script>

@endforeach

@else
    @foreach($n1 as $deta1)
        <?php
        $t1=0;
        $t2=0;
        $t3=0;
        $t4=0;
        $t5=0;
        $t6=0;
        $t7=0;
        $t8=0;
        $t9=0;
        $t10=0;
        $t11=0;
        $t12=0;
        ?>

        <tr style="display: none" class="trG{{$deta1->linea}} N3">
            <th><i class="fa fa-plus-square"></i> </th>

            <th>  </th>

            <th> <i class="fa fa-chevron-up"></i> </th>
            <th colspan="3" > {{$deta1->especialidadN}} </th>


            <th  class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_REAL"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_REAL"],2,".",",")}} </th>
            <th  class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_MONTO"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_MONTO"],2,".",",")}}  </th>
            <th  class="text-right">{{number_format(($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_MONTO"]+($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_MONTO"])),2,".",",")}}</th>
            <th  class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_REAL"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_REAL"],2,".",",")}} </th>
            <th  class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_MONTO"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_MONTO"],2,".",",")}}  </th>
            <th  class="text-right active">{{number_format(($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_MONTO"]+($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_MONTO"])),2,".",",")}}</th>
            <th  class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_REAL"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_REAL"],2,".",",")}} </th>
            <th  class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_MONTO"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_MONTO"],2,".",",")}}  </th>
            <th  class="text-right">{{number_format(($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_MONTO"]+($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_MONTO"])),2,".",",")}}</th>
            <th  class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["EXC_REAL"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["EXC_REAL"],2,".",",")}} </th>
            <th  class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["U_EXC_MONTO"]+$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["U_EXC_MONTO"],2,".",",")}}  </th>
            <th  class="text-right active">{{number_format(($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["U_EXC_MONTO"]+($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["U_EXC_MONTO"])),2,".",",")}}</th>


        </tr>

        <tr class="trG{{$deta1->linea}} N4">
            <th> </th>

            <td> <i class="fa fa-plus-square tree" ></i>  </td>

            <td>  @if((($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_MONTO"])>0))
                    <i class="fa fa-chevron-up" style="color:blue"></i>
                @else
                    <i class="fa fa-chevron-down" style="color:red"></i>
                @endif </td>

            <td  colspan="3"  >SUELDOS </td>

            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_REAL"],2,".","")}} </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_MONTO"],2,".","")}}  </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["LIM_EXC_MONTO"],2,".","")}}  </td>

            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_REAL"],2,".","")}} </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_MONTO"],2,".","")}}  </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["CIT_EXC_MONTO"],2,".","")}}  </td>

            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_REAL"],2,".","")}} </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_MONTO"],2,".","")}}  </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["AQP_EXC_MONTO"],2,".","")}}  </td>



            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["EXC_REAL"],2,".","")}} </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["U_EXC_MONTO"],2,".","")}}  </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["sueldo"]["U_EXC_MONTO"],2,".","")}}  </td>



            </td>

        </tr>



        @foreach($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["presupuesto"] as $item)

            <tr style="display: none" class="N4 trS{{$deta1->linea}}{{$deta1->especialidad}} trI{{$deta1->linea}} @if(($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"]>0)) @else danger @endif ">
                <td>   </td>
                <td>   </td>
                <td>  </td>
                <td>
                    @if(($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"]>0))
                        <i class="fa fa-chevron-up" style="color:blue"></i>
                    @else
                        <i class="fa fa-chevron-down" style="color:red"></i>
                    @endif
                </td>
                <td>{{$item["EXC_CUECON_F"]}} </td>
                <td>{{$item["AcctName"]}} </td>
                <td class="text-right">{{number_format($item["LIM_EXC_REAL"],2,".",",")}} </td>
                <td class="text-right">{{number_format($item["LIM_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right">{{number_format($item["LIM_EXC_REAL"]-$item["LIM_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right active">{{number_format($item["CIT_EXC_REAL"],2,".",",")}} </td>
                <td class="text-right active">{{number_format($item["CIT_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right active">{{number_format($item["CIT_EXC_REAL"]-$item["CIT_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right">{{number_format($item["AQP_EXC_REAL"],2,".",",")}} </td>
                <td class="text-right">{{number_format($item["AQP_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right">{{number_format($item["AQP_EXC_REAL"]-$item["AQP_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right active">{{number_format($item["EXC_REAL"],2,".",",")}} </td>
                <td class="text-right active">{{number_format($item["U_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right active">{{number_format($item["EXC_REAL"]-$item["U_EXC_MONTO"],2,".",",")}}  </td>
            </tr>
        @endforeach

        <tr class="header trI{{$deta1->linea}}">
            <th> </th>

            <td><i class="fa fa-plus-square tree"  data-id="trG{{$deta1->linea}}{{$deta1->especialidad}} "></i>   </td>
            <td> @if((($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_MONTO"])>0))
                    <i class="fa fa-chevron-up" style="color:blue"></i>
                @else
                    <i class="fa fa-chevron-down" style="color:red"></i>
                @endif </td>

            <td  colspan="3"  >GASTOS </td>

            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_REAL"],2,".",",")}} </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["LIM_EXC_MONTO"],2,".",",")}}  </td>


            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_REAL"],2,".",",")}} </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["CIT_EXC_MONTO"],2,".",",")}}  </td>

            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_REAL"],2,".",",")}} </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["AQP_EXC_MONTO"],2,".",",")}}  </td>

            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["EXC_REAL"],2,".",",")}} </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["U_EXC_MONTO"],2,".",",")}}  </td>
            <td class="text-right active">{{number_format($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["EXC_REAL"]-$return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["gastos"]["U_EXC_MONTO"],2,".",",")}}  </td>



            </td>

        </tr>
        @foreach($return["1"][$deta1->linea][$deta1->especialidad]["gastos"]["presupuesto2"] as $item)

            <tr style="display: none" class="trG{{$deta1->linea}}{{$deta1->especialidad}} trG{{$deta1->linea}}">
                <td>   </td>

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

                <td class="text-right active">{{number_format($item["CIT_EXC_REAL"],2,".",",")}} </td>
                <td class="text-right active">{{number_format($item["CIT_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right active">{{number_format($item["CIT_EXC_REAL"]-$item["CIT_EXC_MONTO"],2,".",",")}}  </td>


                <td class="text-right">{{number_format($item["AQP_EXC_REAL"],2,".",",")}} </td>
                <td class="text-right">{{number_format($item["AQP_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right">{{number_format($item["AQP_EXC_REAL"]-$item["AQP_EXC_MONTO"],2,".",",")}}  </td>



                <td class="text-right active">{{number_format($item["EXC_REAL"],2,".",",")}} </td>
                <td class="text-right active">{{number_format($item["U_EXC_MONTO"],2,".",",")}}  </td>
                <td class="text-right active">{{number_format($item["EXC_REAL"]-$item["U_EXC_MONTO"],2,".",",")}}  </td>


                </td>

            </tr>

        @endforeach





    @endforeach
@endif