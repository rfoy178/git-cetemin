@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />



@endsection


@section('main-content')





    <div class="modal fade" id="modalCambios"   role="dialog"  >
        <div class="modal-dialog" role="document">
            <div class="modal-content"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Historial de cambios</h4>
                </div>
                <div class="modal-body"  >

                    <div class="row">
                        <div class="col-xs-12">

                            <b>Modulos RQ </b> <small>v1.1 06-12-2018</small>
                            <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                <li>
                                    <i class="fa fa-trash"></i> Se quito la opcion de prioridad cuando se crea el RQ </li>
                                <li>
                                    <i class="fa fa-calendar"></i> La fecha necesaria para el RQ es de 10 dias habiles, se bloqueo los dias anteriores en el calendario </li>
                                <li>
                                    <i class="fa fa-search"></i> Se optimizo el tiempo de busqueda de articulos</li>

                                <li>
                                    <i class="fa fa-check"></i> Si el articulo no esta en la lista, solo digitalo se agregara como nuevo</li>
                                <li>
                                    <i class="fa fa-info-circle"></i> Se muestra el precio referencial obtenido de SAP</li>
                                <li>
                                    <i class="fa fa-exclamation-triangle"></i> El precio de referencial es necesario, si no se muestra debe ingresarlo  </li>

                                <li>
                                    <i class="fa fa-check"></i>Se corrigió el BUG "doble aprobacion de jefe directo"   </li>

                                <li>
                                    <i class="fa fa-envelope"></i>Se incluyo el detalle del RQ en el correo de aprobación   </li>


                            </ul>
                            </ul>



                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xs-12">

                            <b>Modulos RQ </b> <small>v1.0 25-09-2018</small>
                            <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                <li>
                                    <i class="fa fa-rocket"></i> Lanzamiento </li>

                            </ul>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





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

                    <!--
                    <div class="note note-info">

                        <h4 class="block">Actualización!</h4>
                        <p> Se realizaron cambio en el formulario de requerimientos.</p>

                        <p>
                            <a class="btn red" data-toggle="modal" href="#modalCambios" >Ver cambios</a>
                         </p>


                    </div>

-->

                    <div class="table-scrollable">



                        <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> </th>

                                <th> Codigo </th>
                                <th> Area </th>


                                <th> Fecha <br>Necesaria </th>
                                <th> Fecha <br>Aprobación </th>
                                <th> Fecha <br>Atención Logistica </th>

                                <th> Motivo </th>

                                <th> Usuario </th>
                                <th> Status </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])


                            <?php  $ii=$rq->currentPage();
                            $i=1;?>
                            @foreach($rq as $item)
                             <tr>
                                <td style="font-size: smaller"> <?php echo $i+(($ii-1)*25); ?> </td>
                                 <td style="font-size: smaller">@if($item->urgente==1) <i class="fa fa-exclamation-circle font-red popovers "   data-trigger="hover"  data-container="body" data-content="Este requerimiento fue marcado como urgente" data-original-title="Ayuda"></i>@endif </td>



                                 <td style="font-size: smaller"><a href="{{route("rq.show",$item->id)}}"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}}</a>
                                </td>
                                <td style="font-size: smaller"> {{$item->area->area}}</td>



                                <td style="font-size: smaller"> {{$item->fecha}} </td>


                                 <td style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>




                                 <td style="font-size: smaller"> {{$item->logistica}} </td>


                                 <td style="font-size: smaller"> {{$item->comentario}} </td>

                                 <td style="font-size: smaller"> {{$item->usuario->name}} {{$item->usuario->apellidos}} </td>

                                <td style="font-size: smaller">
                                    <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if(($item->estado==4)&&($item->cotizacion>0)) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                </td>


                                <td style="font-size: smaller">

                                    @if($item->user_id==\Auth::user()->id)
                                        @if(($item->estado==1)||($item->estado==0)||($item->estado==6))

                                        <a href="{{route("requerimiento.editar_estado",['id' =>$item->id ,'valor' => 0])}}" >
                                        <i class="fa fa-edit"></i></a>
                                    @endif
                                    @endif

                                        @if($item->usuario->jefe==\Auth::user()->id)
                                            @if($item->estado==1)
                                            <a href="#" onclick="estado('{{route('requerimiento.editar_estado',['id'=>$item->id ,'estado'=>2])}}')" class="btn btn-xs   green">
                                                <i class="glyphicon glyphicon-ok"> </i>
                                            </a>
                                            <a href="#" onclick="estado('{{route('requerimiento.editar_estado',['id'=>$item->id ,'estado'=>3])}}')" class="btn btn-xs   red">
                                                <i class="glyphicon glyphicon-remove"> </i>
                                            </a>
                                            @endif
                                        @endif
                                        @if($item->usuario->area==13)
                                            @if($item->estado==1)
                                                <a href="#" onclick="estado('{{route('requerimiento.editar_estado',['id'=>$item->id ,'estado'=>2])}}')" class="btn btn-xs   green">
                                                    <i class="glyphicon glyphicon-ok"> </i>
                                                </a>
                                                <a href="#" onclick="estado('{{route('requerimiento.editar_estado',['id'=>$item->id ,'estado'=>3])}}')" class="btn btn-xs   red">
                                                    <i class="glyphicon glyphicon-remove"> </i>
                                                </a>
                                            @endif
                                        @endif
                                        <a href="javascript:;" data-id="{{$item->id}}" class="       btnConfirmar "  data-placement="left"  data-toggle="confirmation"  data-btn-ok-label="Continuar" data-btn-ok-class="btn-success"
                                       data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                                       data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger"
                                       data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?">
                                        <i class="fa fa-trash-o"></i></a>




                                </td>
                            </tr>
                                <?php $i++; ?>
                            @endforeach
                            @else
                        <td colspan="7"><div class="note note-danger">
                                <h4 class="block">Alerta! </h4>
                                <p>  Ud. no tiene permiso para ver esto  </p>
                            </div></td>
                                @endcanatleast

                            </tbody>
                        </table>

                        @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])

                        {{ $rq->links() }}

                        @endcanatleast


                    </div>


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

                                    //location.reload();

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



        var del="{{route("rq.destroy","x")}}";
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