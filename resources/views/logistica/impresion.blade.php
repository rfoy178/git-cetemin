@extends('layout.app5')

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

    <style>

        body{
            font-size: 12px;
        }
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


     </style>

@endsection


@section('main-content')
    <div class="portlet light">


    <div class="row">
        <div class="col-sm-4">

            <img src="https://adm.cetemin.com/logo.png" alt="logo" class="logo-default" style="height: 55px;margin-top: 10px">
        </div>
        <div class="col-sm-4 text-center ">

          <h4 class="bold" > REQUERIMIENTO  DE BIENES Y SERVICIOS</h4>
            <br><br>
        </div>

        <div class="col-sm-4">
            Versión00/F.LOG.01/Diciembre2016

         </div>

    </div>

        <div class="row">
            <div class="col-sm-2 bold  ">
                NRO REQ
            </div>
            <div class="col-sm-4   ">


                <input type="text" class="form-control"  readonly value="{{$rq->area->abreviatura}}-{{str_pad($rq->id, 5, "0", STR_PAD_LEFT)}}">

            </div>

            <div class="col-sm-2 bold   ">

                TIPO

            </div>
            <div class="col-sm-4   ">
                                   <input type="text" class="form-control"  readonly value="@if($rq->clase=='I') Articulos @else Servicios @endif">

            </div>

        </div>
        <div class="row">

            <div class="col-sm-2 bold  ">

                F. RQ

            </div>
            <div class="col-sm-2   ">


                <input type="text" class="form-control"  readonly value="{{$rq->created_at}}">

            </div>

            <div class="col-sm-2 bold   ">

                F. Aprobación

            </div>
            <div class="col-sm-2   ">
                <input type="text" class="form-control"  readonly value="{{$rq->fecha_aprobacion}}">

            </div>
            <div class="col-sm-2 bold   ">

                F. Necesaria

            </div>
            <div class="col-sm-2   ">
                <input type="text" class="form-control"  readonly value="{{$rq->fecha}}">

            </div>
        </div>

        <div class="row">

            <div class="col-sm-2 bold  ">

                OBJETIVO DE LA COMPRA

            </div>
            <div class="col-sm-10   ">


                <input type="text" class="form-control"  readonly value="{{$rq->comentario}}">

            </div>


        </div>
    </div>




    <div class="row" id="divRQ">
        <div class="col-md-12 ">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">

                <div class="portlet-body">










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


                            <table id="tb-lista" class="table table-hover table-bordered table-striped  ">
                                <thead>

                                @if($rq->clase=='I')

                                    <tr>
                                        <th> # </th>
                                         <th> Producto </th>
                                        <th class=""> Cantidad </th>
                                        <th> Referencia</th>
                                        <th>  </th>
                                    </tr>
                                @else
                                    <tr>
                                        <th> # </th>
                                         <th> Servicio </th>
                                        <th class=""> Cantidad </th>
                                        <th> Referencia</th>
                                        <th> Tipo Servicio</th>

                                        <th>  </th>
                                    </tr>

                                @endif

                                </thead>

                                <tbody>

                                <?php $i=0; ?>

                                @if($rq->clase=='I')

@foreach($rq->detalle as $item )
    <?php $i++; ?>

    <tr>
                                        <td> {{$i}} </td>
                                         <td> {{$item->articulo_nombre}} </td>
                                        <td class="text-center" > {{$item->cantidad}} </td>
                                        <td  style="text-align: right"> {{$item->total_referencial}}</td>
                                        <td>  </td>
                                    </tr>

@endforeach

                                @else



                                    @foreach($rq->detalle as $item )
                                        <?php $i++; ?>

                                        <tr>
                                            <td> {{$i}} </td>
                                             <td> {{$item->servicio}} </td>
                                            <td  class="text-center" > {{$item->cantidad}} </td>
                                            <td  style="text-align: right"> {{$item->total_referencial}}</td>
                                            <td>{{$item->articulo_nombre}} </td>

                                            <td>  </td>
                                        </tr>


                                    @endforeach


                                @endif

                                </tbody>
                            </table>




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
            </div>





     </div>




@endsection
@section ('script')



 @endsection