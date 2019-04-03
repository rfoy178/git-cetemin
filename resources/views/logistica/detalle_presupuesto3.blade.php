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
                    <div class="table table-scrollable">
                        <table class="table table-hover table-bordered " id="table1"  >
                            <thead>
                            <tr>
                                <th colspan="6" > </th>
                                <th  colspan="3" style="text-align: center">LIMA </th>
                                <th class=" active"  colspan="3" style="text-align: center">CITE </th>
                                <th  colspan="3" style="text-align: center">AREQUIPA </th>
                                <th  class=" active" colspan="3" style="text-align: center">CORPORATIVO </th>
                            </tr>
                            <tr>
                                <th colspan="6" > </th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th class=" active">Ejecutado </th>
                                <th class=" active">Presupuestado </th>
                                <th class=" active">Diferencia</th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th class=" active">Ejecutado </th>
                                <th class=" active">Presupuestado </th>
                                <th class=" active">Diferencia</th>
                            </tr>
                            <tr style="background-color: #b9dff2">
                                <th><i class="fa fa-plus-square"></i> </th>
                                <th colspan="5"  >1- Ingresos por servicios educativos </th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th>Ejecutado </th>
                                <th>Presupuestado </th>
                                <th>Diferencia</th>
                                <th>Ejecutado </th>
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
                                <tr id="tr-{{$deta1["linea"]}}">
                                    <th><i class="fa fa-plus-square tree" data-id="trI{{$deta1->linea}}"></i> </th>


                                    <th><i class="fa fa-chevron-up"></i> </th>
                                    <th colspan="4" > {{$deta1["lineaN"]}}  <img id="img{{$deta1["linea"]}}" src="{{asset("load.gif")}}"> </th>

                                    <th><div style="text-align: right" id="D{{$deta1->linea}}I1"><img   src="{{asset("load.gif")}}"></div> </th>
                                    <th><div style="text-align: right" id="D{{$deta1->linea}}I2"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th><div style="text-align: right" id="D{{$deta1->linea}}I3"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th  class=" active"><div style="text-align: right" id="D{{$deta1->linea}}I4"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th class=" active"><div style="text-align: right" id="D{{$deta1->linea}}I5"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th class=" active"><div style="text-align: right" id="D{{$deta1->linea}}I6"><img   src="{{asset("load.gif")}}"></div> </th>
                                    <th><div style="text-align: right" id="D{{$deta1->linea}}I7"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th><div  style="text-align: right" id="D{{$deta1->linea}}I8"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th><div  style="text-align: right" id="D{{$deta1->linea}}I9"><img   src="{{asset("load.gif")}}"></div> </th>
                                    <th class=" active"><div  style="text-align: right" id="D{{$deta1->linea}}I10"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th class=" active"><div  style="text-align: right" id="D{{$deta1->linea}}I11"><img   src="{{asset("load.gif")}}"></div>  </th>
                                    <th class=" active"><div  style="text-align: right" id="D{{$deta1->linea}}I12"><img   src="{{asset("load.gif")}}"></div> </th>
                                    <th class=" active"><div  style="text-align: right" id="D{{$deta1->linea}}I12"><img   src="{{asset("load.gif")}}"></div> </th>
                                </tr>
                                    <?php
                                    $esp=$deta1["lineaN"];
                                    ?>
                                @endif

                             @endforeach

<tr style="background-color: #b9dff2">
    <th><i class="fa fa-plus-square"></i> </th>

    <th colspan="5"  >2- Costos de servicios educativos</th>


    <th>Ejecutado </th>
    <th>Presupuestado </th>
    <th>Diferencia</th>
    <th>Ejecutado </th>
    <th>Presupuestado </th>
    <th>Diferencia</th>
    <th>Ejecutado </th>
    <th>Presupuestado </th>
    <th>Diferencia</th>

    <th>Ejecutado </th>
    <th>Presupuestado </th>
    <th>Diferencia</th>

</tr>

@foreach($n2 as $deta1)

    @if($esp!=$deta1["lineaN"])
        <tr id="trG-{{$deta1["linea"]}}">
            <th><i class="fa fa-plus-square tree" data-id="trG{{$deta1->linea}}"></i> </th>

            <th><i class="fa fa-chevron-up " ></i> </th>
            <th colspan="4" > {{$deta1["lineaN"]}}  <img id="imgG{{$deta1["linea"]}}" src="{{asset("load.gif")}}"> </th>

            <th> </th>
            <th>  </th>
            <th>  </th>
            <th class=" active">  </th>
            <th class=" active">  </th>
            <th class=" active"> </th>
            <th>  </th>
            <th>  </th>
            <th> </th>
            <th class=" active">  </th>
            <th class=" active">  </th>
            <th class=" active"> </th>

        </tr>
        <?php
        $esp=$deta1["lineaN"];
        ?>
    @endif

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
<script>
<?php
$esp="";
?>

    @foreach($n1 as $deta1)

        @if($esp!=$deta1["lineaN"])


            $.post("http://adm.cetemin.com/public/gyp_detalle", { "linea": "{{$deta1["linea"]}}","tipo":"I","seccion":1})
            .done(function( data ) {

                $("#table1 tbody #tr-{{$deta1["linea"]}}").after(data);
                $("#img{{$deta1["linea"]}}").hide();


            });
            <?php
            $esp=$deta1["lineaN"];
            ?>
        @endif


    @endforeach


            @foreach($n2 as $deta1)

            @if($esp!=$deta1["lineaN"])


            $.post("http://adm.cetemin.com/public/gyp_detalle", { "linea": "{{$deta1["linea"]}}","tipo":"G","seccion":2})
                .done(function( data ) {

                    $("#table1 tbody #trG-{{$deta1["linea"]}}").after(data);
                    $("#imgG{{$deta1["linea"]}}").hide();


                });
    <?php
    $esp=$deta1["lineaN"];
    ?>
    @endif


    @endforeach

    $(document).on('click', ".tree", function() {
        var x;
        var y;

        y=$(this);
        x=$(this).data("id");

        if(y.hasClass("fa-plus-square")){

            y.removeClass("fa-plus-square");
            y.addClass("fa-minus-square");
            $("."+x).show();


        }else{

            y.addClass("fa-plus-square");
            y.removeClass("fa-minus-square");
            $("."+x).hide();

        }



    });




</script>





@endsection
