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



                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <ul class="nav nav-tabs tabs-left">

                                @foreach($area as $item)

                                    <li class=" ">
                                        <a href="#tab_6_{{$item->id}}" data-toggle="tab"> {{$item->area}} </a>
                                    </li>


                                @endforeach


                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="tab-content">



                                @foreach($area as $item)



                                    <div class="tab-pane  " id="tab_6_{{$item->id}}">
                                        <p>{{$item->area}} </p>
                                    </div>



                                @endforeach



                            </div>
                        </div>
                    </div>




                    <div class="tabbable tabbable-tabdrop">
                        <ul class="nav nav-tabs">
                            @foreach($area as $item)
                            <li class=" ">
                                <a href="#tab{{$item->id}}" data-toggle="tab">{{$item->area}}</a>
                            </li>
                            @endforeach

                        </ul>
                        <div class="tab-content">

                            @foreach($area as $item)

                                <div class="tab-pane  " id="tab{{$item->id}}">
                                    <p> {{$item->area}} </p>
                                </div>
                            @endforeach




                        </div>
                    </div>
                    <div class="table-scrollable">



                        <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Codigo </th>
                                <th> Area </th>

                                @if(Auth::user()->area==13)

                                <th> Fecha Creación </th>
                                @endif
                                <th> Fecha Necesaria </th>
                                <th> Fecha Aprobación </th>

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
                                <td> <?php echo $i+(($ii-1)*25); ?> </td>
                                <td><a href="{{route("rq.show",$item->id)}}"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}}</a>
                                </td>
                                <td> {{$item->area->area}}</td>

                                 @if(Auth::user()->area==13)
                                     <td> {{$item->created_at}} </td>
                                 @endif

                                <td> {{$item->fecha}} </td>


                                 <td> {{$item->fecha_aprobacion}} </td>

                                 <td> {{$item->usuario->name}} {{$item->usuario->apellidos}} </td>

                                <td>
                                    <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if($item->cotizacion>0) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                </td>


                                <td>

                                    @if($item->user_id==\Auth::user()->id)
                                        @if(($item->estado==1)||($item->estado==0))

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