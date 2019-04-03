@extends('layout.app4')

@section('cabecera')

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
</style>
<link href="{{asset("assets/global/plugins/typeahead/typeahead.css")}}" rel="stylesheet" type="text/css" />

@endsection


@section('main-content')

    <div class="row">

        <div class="col-md-12 ">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                 <div class="portlet-body">
                    @include('caja.formularios.step')
                    @include("caja.formularios.botones")
                </div>
            </div>

            @if($rq->estado==9)
                @if(($rq->user_id==\Auth::user()->id)||($rq->email==\Auth::user()->email))
                @include("caja.formularios.rendir")
            @endif
            @endif
            @if($rq->estado==14)
                @include("caja.formularios.conta")

            @endif

            <div class="portlet light  ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-grey-gallery"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Solicitud de dinero </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="@if($rq->estado==9) expand @else collapse @endif " data-original-title="" title=""> </a>
                         <a href="" class="fullscreen" data-original-title="" title=""> </a>
                     </div>
                </div>
                <div class="portlet-body @if($rq->estado==9) portlet-collapsed @endif ">

                        @canatleast(['tesoreria','crear.rq'])


                        <div class="row">

                            <div class="col-md-12 ">
                                      <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-md-3 control-label">AREA</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" disabled="disabled" id="cboArea" name="cboArea" required>
                                                        @foreach($area as $item)
                                                            <option @if ($rq->estado==$item->id) selected @endif     value="{{$item->id}}">{{$item->abreviatura}} {{$item->area}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden"  required id="centro" name="centro">

                                            <div class="form-group  col-md-6">
                                                <label class="col-md-3 control-label">Fecha Necesaria</label>
                                                <div class="col-md-9">

                                                    <input type="text" class="form-control" readonly="" value="{{$rq->fecha_necesaria}}"  required id="fecharq" name="fecharq">


                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="form-group  col-md-6">
                                                <label class="col-md-3 control-label">Tipo</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="tiporq" disabled name="tiporq"  required>
                                                        <option value="CAJ" @if($rq->tipo=="CAJ") selected @endif >Caja Chica</option>
                                                        <option value="VIA" @if($rq->tipo=="VIA") selected @endif >Viaticos</option>
                                                        <option value="SUM" @if($rq->tipo=="SUM") selected @endif >Compra de suministros</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label class="col-md-3 control-label">Prioridad</label>
                                                <div class="col-md-9">
                                                    <select class="form-control"  disabled id="prioridad" name="prioridad"  required >
                                                        <option value="1"  @if($rq->prioridad==1) selected @endif >Normal</option>
                                                        <option value="2"  @if($rq->prioridad==2) selected @endif   >Baja</option>
                                                        <option value="3"  @if($rq->prioridad==3) selected @endif >Alta</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <label class="col-md-3 control-label">Destino</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control viatico" disabled  value="{{$rq->destino}}"   required id="destino" name="destino">
                                                </div>
                                            </div>

                                            <div class="form-group  col-md-6">
                                                <label class="col-md-3 control-label">Estadia</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control viatico" disabled  value="{{$rq->estadia}}"   required id="estadia" name="estadia">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label class="col-md-12 control-label">Descripción del Motivo</label>
                                            <div class="col-md-12">
                                                <textarea id="descripcion" name="descripcion" disabled class="form-control" rows="3"  required>{{$rq->descripcion}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="form-group  col-md-12">
                                        <label class="col-md-2 control-label">Monto S/</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control viatico" disabled  value="{{$rq->monto}}"    >
                                        </div>
                                    </div>


                                </div>
                                    <div class="row">
                                        <label class="col-md-12"><b>Datos del beneficiario</b></label>

                                        <div class="form-group  col-md-12">
                                            <label class="col-md-2 control-label">DNI</label>
                                            <div class="col-md-4">
                                                <input type="text" disabled class="form-control"   value="{{$rq->dni}}"   >
                                            </div>
                                        </div>

                                        <div class="form-group  col-md-12">
                                            <label class="col-md-2 control-label">Apellidos y Nombres</label>
                                            <div class="col-md-10">
                                                <input type="text" disabled class="form-control" value="{{$rq->nombre}}"     >
                                            </div>
                                        </div>
                                        <div class="form-group  col-md-12">
                                            <label class="col-md-2 control-label">Cargo</label>
                                            <div class="col-md-10">
                                                <input type="text" disabled class="form-control"  value="{{$rq->cargo}}"    >
                                            </div>
                                        </div>
                                        <div class="form-group  col-md-12">
                                            <label class="col-md-2 control-label">Banco</label>
                                            <div class="col-md-2">
                                                <select   disabled class="form-control"  >
                                                    <option value="BCP"   @if($rq->banco=="BCP") selected @endif  >BCP</option>
                                                    <option value="I"   @if($rq->banco=="I") selected @endif >Interbancaria</option>

                                                    <option value="EFE"   @if($rq->banco=="EFE") selected @endif >Efectivo</option>

                                                </select>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" disabled class="form-control"   required     value="{{$rq->cta}}" >
                                            </div>


                                        </div>

                                    </div>




                            </div>

                        </div>
                </div>
                @else





                    <div class="note note-danger">
                        <h4 class="block">Alerta! </h4>
                        <p>  Ud. no tiene permiso para ver esto  </p>
                    </div>
                    @endcanatleast





            </div>


        </div>
        <!-- END GRID PORTLET-->


    </div>

 @endsection
@section ('script')

    <script src="{{asset("assets/global/plugins/typeahead/handlebars.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/global/plugins/typeahead/typeahead.bundle.min.js")}}" type="text/javascript"></script>


 @endsection