@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />



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

                     <div class="table-scrollable">





                        <table class="table table-hover table-light"  id="tbl-tesoreria">
                            <thead>
                            <tr>
                                <td>   </td>
                                <th> Fecha Aprobación </th>
                                <th> Codigo </th>

                                <th> ER </th>

                                <th> Area </th>
                                <th> Beneficiario </th>
                                <th> Asunto </th>
                                <th> Fecha Necesaria </th>
                                <th> Solicitante </th>

                                <th> Monto S/ </th>
                                <th> Estado</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if  (\Auth::user()->tipo==2)
                            <?php
                            $i=0;
                            ?>
                            @foreach($rq as $item)

                                <?php
                                $i++;
                                ?>
                                <tr>
                                    <td>{{$i}}   </td>
                                    <td style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>
                                    <td>
                                        <a href="{{route("caja.show",$item->id)}}">
                                            <span class="label label-sm label-success"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}} </span></a>
                                    </td>


                                    <td>
                                        {{$item->caja}}
                                    </td>


                                    <td style="font-size: smaller">
                                        <strong>
                                            @if($item->usuario->sede_id==1)
                                                LIM
                                            @else
                                                AQP
                                            @endif</strong> <br>
                                        {{$item->area->area}} </td>

                                    <td style="font-size: smaller"> <strong>{{$item->dni}}</strong><br>{{$item->nombre}}  </td>



                                    <td  style="font-size: smaller"> {{$item->descripcion}} </td>
                                    <td style="font-size: smaller"> {{$item->fecha_necesaria}} </td>
                                    <td style="font-size: smaller"> {{$item->usuario->name}}   </td>



                                    <td style="text-align: right;font-size: smaller">
                                        {{number_format($item->monto,2,".",",")}}
                                    </td>

                                    <td style="text-align: right;font-size: smaller">                                        <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if($item->cotizacion>0) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                                @else

                                @canatleast(['tesoreria','lista.rq.usuario','lista.rq.area'])
                                <?php
                                $i=0;
                                ?>
                                @foreach($rq as $item)

                                    <?php
                                    $i++;
                                    ?>
                                    <tr>
                                        <td>{{$i}}   </td>
                                        <td style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>
                                        <td>
                                            <a href="{{route("caja.show",$item->id)}}">
                                                <span class="label label-sm label-success"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}} </span></a>
                                        </td>


                                        <td>
                                            {{$item->caja}}
                                        </td>


                                        <td style="font-size: smaller">
                                            <strong>
                                                @if($item->usuario->sede_id==1)
                                                    LIM
                                                @else
                                                    AQP
                                                @endif</strong> <br>
                                            {{$item->area->area}} </td>

                                        <td style="font-size: smaller"> <strong>{{$item->dni}}</strong><br>{{$item->nombre}}  </td>



                                        <td  style="font-size: smaller"> {{$item->descripcion}} </td>
                                        <td style="font-size: smaller"> {{$item->fecha_necesaria}} </td>
                                        <td style="font-size: smaller"> {{$item->usuario->name}}   </td>



                                        <td style="text-align: right;font-size: smaller">
                                            {{number_format($item->monto,2,".",",")}}
                                        </td>

                                        <td style="text-align: right;font-size: smaller">                                        <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if($item->cotizacion>0) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach



                                @else
                                    <td colspan="7"><div class="note note-danger">
                                            <h4 class="block">Alerta! </h4>
                                            <p>  Ud. no tiene permiso para ver esto  </p>
                                        </div></td>
                                    @endcanatleast
                                @endif


                            </tbody>
                        </table>


                    </div>

                    {{ $rq->links() }}

                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
@section ('script')

    <script language="JavaScript">



        function estado( ruta){



            bootbox.confirm({
                title: "CETEMIN",
                message: "¿Estas seguro?.",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancelar'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirmar'
                    }
                },
                callback: function (result1) {

                    if(result1){


                        bootbox.prompt({
                            title: "Escriba un mensaje [Opcional]",
                            inputType: 'textarea',
                            buttons: {
                                cancel: {
                                    label: '<i class="fa fa-times"></i> Cancelar'
                                },
                                confirm: {
                                    label: '<i class="fa fa-check"></i> Continuar'
                                }
                            },
                            callback: function (result) {

                                if(result==null) {
                                    console.log("nullll");

                                }else{
                                    $.post( ruta, function( data ) {

                                        location.reload();

                                    });
                                }





                            }
                        });
                    }
                    //  console.log('This was logged in the callback: ' + result);


                }
            });










        }

        $(".btnConfirmar").on("confirmed.bs.confirmation", function() {



            var del="{{route("caja.destroy","x")}}";
            var url=del.replace("x",$(this).data("id"));

            $.ajax({
                url: url,
                type: 'delete',  // user.destroys
                success: function(result) {


                    if(result["error"] ){
                        swal("Ups!", result["msg"], "warning");

                    }else{
                        location.reload();
                    }




                }
            })


        })




    </script>

@endsection