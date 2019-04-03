@extends('layout.app4')

@section('cabecera')



    <style>
        #tabla1{
            font-size: 10px;
        }
        #tabla1 tr{
            font-size: 10px;
        }
        #tabla1 tr th{
            font-size: 10px;
        }
        #tabla1 tr td{
            font-size: 10px;
        }
    </style>

@endsection


@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Listado de Requerimientos</span>
                    </div>

                </div>
                <div class="portlet-body">
    <table id="tabla1" class="table table-bordered table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th> Fecha Doc</th>

            <th> Empresa</th>
            <th> Glosa </th>
            <th> Monto </th>

            <th> PRE</th>
            <th> COM</th>
            <th> ARE</th>
            <th> GG/GAF</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        ?>

        @foreach($orden as $item)
            <?php
            $i++;
            ?>

            <tr>
                <td>{{$item["DocNum"]}}</td>
                <td> {{$item["DocDate"]}}</td>

                <td>{{$item["CardName"]}}</td>
                <td>{{$item["Comments"]}}</td>
                <td style="text-align: right">{{$item["DocCur"]}}

                    <?php


                    $porciones = explode(".", $item["DocTotal"]);
                    // echo $porciones[0]; // porción1
                    //echo $porciones[1]; // porción2


                    ?>
                    {{$porciones[0]}}.{{substr($porciones[1],0,2)}}

                </td>
                <td style="font-size: 28px">

                    @if($item["U_EXC_AUTPRE"]=='P')
                          <a href="javascript:;" data-id="{{$item["DocEntry"]}}" data-action="1" class="btn_p" >  <i class="fa fa-clock-o font-yellow "></i></a>
                    @else
                        @if($item["U_EXC_AUTPRE"]=='Y')
                              <i class="fa fa-check-circle-o font-green   "></i>
                        @endif
                        @if($item["U_EXC_AUTPRE"]=='N')
                                  <i class="fa fa-times-circle font-red   "></i>
                        @endif
                    @endif

                </td>

                <td style="font-size: 28px">
                    @if($item["U_EXC_AUTCOM"]=='P')
                        <a href="javascript:;" data-id="{{$item["DocEntry"]}}" data-action="2" class="btn_p" >
                        <i class="fa fa-clock-o font-yellow   "></i>
                        </a>
                    @else
                        @if($item["U_EXC_AUTCOM"]=='Y')

                            <i class="fa fa-check-circle-o font-green  "></i>

                        @endif
                        @if($item["U_EXC_AUTCOM"]=='N')

                                <i class="fa fa-times-circle font-red   "></i>

                        @endif
                    @endif
                </td>
                <td style="font-size: 28px">
                    @if($item["U_EXC_AUTGER"]=='P')
                        <a href="javascript:;" data-id="{{$item["DocEntry"]}}" data-action="3" class="btn_p" >

                        <i class="fa fa-clock-o font-yellow  "></i>
                        </a>
                    @else
                        @if($item["U_EXC_AUTGER"]=='Y')

                            <i class="fa fa-check-circle-o font-green  "></i>
                         @endif
                        @if($item["U_EXC_AUTGER"]=='N')

                                <i class="fa fa-times-circle font-red   "></i>

                        @endif
                    @endif

                </td>
                <td style="font-size: 28px">
                    @if($item["U_EXC_AUTGGF"]=='P')
                        <a href="javascript:;" data-id="{{$item["DocEntry"]}}" data-action="4" class="btn_p" >

                        <i class="fa fa-clock-o font-yellow  "></i>
                        </a>
                    @else
                        @if($item["U_EXC_AUTGGF"]=='Y')

                            <i class="fa fa-check-circle-o font-green  "></i>

                        @endif
                        @if($item["U_EXC_AUTGGF"]=='N')

                                <i class="fa fa-times-circle font-red   "></i>

                        @endif
                    @endif

                </td>


            </tr>
        @endforeach

        </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section ('script')

    <script language="javascript">
        var url="{{route("orden.store")}}";
        $.extend( $.fn.dataTable.defaults, {
            responsive: true
        } );

        $('#tabla1').DataTable({
            columnDefs: [
                { type: 'date-eu', targets: 1 }
            ],

            "order": [[ 1, "desc" ]],
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });





        $(document).on('click', ".btn_p", function() {

            var dato=$(this)
            var x=dato.data("action");
            var docEntry=dato.data("id");

            if(x=="1"){
                mens="Autorizado Presupuesto";
            }
            if(x=="2"){
                mens="Autorizado Jefe de Compra";
            }
            if(x=="3"){
                mens="Autorizado Gerente de area";
            }
            if(x=="4"){
                mens="Autorizado GG";
            }


            bootbox.prompt({
                title: mens,
                inputType: 'select',
                inputOptions: [

                    {
                        text: 'Autorizado',
                        value: 'Y',
                    },
                    {
                        text: 'Denegado',
                        value: 'X',
                    }
                ],
                callback: function (result) {



if((result=="Y")||(result=="X")) {
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {DocEntry: docEntry, tipo: x, valor: result},

        success: function (msg) {


            if (msg["estado"] == "ok") {
                swal("Ok!", "Se creo el documento correctamente!", "success");

                location.reload();


            } else {

                if (msg["estado"] == "reg") {
                    swal("Ups!", "Codigo de articulo no valido!", "warning");

                } else {
                    swal("Ups!", "Servidor SAP no disponible!", "warning");

                }


            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            swal("Servidor no disponible!", "Por favor intente en unos minutos", "error");
        }
    });
}





                 }
            });

        });





    </script>
@endsection