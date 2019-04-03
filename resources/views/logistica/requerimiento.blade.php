@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('assets/global/plugins/bootstrap-fileinput-master/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/plugins/piexif.min.js')}}" type="text/javascript"></script>
       <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
       <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/plugins/purify.min.js')}}" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>


        <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/fileinput.min.js')}}"></script>
       <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/themes/fa/theme.js')}}"></script>
     <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/locales/es.js')}}"></script>



    <link href="{{ asset('assets/global/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/global/plugins/ladda/spin.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/ladda/ladda.min.js')}}" type="text/javascript"></script>
    <style>

        #tb-lista tr{
            font-size: 11px;
        }

        #tb-lista th{
            font-size: 11px;
        }
        #tb-lista td{
            font-size: 11px;
        }



         #tb-lista-cc{
             font-size: 10px;
         }
        #tb-lista-cc tr{
            font-size: 10px;
        }
        #tb-lista-cc td{
            font-size: 10px;
        }


        #tb-lista-cc th{
            font-size: 10px;
        }


        #tb-cc{
            font-size: 10px;
        }
        #tb-cc tr{
            font-size: 10px;
        }
        #tb-cc td{
            font-size: 10px;
        }


        #tb-cc th{
            font-size: 10px;
        }
        #tb-cca{
            font-size: 10px;
        }
        #tb-cca tr{
            font-size: 10px;
        }
        #tb-cca td{
            font-size: 10px;
        }








        .tb-T{
            font-size: 12px;
        }
        .tb-T tr{
            font-size: 12px;
        }
        .tb-T td{
            font-size: 12px;
        }


        .tb-T th{
            font-size: 12px;
        }

        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
     </style>

@endsection


@section('main-content')


@include("logistica.estadistica")



     <div class="row" id="divRQ">
        <div class="col-md-12 ">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-grey-gallery"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Requerimiento  {{$rq->area->abreviatura}}-{{str_pad($rq->id, 5, "0", STR_PAD_LEFT)}}</span>
                        <span class="caption-helper">
                            @if($rq->clase=='I')
                                Articulos
                            @else
                                Servicios
                            @endif</span>
                    </div>
                    <div class="tools">


                        <a href="" class="collapse" data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    </div>
                    <div class="actions">


                        <a  href="{{route("requerimiento.imprimir",$rq->id)}}" class="btn btn-circle btn-default">
                            <i class="fa fa-print"></i> Imprimir </a>


                        <a  data-toggle="modal" data-target="#modalM" href="javascript:;" class="btn btn-circle btn-default">
                            <i class="fa fa-envelope-o"></i> {{$mensajeC}}</a>
                        <a href="javascript:;" class="btn btn-circle btn-default label-{{$rq->estados->class}}">
                             {{$rq->estados->name}} </a>
                         <a href="javascript:;" class="btn btn-circle btn-default">
                            <i class="fa fa-clock-o"></i> {{$rq->diferencia}} </a>
                        <a class="btn btn-circle btn-icon-only btn-default" data-toggle="modal" data-target="#modalR" href="javascript:;">
                            <i class="fa fa-info-circle"></i>
                        </a>
                     </div>


                </div>
                <div class="portlet-body">


                    @if($rq->estado==21)

                        <div class="row">

                            <div class="alert alert-block alert-danger fade in col-md-12  ">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                <h4 class="alert-heading">Error!</h4>
                                <p> {{$rq->mensaje_sap}}</p>
                                <p>
                                    <a  class="btn red" href="javascript:comprobar();"  > Reenviar</a>
                                </p>
                            </div>

                        </div>



                            <script language="javascript">

                                function update(){


                                    $.ajax({
                                        type: "GET",
                                        url: "{{route("estado_rq",$rq->id)}}",
                                        success: function(msg) {
                                            if(msg=="4"){
                                                location.reload();

                                            }else{
                                                update()
                                            }
                                        }
                                    });
                                }


                                function comprobar() {

                                    var url = "";
                                    url = "{{route("requerimiento.sap",$rq->id)}}";

                                    bloqueo("#divRQ");

                                    swal({
                                        title: "¿Estas seguro?",
                                        text: "El requerimiento sera enviado",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Enviar!",
                                        closeOnConfirm: false
                                    }, function (isConfirm) {
                                        if (!isConfirm) return;
                                        swal("", "Espere un momento....", "info");

                                        $.ajax({
                                            url: url,
                                            type: "POST",
                                            dataType: "json",
                                            success: function (msg) {


                                                if (msg["estado"] == "ok") {
                                                    update();
                                                } else {

                                                    if (msg["estado"] == "reg") {
                                                        swal("Ups!", "Codigo de articulo no valido!", "warning");
                                                        desbloqueo("#divRQ");
                                                    } else {
                                                        swal("Ups!", "Servidor SAP no disponible!<br>" + msg["mensaje"], "warning");
                                                        desbloqueo("#divRQ");
                                                    }
                                                }
                                            },
                                            error: function (xhr, ajaxOptions, thrownError) {
                                                swal("Servidor no disponible!", "Por favor intente en unos minutos", "error");
                                                desbloqueo("#divRQ");

                                            }
                                        });
                                    });

                                }

                            </script>


                    @endif



                    @if($rq->urgente==1)

                    <div id="divAlert" class="alert alert-warning  " style="">
                        <strong>Atención! </strong> Está incumpliendo un procedimiento de CETEMIN, esto será considerado en sus KPI.</div>
@endif


                    <div class="row">


                            <div class="form-group">

                            <label class="col-md-2 control-label">Motivos</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="comentario" id="comentario"   value="{{$rq->comentario}}">
                            </div>

                            <label class="col-md-2 control-label">Documento SAP:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  readonly value="{{$rq->docEntry}} - {{$rq->docNum}}">
                            </div>

                        </div>






                    @if ($errors->any())
                        <div class=" col-md-6 col-sm-12 alert alert-block alert-danger fade in">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            <h4 class="alert-heading">Error!</h4>
                             @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                            @else

                            <div class="col-md-6 col-sm-12">


                            </div>
                        @endif





                     </div>
                    <div class="row">

                        <div class="form-group">

                            <label class="col-md-2 control-label">Fecha creación:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"   readonly  value="{{$rq->created_at}}">
                            </div>

                            <label class="col-md-2 control-label">Fecha aprobación:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  readonly value="{{$rq->fecha_aprobacion}}">
                            </div>

                        </div>

                    </div>














                        <div class="row">
                    @if($rq->cotizacion>0)
                    <!--<div class="col-sm-12">
                        <a  class="btn btn-success btn-block" href="{{route("requerimiento.comparativo",$rq->id)}}">Ver cuadro comparativo</a>
                    </div>-->

                        <div class="col-md-12 col-sm-12">

                            <table class="table tb-T table-striped table-bordered   table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        Cotizaciónes </th>


                                </tr>
                                </thead>
                                <tbody>


                                @foreach($doc as $item)
                                    <tr>
                                        <td>
                                            {{$item["Mensaje"]}}

                                        </td>

                                    </tr>

                                @endforeach



                                </tbody>
                            </table>

                        </div>


                        <div class="col-md-12 col-sm-12">

                                <table class="table tb-T table-striped table-bordered   table-hover">
                                    <thead>
                                    <tr>
                                        <th >Orden </th>
                                        <th STYLE="text-align: center"> Presupuesto</th>
                                        <th STYLE="text-align: center"> Jefe <BR>de Compras</th>
                                        <th STYLE="text-align: center"> Gerente <BR>de area</th>
                                        <th STYLE="text-align: center"> GG/GAF</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($orden as $item)
                                        <tr>
                                            <td>
                                                {{$item["CardName"]}}
                                            </td>


                                            <td style="font-size: 18px;width: 100px;text-align: center">

                                                @if($item["U_EXC_AUTPRE"]=='P')
                                                     <i class="fa fa-clock-o font-yellow "></i>
                                                @else
                                                    @if($item["U_EXC_AUTPRE"]=='Y')
                                                        <i class="fa fa-check-circle-o font-green   "></i>
                                                    @endif
                                                    @if($item["U_EXC_AUTPRE"]=='N')
                                                        <i class="fa fa-times-circle font-red   "></i>
                                                    @endif
                                                @endif

                                            </td>

                                            <td style="font-size: 18px;width: 100px;text-align: center">
                                                @if($item["U_EXC_AUTCOM"]=='P')

                                                        <i class="fa fa-clock-o font-yellow   "></i>

                                                @else
                                                    @if($item["U_EXC_AUTCOM"]=='Y')

                                                        <i class="fa fa-check-circle-o font-green  "></i>

                                                    @endif
                                                    @if($item["U_EXC_AUTCOM"]=='N')

                                                        <i class="fa fa-times-circle font-red   "></i>

                                                    @endif
                                                @endif
                                            </td>
                                            <td style="font-size: 18px;width: 100px;text-align: center">
                                                @if($item["U_EXC_AUTGER"]=='P')

                                                        <i class="fa fa-clock-o font-yellow  "></i>

                                                @else
                                                    @if($item["U_EXC_AUTGER"]=='Y')

                                                        <i class="fa fa-check-circle-o font-green  "></i>
                                                    @endif
                                                    @if($item["U_EXC_AUTGER"]=='N')

                                                        <i class="fa fa-times-circle font-red   "></i>

                                                    @endif
                                                @endif

                                            </td>
                                            <td style="font-size: 18px;width: 100px;text-align: center">
                                                @if($item["U_EXC_AUTGGF"]=='P')

                                                        <i class="fa fa-clock-o font-yellow  "></i>

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


                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">

                            <form role="form"  action="{{route('requerimiento.add_crear_articulo') }}"  method="post" id="f_crear_usuario" class="formentrada" >

                                <input type="hidden" id="idArticulo" name="idArticulo">
                                <input type="hidden" id="nameArticulo" name="nameArticulo">
                                <input type="hidden" id="requerimiento_id" name="requerimiento_id" value="{{$rq->id}}">

                                <input type="hidden" id="clase" value="{{$rq->clase}}" name="clase">

                            <table id="tb-lista" class="table table-hover table-bordered table-striped  ">
                                <thead>

                                @if($rq->clase=='I')

                                    <tr>
                                        <th> # </th>
                                        <th>  </th>
                                        <th> Producto </th>
                                        <th class=""> Cantidad </th>

                                        <th class=""> Unidad </th>

                                        <th> Precio Referencia</th>
                                        <th> Total Referencia</th>

                                        <th> Referencia</th>
                                        <th>  </th>
                                    </tr>
                                @else
                                    <tr>
                                        <th> # </th>
                                        <th>  </th>
                                        <th> Servicio </th>
                                        <th class=""> Cantidad </th>
                                        <th> Precio Referencia</th>
                                        <th> Total Referencia</th>

                                        <th> Referencia</th>
                                        <th> Tipo Servicio</th>

                                        <th>  </th>
                                    </tr>

                                @endif


                                @switch($rq->estado)
                                    @case(0)



                                    @if($rq->clase=='I')
                                        <tr>
                                            <th style="padding: 0px; width: 36px; max-width: 36px; vertical-align: top">
                                               <!-- <a href="javascript:;" class="btn btn-small btn-icon-only green">
                                                    <i class="fa fa-reorder"></i>
                                                </a>-->
                                            </th>
                                            <th style="padding: 0px; width: 36px; max-width: 36px; vertical-align: top">


                                            </th>
                                            <th style="padding: 0px; vertical-align: top">




                                                <input type="text"  class="form-control   input-sm"  required id="cboArticulo" name="cboArticulo"  >


                                                <input type="hidden"  class="form-control xx input-sm"  id="nArticulo" name="nArticulo"  >


                                            </th>
                                            <th  style="padding: 0px; width: 36px; max-width: 36px"> <input type="text" class="form-control input-sm" id="cantidad" name="cantidad" required="" placeholder="Cantidad"></th>

                                            <th style="padding: 0px; vertical-align: top">
                                                    <select  style="width: 100%" id="unidad"  name="unidad" class="form-control input-sm">
                                                        @foreach($unidad as $item)
                                                        <option value="{{$item->abreviatura}}">{{$item->nombre}}</option>
                                                        @endforeach
                                                    </select>


                                            </th>



                                            <th  style="padding: 0px; width: 36px; max-width: 36px"> <input type="text" class="form-control input-sm" id="precio_referencial" name="precio_referencial" required="" placeholder="Precio Referencial"></th>
                                            <th  style="padding: 0px;  ">  </th>


                                            <th  style="padding: 0px;  ">  <input type="url" class="form-control input-sm" id="web" name="web"  placeholder="Referencia Web"></th>
                                            <th style="padding: 0px; width: 36px; max-width: 36px"> <button type="submit"   class="btn btn-icon-only green">
                                                    <i class="fa fa-plus"></i>
                                                </button>  </th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th style="padding: 0px; width: 36px; max-width: 36px; vertical-align: top"></th>
                                            <th style="padding: 0px; width: 36px; max-width: 36px; vertical-align: top">

                                            </th>
                                            <th style="padding: 0px; vertical-align: top"><input required type="text" class="form-control   input-sm" id="servicio" name="servicio"  placeholder="Servicio">

                        </div>
                                                <input type="text"  class="form-control xx input-sm"  style="display: none" id="nArticulo" name="nArticulo"  ></th>
                                            <th  style="padding: 0px; width: 36px; max-width: 36px"> <input type="text" class="form-control input-sm" id="cantidad" name="cantidad" required="" placeholder="Cantidad"></th>
                        <th  style="padding: 0px; width: 36px; max-width: 36px"> <input type="text" class="form-control input-sm" id="precio_referencial" name="precio_referencial" required="" placeholder="Precio Referencial"></th>
                        <th  style="padding: 0px;  ">  </th>

                        <th  style="padding: 0px;  ">  <input type="url" class="form-control input-sm" id="web" name="web"  placeholder="Referencia Web"></th>
                        <th style="padding: 0px; vertical-align: top">
                            <input type="text"  class="form-control   input-sm"  required id="cboArticulo" name="cboArticulo"  >
                        </th>

                        <th style="padding: 0px; width: 36px; max-width: 36px"> <button type="submit"   class="btn btn-icon-only green">
                                                    <i class="fa fa-plus"></i>
                                                </button>  </th>
                                        </tr>

                                    @endif
                                    @break
                                    @case(2)
                                    @break
                                    @default
                                @endswitch
                                </thead>
                                <tbody>
                                </tbody>
                    <tfoot>
                        <tr>

                            <th colspan="5" style="text-align: right; background-color: #eef1f5">Total Referencia</th>
                            <th style="text-align: right; background-color: #eef1f5"  nowrap > <div id="total_R" style="text-align: right; background-color: #eef1f5"></div> </th>

                            <th style="text-align: right; background-color: #eef1f5"> </th>
                            <th style="text-align: right; background-color: #eef1f5">  </th>
                            <th style="text-align: right; background-color: #eef1f5">  </th>

                         </tr>
                    </tfoot>
                            </table>
                            </form>
                         </div></div>




            <div class="row" >



                <div class="col-md-12 col-sm-12">

                    <div class="col-md-12 col-sm-12" id="divBtn">


                    @switch($rq->estado)
                        @case(0)
                        <!-- <a class="btn btn-lg green hidden-print margin-bottom-5" href="{{route("requerimiento.email",$rq->id)}}"> Enviar a aprobación JEFE
                                    <i class="fa fa-check"></i>
                                </a>-->

                            <button class="btn   green hidden-print margin-bottom-5 btn-block " onclick="javascript:cargar_presupuesto();"> Validar Presupuesto
                                <i class="fa fa-check"></i>
                            </button>





                            @break

                            @case(2)


                            @canatleast(['sap'])
                            <button class="btn   btn-danger hidden-print"  onclick="javascript:estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>7])}}')">                           <i class="fa fa-exclamation-circle"></i>
                                Denegar
                            </button>
                            <button class="btn   btn-warning hidden-print "  onclick="javascript:estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>6])}}')">                           <i class="fa fa-exclamation-circle"></i>
                                Observar
                            </button>



                            <a href="#" id="form-submit" class="btn btn-primary    green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label">Comprobar y Enviar a SAP</span></a>



                            <script language="javascript">


                                function update(){


                                    $.ajax({
                                        type: "GET",
                                        url: "{{route("estado_rq",$rq->id)}}",
                                        success: function(msg) {
                                            if(msg=="4"){
                                                location.reload();

                                            }else{
                                                update()
                                            }
                                        }
                                    });
                                }







                                function comprobar() {

                                    var url = "";
                                    url = "{{route("requerimiento.sap",$rq->id)}}";

                                    bloqueo("#divRQ");

                                    swal({
                                        title: "¿Estas seguro?",
                                        text: "El requerimiento sera enviado",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Enviar!",
                                        closeOnConfirm: false
                                    }, function (isConfirm) {
                                        if (!isConfirm) return;
                                        swal("", "Espere un momento....", "info");

                                        $.ajax({
                                            url: url,
                                            type: "POST",
                                            dataType: "json",
                                            success: function (msg) {


                                                if (msg["estado"] == "ok") {
                                                    update();
                                                } else {

                                                    if (msg["estado"] == "reg") {
                                                        swal("Ups!", "Codigo de articulo no valido!", "warning");
                                                        desbloqueo("#divRQ");
                                                    } else {
                                                        swal("Ups!", "Servidor SAP no disponible!<br>" + msg["mensaje"], "warning");
                                                        desbloqueo("#divRQ");
                                                    }
                                                }
                                            },
                                            error: function (xhr, ajaxOptions, thrownError) {
                                                swal("Servidor no disponible!", "Por favor intente en unos minutos", "error");
                                                desbloqueo("#divRQ");

                                            }
                                        });
                                    });

                                }


                                $('#form-submit').click(function(e){
                                    e.preventDefault();
                                    var l = Ladda.create(this);
                                    l.start();
                                    comprobar();
                                });
                            </script>

                            @endcanatleast

                            @break

                            @case(10)


                            @canatleast(['sap'])
                            @if($rq->clase=='I')
                                <button class="btn     hidden-print"  onclick="javascript:estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>11])}}')">                           <i class="fa fa-exclamation-circle"></i>
                                    En almacen
                                </button>
                            @else
                                <button class="btn     hidden-print"  onclick="javascript:estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>12])}}')">                           <i class="fa fa-exclamation-circle"></i>
                                    Atendido
                                </button>
                            @endif

                            @endcanatleast

                            @break
                            @case(11)


                            @canatleast(['sap'])
                            <button class="btn     hidden-print"  onclick="javascript:estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>12])}}')">                           <i class="fa fa-exclamation-circle"></i>
                                Atendido
                            </button>


                            @endcanatleast

                            @break

                            @case(13)


                            @canatleast(['sap'])
                            <div class="progress md-progress primary-color-dark">
                                <div class="indeterminate"></div>
                            </div>


                            @endcanatleast

                            @break



                            @case(4)


                            @canatleast(['sap'])
                            <button class="btn     hidden-print"  onclick="javascript:estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>12])}}')">                           <i class="fa fa-exclamation-circle"></i>
                                Atendido
                            </button>

                            1
                            @endcanatleast

                            @break

                            <button class="btn     hidden-print"  onclick="javascript:estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>12])}}')">                           <i class="fa fa-exclamation-circle"></i>
                                Atendido
                            </button>




                            @default



                        @endswitch

                </div>


            </div>

@if($rq->estado==0)
                <div class="col-md-12 col-sm-12 flip-scroll" id="divPresupuesto">

                </div>
@else

                    <div class="col-md-12 col-sm-12">

                        @include('logistica.presupuesto2')
                    </div>

                @endif

                    </div>

                </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-striped table-bordered   table-hover">
                        <thead>
                        <tr>
                            <th>
                                Archivos </th>
                            @if($rq->estado==0)
                                <th>    <a class="btn  btn-block "  href="javascript:$('#modalAdjuntar').modal();">Adjuntar archivos <i class="fa fa-folder-open-o"></i>
                                    </a>   </th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $item)
                            <tr>
                                <td>
                                    <a href="{{route("requerimiento.download_file")}}/?file={{$item}}">{{$item}}</a>
                                </td>
                                @if($rq->estado==0)
                                    <td style="text-align: right" >
                                        <a href="javascript:;" data-id="{{$item}}" class="btn btn-outline btn-circle dark btn-sm black btnConfirmar "  data-placement="left"  data-toggle="confirmation"  data-btn-ok-label="Continuar" data-btn-ok-class="btn-success"
                                           data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                                           data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger"
                                           data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            </div>





            <!-- END GRID PORTLET-->
        </div>
     </div>

    <div class="modal fade" id="modalM"   role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
                <div class="modal-content"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensajes</h4>
                </div>
                <div class="modal-body">


                    <div id="div2" >

                        <ul class="feeds">
                            @foreach($mensaje as $itemx)
                                <li>

                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label- ">
                                                        <i class=" "></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> {{$itemx->mensaje}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date" style="font-size: 8px"> {{$itemx->created_at}}</div>
                                        </div>
                                 </li>
                            @endforeach
                        </ul>
                    </div>




                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalR"   role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Historial</h4>
                </div>
                <div class="modal-body">


                    <div id="div2" >

                        <ul class="feeds">
                            @foreach($log as $itemx)
                                 <li>
                                    <a href="javascript:;"
                                       @if($itemx->accion_id==6)
                                       onclick="javascript:toastr['info']('{{$itemx->mensaje}}', 'Mensaje')"
                                            @endif
                                    >
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-{{$itemx->accion->class}}">
                                                        <i class="{{$itemx->accion->icon}}"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> {{$itemx->accion->nombre}} {{$itemx->detalle}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date" style="font-size: 8px"> {{$itemx->created_at}} </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>




                </div>

            </div>
        </div>
    </div>
    <div class="modal fade @if($rq->clase=='I') bs-modal-lg @endif " id="modalCC"   role="dialog"  >
        <div class="modal-dialog  @if($rq->clase=='I') modal-lg @endif " role="document">
            <div class="modal-content"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Asignar CC</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="fila" id="fila">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-responsive table-bordered table-striped table-condensed flip-content " id="tb-cca">
                                <thead>

                                <tr>
                                    <th>#</th>
                                    <th> Linea </th>
                                    <th> Sede </th>
                                    <th> Tipo </th>
                                    <th> Especialidad</th>
                                    <th>Admision</th>
                                    <th> @if($rq->clase=='S') Porcentaje  @else Cantidad @endif </th>

                                    <th>  </th>

                                </tr>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            @switch($rq->estado)
                                @case(0)

                                <button class="btn blue btn-block" onclick="javascript:aplicarTodos()" >Aplicar CC a todos las documentos.</button>
                                @break


                            @endswitch

                        </div>


                    </div>
                    @switch($rq->estado)
                        @case(0)

                        <h5>Lista de CC validos</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive table-bordered table-striped table-condensed flip-content " id="tb-lista-cc">
                                    <thead>

                                    <tr>

                                        <th>#</th>

                                        <th> Linea </th>

                                        <th> Sede </th>
                                        <th> Tipo </th>
                                        <th> Especialidad</th>
                                        <th>Admision</th>
                                        <th>  </th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($cc as $item)
                                        <?php
                                        $i++;
                                        ?>
                                        <tr>
                                            <td>{{$i}}</td>

                                            <td> {{$item->LineaCode}}<br>{{$item->Linea}} </td>

                                            <td> {{$item->SedeCode}}<br>{{$item->Sede}} </td>
                                            <td> {{$item->ModalidadCode}}<br>{{$item->ModalidadCode}} </td>
                                            <td> {{$item->EspecialidadaCode}}<br>{{$item->Especialidad}} </td>
                                            <td> {{$item->AdmisionCode}}<br>{{$item->Admision}} </td>
                                            <td> <a href="javascript:addCC({{$item->id}});" class="btn btn-xs default">
                                                    <i class="fa fa-plus"></i>
                                                </a> </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @break


                    @endswitch





                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAdjuntar"   role="dialog"  >
        <div class="modal-dialog" role="document">
            <div class="modal-content"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Asignar CC</h4>
                </div>
                <div class="modal-body" id="divFile">
                    @if($rq->estado==0)

                        <input id="file-es" name="file-es[]" type="file" multiple>
                        <script>
                            $('#file-es').fileinput({
                                language: 'es',
                                theme: 'explorer-fa',
                                uploadUrl: '{{route("requerimiento.upload")}}',
                                uploadExtraData: {id: "{{$rq->area->abreviatura}}-{{str_pad($rq->id, 5, "0", STR_PAD_LEFT)}}"},
                                allowedFileExtensions: ['jpeg','jpg', 'png', 'doc', 'docx', 'xlsx', 'xls', 'pdf']
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section ('script')

    <script src="{{ asset('/js/requerimiento.js') }}?v={{rand()}}" type="text/javascript"></script>

    <script src="{{ asset('/js/jquery.autocomplete.js') }}?v={{rand()}}" type="text/javascript"></script>


 <script language="javascript">

     function cargar_presupuesto() {
         var data = {};
         data["id"]={{$id}};

         var url="{{route("presupuesto.validar",$id)}}";

         bloqueo("#divPresupuesto");
         $.post(url, data, "json")
             .done(function( result ) {

                     desbloqueo("#divPresupuesto");

                     $("#divPresupuesto").html(result);
             })
         ;
     }


     var falta_c;
     var id={{$rq->id}};
     var art=0;

     $('#cboArticulo').autocomplete({
         @if(($rq->area->gerencia==99)&&($rq->clase=="S"))
         serviceUrl: '{{route("api.item",['id'=>'B','id2'=>$rq->id])}}',
         @else
         serviceUrl: '{{route("api.item",['id'=>$rq->clase,'id2'=>$rq->id])}}',
         @endif
         onSelect: function (suggestion) {
             @if($rq->clase=='I')
             $("#precio_referencial").val(suggestion.price);
             @endif

             $("#idArticulo").val(suggestion.data);
             $("#nameArticulo").val(suggestion.value);
              if(suggestion.unidad==null){
                  $("#unidad").val('UND');
              }else{
                  $("#unidad").val(suggestion.unidad);

              }
            $("#cantidad").focus();
         }             @if($rq->clase=='S')

         ,triggerSelectOnValidInput:true
         @endif
         , transformResult: function(response) {
             return {
                 suggestions: $.map(JSON.parse(response), function(dataItem) {
                      return { value: dataItem.FullName, data: dataItem.ItemCode , price: dataItem.precio_referencial, unidad: dataItem.Unidad};
                 })
             };
         }

     });



     @if($rq->clase=='S')
     $( "#cboArticulo" ).keypress(function( event ) {
         if ( event.which == 13 ) {
             event.preventDefault();
         }
         $("#idArticulo").val('');
         $("#nameArticulo").val('');
     });
     @endif


     function cargar(){
         $("#f_crear_usuario").trigger("reset");

         falta_c=false;
         var data = {};
         var url = rutaListado + "?rq=" + id;
         $.post(url,data,function(resp){

             $("#tb-lista tbody").empty()
             if(resp.error){
                 toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
             }else{
                 var i=0;

$("#total_R").html(resp.gastos);

                 @if($rq->clase=='I')
                 $.each(resp.data,function(key,item) {
                     i++;
                     var tr = "";
                     tr += '<tr>';
                     tr += '<td>' + i +'</td>';
                     var sum=0;


                     var total;

                    @if($rq->clase=='S')
                        total=100;
                    @else
                        total=eval(item.cantidad);
                    @endif


                     $.each(item.cc,function(key2,item2) {
                         sum=sum+eval(item2.porcentaje);
                     });
                     var color;
                     if((sum==total)&&(sum>0) &&(total>0)){
                         color="blue";
                     }else{
                         color="red";
                         if(falta_c==false){
                             falta_c=true;
                         }
                     }
                     tr += '<td><a href="javascript:popup(' + item.id +');" ><i class="fa font-' + color +' fa-cc"></i> </a></td>';

                     @switch($rq->estado)
                             @case(0)

                         tr += '<td style="min-width: 380px"><a href="javascript:;" onclick="edit('+ item.id +')" >'+ item.articulo_nombre +'</a></td>';
                     @break
                             @case(2)

                         tr += '<td style="min-width: 380px"><a href="javascript:;" onclick="edit('+ item.id +')" >'+ item.articulo_nombre +'</a></td>';
                     @break
                 @default
                         tr += '<td style="min-width: 380px"> '+ item.articulo_nombre +' </td>';

                     @break
                             @endswitch



                     tr += '<td  style="text-align: right">'+ item.cantidad +'</td>';
                     tr += '<td  style="text-align: right">'+ item.unidad +'</td>';

                     tr += '<td  style="text-align: right;min-width: 38px;width: 38px">'+ item.precio_referencial +'</td>';
                     tr += '<td  style="text-align: right;min-width: 38px;width: 38px">'+ item.total_referencial +'</td>';

                     if( item.referencia ) {
                         tr += '<td>'+ item.referencia +'</td>';
                     }else{
                         tr += '<td>-</td>';
                     }

                     @switch($rq->estado)
                             @case(0)

                         tr += '<td  style="padding: 0px"><a href="javascript:;" class="btn  font-red" onclick="eliminar('+ item.id + ')"> <i class="fa fa-trash-o"></i></a></td>';
                     @break

                         @@default
                     tr += '<td  style="padding: 0px"></td>';

                     @break
                             @endswitch



                     tr += '</tr>';
                     $('#tb-lista').append(tr);
                 });


                 @else
                         $.each(resp.data,function(key,item) {
                             i++;
                             var tr = "";
                             tr += '<tr>';
                             tr += '<td>' + i +'</td>';
                             var sum=0;
                             $.each(item.cc,function(key2,item2) {
                                 sum=sum+eval(item2.porcentaje);
                             });
                             var color;
                              if(sum==100){
                                 color="blue";
                             }else{
                                 color="red";
                                 if(falta_c==false){
                                     falta_c=true;
                                 }
                             }
                             tr += '<td><a href="javascript:popup(' + item.id +');" ><i class="fa font-' + color +' fa-cc"></i> </a></td>';
                             tr += '<td style="min-width: 380px"><a href="javascript:;" onclick="edit('+ item.id +')" >'+ item.servicio +'</a></td>';
                             tr += '<td  style="text-align: right;min-width: 38px;width: 38px">'+ item.cantidad +'</td>';
                             tr += '<td  style="text-align: right;min-width: 38px;width: 38px">'+ item.precio_referencial +'</td>';
                     tr += '<td  style="text-align: right;min-width: 38px;width: 38px">'+ item.total_referencial +'</td>';

                             if( item.referencia ) {
                                 tr += '<td>'+ item.referencia +'</td>';
                             }else{
                                 tr += '<td>-</td>';
                             }
                             tr += '<td style="min-width: 380px">'+ item.articulo_nombre +'</td>';
                             tr += '<td  style="padding: 0px"><a href="javascript:;" class="btn  font-red" onclick="eliminar('+ item.id + ')"> <i class="fa fa-trash-o"></i></a></td>';

                             tr += '</tr>';
                             $('#tb-lista').append(tr);
                         });


                 @endif


/*
             btn='<a  class="btn btn-lg green hidden-print margin-bottom-5" href="{{route("requerimiento.email",$rq->id)}}"> Enviar a aprobación JEFE <i class="fa fa-check"></i> </a>';
                 btn2='<a disabled="" class="btn btn-lg  green hidden-print margin-bottom-5"   > Enviar a aprobación JEFE <i class="fa fa-check"></i> </a>';
                 @switch($rq->estado)
                 @case(0)
                 $("#divBtn").html("");
                 if(falta_c==false) {
                     $("#divBtn").html(btn);
                 }else{
                     $("#divBtn").html(btn2);
                 }
                 @break
                 @endswitch
*/
             }

         }).fail(function(){

             toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

         });

     }


    var rutaListado="{{route("requerimiento.lista_articulo")}}";
    cargar();
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
                            //console.log("nullll");
                        }else{
                            var data = {};
                            data["mensaje"]=result;
                            $.post( ruta,data, function( data2 ) {
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










$('#div2').slimScroll({
    height: '150px'
});
     $(".btnConfirmar").on("confirmed.bs.confirmation", function() {
        var url="{{route("requerimiento.delete_file")}}";
        var data = {};

         data["file"]=$(this).data("id");
         bloqueo("#divFile");
         $.post(url, data, "json")
             .done(function( result ) {
                 if(result.error){
                     toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                 }else{
                     desbloqueo("#divFile");
                     location.reload();
                 }
             })
         ;
    })
     function popup(id){
         $("#modalCC").modal();
         $("#fila").val(id);
         cargarCC(id)
     }
     function addCC(id) {
         var data = {};
         data["id"]=id;

         data["_token"]="{{ csrf_token() }}";
         data["cc_id"]=id;
         data["detalle_id"]=$("#fila").val();
         data["tipo"]="{{$rq->clase}}";


         var url="{{route("rq.rendir_fila_cc")}}";
         bloqueo("#tb-cca");
         $.post(url, data, "json")
             .done(function( result ) {
                 if(result.error){
                     toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                 }else{
                     cargarCC($("#fila").val());

                     desbloqueo("#tb-cca");
                 }
             })
         ;


     }

     function actualizarCC(id) {
         var data = {};
         data["id"]=id;
         data["_token"]="{{ csrf_token() }}";
         data["porcentaje"]=$("#P"+id).val();
         data["tipo"]="{{$rq->clase}}";

         var url="{{route("rq.update_cc")}}";
         bloqueo("#tb-cca");
         $.post(url, data, "json")
             .done(function( result ) {
                 if(result.error){
                     toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                 }else{
                     cargarCC($("#fila").val());

                     desbloqueo("#tb-cca");
                 }
             })
         ;
     }


     function eliminarCC(id) {
         var data = {};
         data["id"]=id;

         data["_token"]="{{ csrf_token() }}";


         var url="{{route("rq.eliminar_cc")}}";
         bloqueo("#tb-cca");

         $.post(url, data, "json")
             .done(function( result ) {
                 if(result.error){
                     toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                 }else{
                     cargarCC($("#fila").val());

                     desbloqueo("#tb-cca");
                 }
             })
         ;


     }
     function cargarCC(id){

         var data = {};
         data["id"]=id;
         data["_token"]="{{ csrf_token() }}";

         var url = "{{route("rq.rendir_listado_cc")}}";
         $.post(url,data,function(resp){

             $("#tb-cca tbody").empty();
             if(resp.error){

                 if(resp.msg!="0") {

                     toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                 }
             }else{
                 var i=0;
                 $.each(resp.data,function(key,item) {
                     i++;
                     var tr = "";
                     tr += '<tr>';
                     tr += '<td>' + i +'</td>';
                     tr += '<td>' + item.centro.LineaCode +' <br>'+ item.centro.Linea  +'  </td>';
                     tr += '<td>' + item.centro.SedeCode +' <br>'+ item.centro.Sede +'</td>';
                     tr += '<td>' + item.centro.ModalidadCode +'<br>' + item.centro.ModalidadCode +'</td>';
                     tr += '<td>' + item.centro.EspecialidadCode +'<br>' + item.centro.Especialidad +'</td>';
                     tr += '<td>' + item.centro.AdmisionCode +'<br>' + item.centro.Admision +'</td>';



                     @switch($rq->estado)
                             @case(0)

                                tr += '<td> <input type="text" value="' + item.porcentaje +'" class="form-control input-xsmall  input-sm" name="P' + item.id+ '" id="P' + item.id+ '"> </td>';


                                tr += '<td><a href="javascript:actualizarCC(' + item.id + ');" class="btn btn-xs default"><i class="fa fa-save"></i></a><a href="javascript:eliminarCC(' + item.id + ');" class="btn btn-xs default"><i class="fa fa-trash-o"></i></a></td>';

                            @break

                                    @default
                     tr += '<td>' + item.porcentaje +'</td>';
                     tr += '<td></td>';
                     tr += '<td></td>';

                     @break




                             @endswitch





                     tr += '</tr>';
                     $('#tb-cca').append(tr);
                 });

                 tr='';


                 var total;



                 @if($rq->clase=='S')
                     total=100;
                 @else
                     total=eval(resp.cantidad);
                 @endif

                 tr += '<tr';
                 if(resp.total!=total){
                     tr += ' class="danger" ';
                 }else{
                     tr += ' class="success" ';
                 }

                 @if($rq->clase=='S')
                     tr += '><td colspan="6">TOTAL PORCENTAJE</td>';
                 @else
                     tr += '><td colspan="6">CANTIDAD TOTAL <strong> (Cantidad solicitada: ' + resp.cantidad +')</strong></td>';
                 @endif




                 tr += '<td >' + resp.total +'</td>';
                 tr += '<td>  </td>';
                 tr += '</tr>';


                 $('#tb-cca').append(tr);

             }
             cargar();
         }).fail(function(){

             toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

         });

     }
     function aplicarTodos() {


         var data = {};

         data["_token"]="{{ csrf_token() }}";
         data["rq_id"]={{$rq->id}};
         data["detalle_id"]=$("#fila").val();



         var url="{{route("rq.aplicar_todos")}}";
         $.post(url, data, "json")
             .done(function( result ) {
                 if(result.error){
                     toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                 }else{
                     cargar();
                     $("#modalCC").modal('hide');

                 }
             });

     }



     $("#comentario").change(function() {

         var url;
         url="{{route("rq.comentario")}}";
         var data = {};

         data["_token"]="{{ csrf_token() }}";
         data["rq_id"]={{$rq->id}};
         data["comentario"]=$("#comentario").val();
         bloqueo("#comentario");
         $.post(url, data, "json")
             .done(function( result ) {
                 if(result.error){
                     toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online");

                     desbloqueo("#comentario");

                 }else{
                     desbloqueo("#comentario");
                 }
             });

     });

 </script>

 @endsection