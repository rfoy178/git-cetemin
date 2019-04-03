
<?php

use Carbon\Carbon;
$cabezera1="";
$cabezera2="";
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
    $cabezera1=$cabezera1.'<td colspan="3" align="center">'.$dt->format("d-m-Y").'</td>';
    $cabezera2=$cabezera2.'<td width="15px" align="center"><strong>D</strong></td><td width="15px" align="center"><strong>A</strong></td><td width="15px" align="center"><strong>C</strong></td>';


    $asistencia["T"]["D".$dt->format("Y-m-d")]["D"]=0;
    $asistencia["T"]["D".$dt->format("Y-m-d")]["A"]=0;
    $asistencia["T"]["D".$dt->format("Y-m-d")]["C"]=0;
    $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=0;
    $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=0;
    $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=0;

    ?>


    <?php $dt=$dt->addDay()?>
@endwhile

<style>
    .tabl2 tr{
        font-size: 9px;
    }

    .tabl2 tr td{
        font-size: 9px;
    }
</style>

<h4>Gerencia de Administración y Finanzas</h4>




<table width="100%" border="0" cellspacing="0"  id="tbl_t" class="table tabl2 table-bordered table-hover" style="font-size: 8px">

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





    @foreach($gaf as $alu)



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
            $t2=" ";
            $t3=" ";
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["D"])){
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]+1;

                $t1= "X";


            }
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["A"])){
                $t2="X";
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]+1;

            }
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["C"])){
                $t3="X";
                $asistencia["T"]["D".$dt->format("Y-m-d")]["C"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]+1;

            }

            if($dt->dayOfWeekIso<6){
                $cEntrada++;
            }else{
                $cw=1;
            }

            if($cw==1){
                $color="background-color:#ffeb3b66";
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t2.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t3.'</td>';
            }else{
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" >'.$t2.'</td></td><td align="center" nowrap="nowrap" >'.$t3.'</td>';

            }
            ?>
            <?php $dt=$dt->addDay()?>

        @endwhile

        <?php

        ?>


        <tr>

            <td align="center">{{$i+1}}</td>
            <td align="center">{{str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)}} </td>

            <td> {{$alu["nombre"]}}</td>
            {!! $cuerpo  !!}
        </tr>
        <?php

        ?>


        <?php $i++;?>
    @endforeach

    <?php
    $pie="";
    $dt = Carbon::create($fecha[2], $fecha[1], $fecha[0],0);
    $dtf = Carbon::create($fechaf[2], $fechaf[1], $fechaf[0],0);
    $dtf=$dtf->addDay()
    ?>

    @while ($dt->eq($dtf)==false )
        <?php


        $pie=$pie.'<td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"].'</strong></td>';
        ?>
        <?php
        $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=0;
        $dt=$dt->addDay();
        ?>


    @endwhile


    <tr bgcolor="#D6D6D6">

        <td width="2%" rowspan="2"><strong>#</strong></td>
        <td width="44%" rowspan="2"><strong> </strong></td>
        <td width="44%" rowspan="2" STYLE="min-width: 250px">TOTAL</td>
        {!! $pie  !!}
    </tr>




    </tbody>

</table>

<h4>Gerencia Academica</h4>




<table width="100%" border="0" cellspacing="0"  id="tbl_t" class="table tabl2 table-bordered table-hover" style="font-size: 8px">

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





    @foreach($ga as $alu)



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
            $t2=" ";
            $t3=" ";
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["D"])){
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]+1;

                $t1= "X";


            }
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["A"])){
                $t2="X";
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]+1;

            }


            if($dt->dayOfWeekIso==5)
            {


            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["AC"])){

                if ($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["AC"]>1){


                    $t3="X";
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["C"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C"]+1;
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]+1;
                }

}

            }else{


                if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["C"])){
                    $t3="X";
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["C"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C"]+1;
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]+1;
                }

            }







            if($dt->dayOfWeekIso<6){
                $cEntrada++;
            }else{
                $cw=1;
            }

            if($cw==1){
                $color="background-color:#ffeb3b66";
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t2.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t3.'</td>';
            }else{
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" >'.$t2.'</td></td><td align="center" nowrap="nowrap" >'.$t3.'</td>';

            }
            ?>
            <?php $dt=$dt->addDay()?>

        @endwhile

        <?php

        ?>


        <tr>

            <td align="center">{{$i+1}}</td>
            <td align="center">{{str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)}} </td>

            <td> {{$alu["nombre"]}}</td>
            {!! $cuerpo  !!}
        </tr>
        <?php

        ?>


        <?php $i++;?>
    @endforeach

    <?php
    $pie="";
    $dt = Carbon::create($fecha[2], $fecha[1], $fecha[0],0);
    $dtf = Carbon::create($fechaf[2], $fechaf[1], $fechaf[0],0);
    $dtf=$dtf->addDay()
    ?>

    @while ($dt->eq($dtf)==false )
        <?php


        $pie=$pie.'<td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"].'</strong></td>';
        ?>
        <?php
        $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=0;
        $dt=$dt->addDay();
        ?>


    @endwhile


    <tr bgcolor="#D6D6D6">

        <td width="2%" rowspan="2"><strong>#</strong></td>
        <td width="44%" rowspan="2"><strong> </strong></td>
        <td width="44%" rowspan="2" STYLE="min-width: 250px">TOTAL</td>
        {!! $pie  !!}
    </tr>




    </tbody>

</table>



<h4>Gerencia Comercial</h4>

<table width="100%" border="0" cellspacing="0"  id="tbl_t" class="table tabl2 table-bordered table-hover" style="font-size: 8px">

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





    @foreach($gc as $alu)



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
            $t2=" ";
            $t3=" ";
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["D"])){
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]+1;

                $t1= "X";


            }
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["A"])){
                $t2="X";
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]+1;

            }
            if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["C"])){
                $t3="X";
                $asistencia["T"]["D".$dt->format("Y-m-d")]["C"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]+1;

            }

            if($dt->dayOfWeekIso<6){
                $cEntrada++;
            }else{
                $cw=1;
            }

            if($cw==1){
                $color="background-color:#ffeb3b66";
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t2.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t3.'</td>';
            }else{
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" >'.$t2.'</td></td><td align="center" nowrap="nowrap" >'.$t3.'</td>';

            }
            ?>
            <?php $dt=$dt->addDay()?>

        @endwhile

        <?php

        ?>


        <tr>

            <td align="center">{{$i+1}}</td>
            <td align="center">{{str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)}} </td>

            <td> {{$alu["nombre"]}}</td>
            {!! $cuerpo  !!}
        </tr>
        <?php

        ?>


        <?php $i++;?>
    @endforeach

    <?php
    $pie="";
    $dt = Carbon::create($fecha[2], $fecha[1], $fecha[0],0);
    $dtf = Carbon::create($fechaf[2], $fechaf[1], $fechaf[0],0);
    $dtf=$dtf->addDay()
    ?>

    @while ($dt->eq($dtf)==false )
        <?php


        $pie=$pie.'<td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"].'</strong></td>';
        ?>
        <?php
        $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=0;
        $dt=$dt->addDay();
        ?>


    @endwhile


    <tr bgcolor="#D6D6D6">

        <td width="2%" rowspan="2"><strong>#</strong></td>
        <td width="44%" rowspan="2"><strong> </strong></td>
        <td width="44%" rowspan="2" STYLE="min-width: 250px">TOTAL</td>
        {!! $pie  !!}
    </tr>




    </tbody>

</table>




<h4>Instructores</h4>

<table width="100%" border="0" cellspacing="0"  id="tbl_t" class="table tabl2 table-bordered table-hover" style="font-size: 8px">

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





    @foreach($instructores as $alu)



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
            $t2=" ";
            $t3=" ";
            if (isset($asistencia["A".$alu["C_DNIDOC"]]["D".$dt->format("Y-m-d")]["D"])){
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]+1;

                $t1= "X";


            }
            if (isset($asistencia["A".$alu["C_DNIDOC"]]["D".$dt->format("Y-m-d")]["A"])){
                $t2="X";
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]+1;

            }
            if (isset($asistencia["A".$alu["C_DNIDOC"]]["D".$dt->format("Y-m-d")]["C"])){
                $t3="X";
                $asistencia["T"]["D".$dt->format("Y-m-d")]["C"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C"]+1;
                $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]+1;

            }

            if($dt->dayOfWeekIso<6){
                $cEntrada++;
            }else{
                $cw=1;
            }

            if($cw==1){
                $color="background-color:#ffeb3b66";
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t2.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t3.'</td>';
            }else{
                $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" >'.$t2.'</td></td><td align="center" nowrap="nowrap" >'.$t3.'</td>';

            }
            ?>
            <?php $dt=$dt->addDay()?>

        @endwhile

        <?php

        ?>


        <tr>

            <td align="center">{{$i+1}}</td>
            <td align="center">{{$alu["C_DNIDOC"]}} </td>

            <td> {{$alu["C_APNDOC2"]}}<br>{{$alu["C_NOMCUR"]}}<br>{{$alu["periodo"]}} {{$alu["nomesp"]}} </td>
            {!! $cuerpo  !!}
        </tr>
        <?php

        ?>


        <?php $i++;?>
    @endforeach

    <?php
    $pie="";
    $dt = Carbon::create($fecha[2], $fecha[1], $fecha[0],0);
    $dtf = Carbon::create($fechaf[2], $fechaf[1], $fechaf[0],0);
    $dtf=$dtf->addDay()
    ?>

    @while ($dt->eq($dtf)==false )
        <?php


        $pie=$pie.'<td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"].'</strong></td>';
        ?>
        <?php
        $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=0;
        $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=0;
        $dt=$dt->addDay();
        ?>


    @endwhile


    <tr bgcolor="#D6D6D6">

        <td width="2%" rowspan="2"><strong>#</strong></td>
        <td width="44%" rowspan="2"><strong> </strong></td>
        <td width="44%" rowspan="2" STYLE="min-width: 250px">TOTAL</td>
        {!! $pie  !!}
    </tr>




    </tbody>

</table>




@foreach($js as $item)
    <h4>{{$item["nomesp"]}} {{$item["periodo"]}}  {{$item["C_SECCION"]}}</h4>




    <table width="100%" border="0" cellspacing="0"  id="tbl_t" class="table tabl2 table-bordered table-hover" style="font-size: 8px">

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





        @foreach($item["alumnos"] as $alu)



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
                $t2=" ";
                $t3=" ";
                if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["D"])){
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["D"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D"]+1;
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]+1;

                    $t1= "X";


                }
                if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["A"])){
                    $t2="X";
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["A"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A"]+1;
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]+1;

                }
                if (isset($asistencia["A".str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)]["D".$dt->format("Y-m-d")]["C"])){
                    $t3="X";
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["C"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C"]+1;
                    $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]+1;

                }

                    if($dt->dayOfWeekIso<6){
                        $cEntrada++;
                    }else{
                        $cw=1;
                    }

                if($cw==1){
                    $color="background-color:#ffeb3b66";
                    $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t2.'</td><td align="center" nowrap="nowrap" STYLE="'.$color.'">'.$t3.'</td>';
                }else{
                    $cuerpo=$cuerpo. '<td align="center" nowrap="nowrap" STYLE="'.$color.'">' .$t1.'</td><td align="center" nowrap="nowrap" >'.$t2.'</td></td><td align="center" nowrap="nowrap" >'.$t3.'</td>';

                }
                ?>
                <?php $dt=$dt->addDay()?>

            @endwhile

            <?php

            ?>


            <tr>

                <td align="center">{{$i+1}}</td>
                <td align="center">{{str_pad($alu["dni"], 8, "0", STR_PAD_LEFT)}} </td>

                <td> {{$alu["nombres"]}}</td>
            {!! $cuerpo  !!}
            </tr>
            <?php

            ?>


            <?php $i++;?>
        @endforeach

<?php
$pie="";
$dt = Carbon::create($fecha[2], $fecha[1], $fecha[0],0);
$dtf = Carbon::create($fechaf[2], $fechaf[1], $fechaf[0],0);
$dtf=$dtf->addDay()
?>

        @while ($dt->eq($dtf)==false )
            <?php


            $pie=$pie.'<td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["D2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["A2"].'</strong></td><td width="15px" align="center"><strong>'.$asistencia["T"]["D".$dt->format("Y-m-d")]["C2"].'</strong></td>';
            ?>
            <?php
            $asistencia["T"]["D".$dt->format("Y-m-d")]["D2"]=0;
            $asistencia["T"]["D".$dt->format("Y-m-d")]["A2"]=0;
            $asistencia["T"]["D".$dt->format("Y-m-d")]["C2"]=0;
            $dt=$dt->addDay();
            ?>


        @endwhile


        <tr bgcolor="#D6D6D6">

            <td width="2%" rowspan="2"><strong>#</strong></td>
            <td width="44%" rowspan="2"><strong> </strong></td>
            <td width="44%" rowspan="2" STYLE="min-width: 250px">TOTAL</td>
            {!! $pie  !!}
        </tr>




        </tbody>

    </table>













@endforeach





