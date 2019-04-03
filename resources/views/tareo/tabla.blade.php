<?php
header("Pragma: public");
header("Expires: 0");
$filename = "nombreArchivoQueDescarga.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

?>
<style>
    #tbl_t{
        font-size: 8px;
    }
    #tbl_t th{
        font-size: 8px;
    }
    #tbl_t td{
        font-size: 8px;
    }
    #tbl_t tr{
        font-size: 8px;
    }
</style>

    <?php

    use Carbon\Carbon;
    $cabezera1="";

    $cabezera2="";

    //dd($cuerpo);

    $cuerpo ="";

    $i=0;

    $fecha = explode("-", $inicio);



    $fechaf = explode("-", $fin);

    $dt = Carbon::create($fecha[2], $fecha[1], $fecha[0],0);



    $dtf = Carbon::create($fechaf[2], $fechaf[1], $fechaf[0],0);

    $dtf=$dtf->addDay()

    ?>

    @while ($dt->eq($dtf)==false )



        <?php

        $cabezera1=$cabezera1.'<td colspan="2" align="center">'.$dt->format("d-m-Y").'</td>';

        $cabezera2=$cabezera2.'<td width="4%" align="center"><strong>E</strong></td><td width="4%" align="center"><strong>S</strong></td>';

        ?>



        <?php $dt=$dt->addDay()?>

    @endwhile






<table width="100%" border="0" cellspacing="0"  id="tbl_t" class="table table-bordered table-hover">

    <tbody>

    <tr bgcolor="#D6D6D6">

        <td width="2%" rowspan="2"><strong>#</strong></td>
        <td width="44%" rowspan="2"><strong>DNI</strong></td>

        <td width="44%" rowspan="2" STYLE="min-width: 250px"> <strong>APELLIDOS Y NOMBRES</strong></td>






        {!! $cabezera1  !!}





    </tr>

    <tr bgcolor="#D6D6D6">





        {!! $cabezera2  !!}








    </tr>

    @foreach ($alumnos as $item )
        <tr>

            <td align="center">{{$i}}</td>
            <td align="center">{{$item["dni"]}} </td>

            <td>{{$item["nombre"]}}</td>


            <?php



            $cuerpo ="";

            //$i=0;

            $fecha = explode("-", $inicio);



            $fechaf = explode("-", $fin);



            $dt = Carbon::create($fecha[2], $fecha[1], $fecha[0],0);



            $dtf = Carbon::create($fechaf[2], $fechaf[1], $fechaf[0],0);

            $dtf=$dtf->addDay();
$cEntrada=0;
            ?>

            @while ($dt->eq($dtf)==false )

                <?php
                $color="";
                $cw=0;
                $t1=" ";

                if (isset($asistencia["A".$item["dni"]]["D".$dt->format("Y-m-d")]["M"])){

                    $t1=$asistencia["A".$item["dni"]]["D".$dt->format("Y-m-d")]["M"];

                }else{

                    if($dt->dayOfWeekIso<6){
                        $cEntrada++;

                    }else{
                        $cw=1;

                    }
                }

                $t2=" ";

                if (isset($asistencia["A".$item["dni"]]["D".$dt->format("Y-m-d")]["T"])){

                    $t2=$asistencia["A".$item["dni"]]["D".$dt->format("Y-m-d")]["T"];

                }



                if (isset($asistencia["A".$item["dni"]]["D".$dt->format("Y-m-d")]["MT"])){

                    $color=$asistencia["A".$item["dni"]]["D".$dt->format("Y-m-d")]["MT"];

                }



                if($cw==1){
                $color="background-color:#ffeb3b66";
                    $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t2.'</td>';
                }else{
                    $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" >'.$t2.'</td>';

                }


                if (isset($asistencia["A".$item["dni"]]["D"])){
                    $minuto=$asistencia["A".$item["dni"]]["D"];

                }else{
                    $minuto=0;

                }

                ?>



                <?php $dt=$dt->addDay()?>

            @endwhile



            {!! $cuerpo  !!}
            <!--<td align="center" nowrap="nowrap" >{{$minuto}}</td>
            <td align="center" nowrap="nowrap" >{{$cEntrada}}</td>
-->


        </tr>
        <?php $i++;?>
    @endforeach

    </tbody>

</table>

