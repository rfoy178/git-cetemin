@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />



@endsection


@section('main-content')
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-grey-gallery"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Requerimiento <b>{{$rq->area->abreviatura}}-{{str_pad($rq->id, 5, "0", STR_PAD_LEFT)}}</b> </span>
                     </div>

                </div>
                <div class="portlet-body">

                    <div class="row">




                             <div class=" col-md-4 col-sm-12  ">
                                      <div class="portlet yellow-crusta box">
                                         <div class="portlet-title">
                                             <div class="caption">
                                                 <i class="fa fa-cogs"></i>Cotización </div>
                                             <div class="actions">
                                                 <!--<a href="javascript:;" class="btn btn-default btn-sm">
                                                    <i class="fa fa-pencil"></i> Edit </a>-->
                                             </div>
                                         </div>
                                         <div class="portlet-body mt-element-list" style="padding: 0px !important;">


                                                 <div class="mt-list-container list-default bg-white-opacity">

                                                     <ul>
                                                         @foreach($cot as $item)
                                                             <li class="mt-list-item">
                                                                @if($item["TrgetEntry"]=="")
                                                                     <div class="list-icon-container   ">
                                                                         <a href="javascript:;">
                                                                             <i class="icon-doc"></i>
                                                                         </a>
                                                                     </div>

                                                                 @else
                                                                     <div class="list-icon-container done ">
                                                                         <a href="javascript:;">
                                                                             <i class="icon-check"></i>
                                                                         </a>
                                                                     </div>

                                                                 @endif


                                                                 <div class="list-datetime" style="font-size: 12px"> {{ Carbon\Carbon::parse($item["DocDate"])->format('d-m') }}
                                                                 </div>
                                                                 <div class="list-item-content"  style="font-size: 12px">
                                                                     <h3 class="uppercase bold" style="font-size: 12px">
                                                                         <a href="javascript:;">{{$item["CardName"]}}</a>
                                                                     </h3>

                                                                     <p>Oferta <b>{{$item["Cotizacion"]}}</b></p>
                                                                 </div>
                                                             </li>
                                                         @endforeach

                                                     </ul>
                                                 </div>

                                         </div>
                                     </div>
                             </div>





                    </div>


                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Cuadro comparativo</div>
                                    <div class="actions">
                                        <!--
                                        <a href="javascript:;" class="btn btn-circle btn-default">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        -->



                                        @switch($rq->estado)
                                            @case(0)
                                            <a href="javascript:void(0);"  onclick="cargar_formulario(4);" class="btn btn-circle btn-default">
                                                <i class="fa fa-plus"  ></i> Agregar </a>                                            @break

                                            @case(2)
                                            <span></span>
                                            @break

                                            @default
                                            <span> </span>
                                        @endswitch




                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table id="tb-lista" class="table table-hover table-bordered table-striped  ">
                                            <thead>

                                            <tr>
                                                <th colspan="4">  </th>

                                                @foreach($js as $itemx)


                                                    <td colspan="3" style="text-align: center"><b>{{$itemx["Nombre"]}}</b></td>



                                                @endforeach

                                            </tr>
                                            <tr>
                                                <th> # </th>
                                                <th> Codigo SAP </th>
                                                <th> Producto </th>
                                                <th> Cantidad </th>
                                                @foreach($js as $itemx)


                                                    <td>Cantidad</td>

                                                    <td>Precio </td>

                                                    <td>Total</td>

                                                @endforeach

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($linea as $item)
                                                <tr >
                                                    <td style="font-size:11px;"> # </td>
                                            <td style="font-size:11px;"> {{$conta[$item]["Codigo"]}} </td>
                                            <td style="font-size:11px;min-width: 250px">{{$conta[$item]["Descripcion"]}} </td>
                                            <td style="font-size:11px;text-align: right">{{$conta[$item]["Cantidad"]}} </td>

                                                    <?php

                                                        if($conta[$item]["CurSource"]=='L'){
                                                            $moneda="S/ ";
                                                        }else{
                                                            $moneda="$ ";
                                                        }
                                                    ?>

                                                    <?php $r=1?>
                                            @foreach($js as $itemx)


                                                        <td @if(($r==1) or ($r==3)  or ($r==5) )
                                                            class="active"
                                                            @endif
                                                            style="font-size:11px;text-align: right;min-width: 70px"> {{$conta[$item][$itemx["Codigo"]]["Cantidad"]}}</td>

                                                        <td  @if(($r==1) or ($r==3)  or ($r==5) )
                                                             class="active"
                                                             @endif style="font-size:11px;text-align: right;min-width: 80px"> {{$moneda.number_format($conta[$item][$itemx["Codigo"]]["Price"],2,".","")}} </td>

                                                        <td  @if(($r==1) or ($r==3)  or ($r==5) )
                                                             class="active"
                                                             @endif  style="font-size:11px;text-align: right;min-width: 80px"> {{$moneda.number_format($conta[$item][$itemx["Codigo"]]["LineTotal"],2,".","")}} </td>
                                                    <?php $r++; ?>
                                            @endforeach



                                                </tr>
                                            @endforeach


                                            </tbody>
                                            <tfoot>

                                            <tr>
                                                <th colspan="4"> Condiciones de Pago </th>
                                                @foreach($js as $itemx)


                                                    <td colspan="3">{{$itemx["Pago"]}}</td>



                                                @endforeach

                                            </tr>
                                            <tr>
                                                <th colspan="4"> Total </th>
                                                @foreach($js as $itemx)


                                                    <td colspan="3" style="text-align: right">{{$moneda.number_format($itemx["Total"],2,".","")}}</td>



                                                @endforeach

                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">


                            @switch($rq->estado)
                                @case(0)

                                <a class="btn btn-lg green hidden-print margin-bottom-5" href="{{route("requerimiento.email",$rq->id)}}"> Enviar a aprobación JEFE

                                    <i class="fa fa-check"></i>

                                </a>
                                @break
                                @case(1)

                                <a class="btn btn-lg green hidden-print margin-bottom-5" href="{{route("requerimiento.email",$rq->id)}}"> Volver a Enviar a aprobación JEFE

                                    <i class="fa fa-check"></i>

                                </a>
                                @break

                                @case(2)

                                <button class="btn btn-lg green hidden-print margin-bottom-5"  onclick="javascript:comprobar()"> Comprobar y Enviar a SAP

                                    <i class="fa fa-check"></i>

                                </button>
                                @break

                                @default
                                <span> </span>
                            @endswitch




                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRID PORTLET-->
        </div>
    </div>







@endsection
@section ('script')

@endsection