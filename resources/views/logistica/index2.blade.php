@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />



@endsection


@section('main-content')

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349">{{$ultimo}}</span>
                    </div>
                    <div class="desc"> Recibidos </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="12,5">{{$atendidos}}</span>  </div>
                    <div class="desc"> Atendidos</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="0"> 0</span>
                    </div>
                    <div class="desc"> Vencidos </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number"> +
                        <span data-counter="counterup" data-value="0">0</span>% </div>
                    <div class="desc">  </div>
                </div>
            </a>
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



                    <div class="form-group">
                         <div class="mt-checkbox-inline">
                            <label class="mt-checkbox">
                                <input type="checkbox" id="inlineCheckbox1" value="option1">Logistica
                                <span></span>
                            </label>

                             <label class="mt-checkbox">
                                 <input type="checkbox" id="inlineCheckbox2" value="option2"> Atendido
                                 <span></span>
                             </label>
                            <label class="mt-checkbox">
                                <input type="checkbox" id="inlineCheckbox2" value="option2"> Denegado
                                <span></span>
                            </label>
                             <label class="mt-checkbox">
                                 <input type="checkbox" id="inlineCheckbox2" value="option2"> Observado
                                 <span></span>
                             </label><label class="mt-checkbox">
                                 <input type="checkbox" id="inlineCheckbox2" value="option2"> Orden de compra
                                 <span></span>
                             </label>
                        </div>
                    </div>




                    <div class="tabbable tabbable-tabdrop">
                        <ul class="nav nav-tabs">
                            <li class=" @if(($gerencia=="GAC")||($gerencia==""))active
@endif">
                                <a href="#tab10" data-toggle="tab">GERENCIA ACADEMICA</a>
                            </li>


                            <li class="@if($gerencia=="GAF")active
@endif ">
                                <a href="#tab20" data-toggle="tab">GERENCIA ADMINISTRACION Y FINANZAS</a>
                            </li>

                            <li class=" @if($gerencia=="GCO")active
@endif">
                                <a href="#tab30" data-toggle="tab">GERENCIA COMERCIAL</a>
                            </li>

                            <li class=" @if($gerencia=="CIT")active
@endif">
                                <a href="#tab40" data-toggle="tab">CITE / DOBLE TITULACIÓN</a>
                            </li>

                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane @if(($gerencia=="GAC")||($gerencia==""))active
@endif " id="tab10">

                                <div class="table-scrollable">



                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>  </th>

                                            <th> Codigo </th>
                                            <th> Area </th>

                                            @if(Auth::user()->area==13)

                                                <th> Fecha Creación </th>
                                            @endif
                                            <th> Fecha Aprobación </th>
                                            <th> Fecha Necesaria U </th>
                                            <th> Fecha Necesaria L</th>

                                            <th>   </th>

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

                                                @if(Auth::user()->area==13)
                                                    <td> {{$item->created_at}} </td>
                                                @endif
                                                <td style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>

                                                <td style="font-size: smaller"> {{$item->fecha}} </td>
                                                <td style="font-size: smaller"> {{$item->logistica}} </td>


                                                <td style="font-size: smaller"> {{$item->comentario}} </td>

                                                <td style="font-size: smaller"> {{$item->usuario->name}} {{$item->usuario->apellidos}} </td>

                                                <td style="font-size: smaller">
                                                    <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if($item->cotizacion>0) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                                </td>


                                                <td style="font-size: smaller">

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

                                    {{ $rq->appends(['gerencia' => 'GAC'])->links() }}

                                    @endcanatleast


                                </div>
                             </div>

                            <div class="tab-pane  @if($gerencia=="GAF")active
@endif" id="tab20">

                                <div class="table-scrollable">



                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>  </th>

                                            <th> Codigo </th>
                                            <th> Area </th>

                                            @if(Auth::user()->area==13)

                                                <th> Fecha Creación </th>
                                            @endif
                                            <th> Fecha Aprobación </th>
                                            <th> Fecha Necesaria U </th>
                                            <th> Fecha Necesaria L</th>

                                            <th>   </th>

                                            <th> Usuario </th>
                                            <th> Status </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])


                                        <?php

                                        if (Auth::user()->sede_id==1){
                                            $ii=$rq2->currentPage();
                                        $i=1;?>
                                        @foreach($rq2 as $item)
                                            <tr>
                                                <td  style="font-size: smaller"> <?php echo $i+(($ii-1)*25); ?> </td>
                                                <td style="font-size: smaller">@if($item->urgente==1) <i class="fa fa-exclamation-circle font-red popovers "   data-trigger="hover"  data-container="body" data-content="Este requerimiento fue marcado como urgente" data-original-title="Ayuda"></i>@endif </td>

                                                <td  style="font-size: smaller"><a href="{{route("rq.show",$item->id)}}"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}}</a>
                                                </td>

                                                <td  style="font-size: smaller"> {{$item->area->area}}</td>

                                                @if(Auth::user()->area==13)
                                                    <td> {{$item->created_at}} </td>
                                                @endif
                                                <td  style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>

                                                <td  style="font-size: smaller"> {{$item->fecha}} </td>

                                                <td style="font-size: smaller"> {{$item->logistica}} </td>

                                                <td  style="font-size: smaller"> {{$item->comentario}} </td>

                                                <td  style="font-size: smaller"> {{$item->usuario->name}} {{$item->usuario->apellidos}} </td>

                                                <td  style="font-size: smaller">
                                                    <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if($item->cotizacion>0) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                                </td>


                                                <td  style="font-size: smaller">

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

                                        <?php
                                        }else{
                                            $ii=0;

                                        }
                                        ?>
                                        @else
                                            <td colspan="7"><div class="note note-danger">
                                                    <h4 class="block">Alerta! </h4>
                                                    <p>  Ud. no tiene permiso para ver esto  </p>
                                                </div></td>
                                            @endcanatleast

                                        </tbody>
                                    </table>

                                    @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])

                                    @if (Auth::user()->sede_id==1)

                                    {{ $rq2->appends(['gerencia' => 'GAF'])->links() }}
                                    @endif

                                    @endcanatleast


                                </div>
                             </div>

                            <div class="tab-pane @if($gerencia=="GCO")active
@endif " id="tab30">

                                <div class="table-scrollable">



                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>  </th>

                                            <th> Codigo </th>
                                            <th> Area </th>

                                            @if(Auth::user()->area==13)

                                                <th> Fecha Creación </th>
                                            @endif
                                            <th> Fecha Aprobación </th>

                                            <th> Fecha Necesaria U </th>
                                            <th> Fecha Necesaria L</th>

                                            <th>   </th>

                                            <th> Usuario </th>
                                            <th> Status </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])


                                        <?php



                                        if (Auth::user()->sede_id==1){
                                            $ii=$rq3->currentPage();




                                        $i=1;?>
                                        @foreach($rq3 as $item)
                                            <tr>
                                                <td  style="font-size: smaller"> <?php echo $i+(($ii-1)*25); ?> </td>
                                                <td style="font-size: smaller">@if($item->urgente==1) <i class="fa fa-exclamation-circle font-red popovers "   data-trigger="hover"  data-container="body" data-content="Este requerimiento fue marcado como urgente" data-original-title="Ayuda"></i>@endif </td>

                                                <td  style="font-size: smaller"><a href="{{route("rq.show",$item->id)}}"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}}</a>
                                                </td>

                                                <td  style="font-size: smaller"> {{$item->area->area}}</td>

                                                @if(Auth::user()->area==13)
                                                    <td> {{$item->created_at}} </td>
                                                @endif
                                                <td  style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>

                                                <td  style="font-size: smaller"> {{$item->fecha}} </td>
                                                <td style="font-size: smaller"> {{$item->logistica}} </td>


                                                <td  style="font-size: smaller"> {{$item->comentario}} </td>

                                                <td  style="font-size: smaller"> {{$item->usuario->name}} {{$item->usuario->apellidos}} </td>

                                                <td  style="font-size: smaller">
                                                    <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if($item->cotizacion>0) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                                </td>


                                                <td  style="font-size: smaller">

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

                                        <?php

                                        }else{
                                            $ii=0;
                                        }
                                        ?>
                                        @else
                                            <td colspan="7"><div class="note note-danger">
                                                    <h4 class="block">Alerta! </h4>
                                                    <p>  Ud. no tiene permiso para ver esto  </p>
                                                </div></td>
                                            @endcanatleast

                                        </tbody>
                                    </table>

                                    @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])
                                    @if (Auth::user()->sede_id==1)

                                    {{ $rq3->appends(['gerencia' => 'GCO'])->links() }}
@endif
                                    @endcanatleast


                                </div>
                             </div>

                            <div class="tab-pane @if($gerencia=="CIT")active
@endif " id="tab40">

                                <div class="table-scrollable">



                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr>
                                            <th> # </th>
                                            <th>  </th>

                                            <th> Codigo </th>
                                            <th> Area </th>

                                            @if(Auth::user()->area==13)

                                                <th> Fecha Creación </th>
                                            @endif

                                            <th> Fecha Aprobación </th>

                                            <th> Fecha Necesaria U </th>
                                            <th> Fecha Necesaria L</th>


                                            <th>   </th>

                                            <th> Usuario </th>
                                            <th> Status </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])


                                        <?php


                                        if (Auth::user()->sede_id==1){

                                            $ii=$rq4->currentPage();





                                        $i=1;?>
                                        @foreach($rq4 as $item)
                                            <tr>
                                                <td  style="font-size: smaller"> <?php echo $i+(($ii-1)*25); ?> </td>
                                                <td style="font-size: smaller">@if($item->urgente==1) <i class="fa fa-exclamation-circle font-red popovers "   data-trigger="hover"  data-container="body" data-content="Este requerimiento fue marcado como urgente" data-original-title="Ayuda"></i>@endif </td>

                                                <td  style="font-size: smaller"><a href="{{route("rq.show",$item->id)}}"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}}</a>
                                                </td>

                                                <td  style="font-size: smaller"> {{$item->area->area}}</td>

                                                @if(Auth::user()->area==13)
                                                    <td> {{$item->created_at}} </td>
                                                @endif
                                                <td  style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>

                                                <td  style="font-size: smaller"> {{$item->fecha}} </td>

                                                <td style="font-size: smaller"> {{$item->logistica}} </td>

                                                <td  style="font-size: smaller"> {{$item->comentario}} </td>

                                                <td  style="font-size: smaller"> {{$item->usuario->name}} {{$item->usuario->apellidos}} </td>

                                                <td  style="font-size: smaller">
                                                    <span class="label label-sm label-{{$item->estados->class}} "> {{$item->estados->name}} @if($item->cotizacion>0) <span class="badge badge-info">  {{$item->cotizacion}} </span>@endif</span>
                                                </td>


                                                <td  style="font-size: smaller">

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

                                        <?php

                                        }else{
                                            $ii=0;

                                        }
                                        ?>

                                        @else
                                            <td colspan="7"><div class="note note-danger">
                                                    <h4 class="block">Alerta! </h4>
                                                    <p>  Ud. no tiene permiso para ver esto  </p>
                                                </div></td>
                                            @endcanatleast

                                        </tbody>
                                    </table>

                                    @canatleast(['lista.rq.todos','lista.rq.usuario','lista.rq.area'])
                                    @if (Auth::user()->sede_id==1)

                                    {{ $rq4->appends(['gerencia' => 'CIT'])->links() }}
@endif
                                    @endcanatleast


                                </div>
                             </div>




                        </div>
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