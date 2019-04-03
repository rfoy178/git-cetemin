@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />
    <link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=0.75">

<style>

    @media screen and (max-width: 320px) {

    }
</style>
@endsection


@section('main-content')
    <form id="frm" name="frm" method="post" action="{{route("caja.generar_txt")}}">
        {{ csrf_field() }}

        <input type="hidden" id="id" name="id" value="{{$cuenta->id}}">


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject   sbold uppercase">{{$cuenta->nombre}}</span>
                    </div>



                    <div class="actions hidden-print">
                        <a href="javascript:;"  onclick="javascript:window.print();" class="btn btn-circle btn-default btn-sm">
                            <i class="fa fa-print"></i> Imprimir </a>
                        <a href="{{route("caja.descargar",$id)}}"   class="btn btn-circle btn-default btn-sm">
                            <i class="fa fa-file-excel-o"></i> Excel </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""></a>
                    </div>







                </div>
                <div class="portlet-body">
                    <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <td> </td>
                                <td> # </td>

                                <th> Codigo </th>

                                <th> Fecha Aprobación </th>
                                <th> Beneficiario </th>
                                <th>   </th>
                                <th>   </th>

                                <th> Monto S/ </th>

                                <th> Area </th>
                                <th>   </th>



                                <th> Asunto </th>

                                <th> Doc SAP </th>

                                <th> Fecha Necesaria </th>
                                <th> Solicitante </th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @canatleast(['tesoreria','lista.rq.usuario','lista.rq.area'])
                            <?php  $ii=1;
                            $i=1;
                            $suma=0;
                            ?>
                            @foreach($rq as $item)
                                <tr>
                                    <td> </td>
                                    <td> {{$i}}</td>

                                    <td>
                                        <a href="{{route("caja.show",$item->rq->id)}}" class="hidden-print">
                                            <span class="label label-sm label-success"> {{$item->rq->area->abreviatura}}-{{str_pad($item->rq->id, 5, "0", STR_PAD_LEFT)}} </span></a>
<span class="visible-print">{{$item->rq->area->abreviatura}}-{{str_pad($item->rq->id, 5, "0", STR_PAD_LEFT)}}</span>


                                    </td>


                                    <td style="font-size: smaller"> {{$item->rq->fecha_aprobacion}} </td>



                                    <td style="font-size: smaller"> <strong>{{$item->rq->dni}} </td>

                                    <td style="font-size: smaller">{{$item->rq->nombre}}  </td>

                                    <td style="font-size: smaller">S/</td>


                                    <td style="text-align: right;font-size: smaller">
                                        {{number_format($item->rq->monto,2,".",",")}}
                                    </td>

                                    <td style="font-size: smaller">
                                        <strong>
                                            @if($item->rq->usuario->sede_id==1)
                                                LIM
                                            @else
                                                AQP
                                            @endif</strong>
                                    </td>
                                    <td style="font-size: smaller">


                                        {{$item->rq->area->area}} </td>





                                    <td  style="font-size: smaller"> {{$item->rq->descripcion}} </td>
                                    <td  style="font-size: smaller"> {{$item->docEntry}} {{$item->mensaje_sap}}</td>

                                    <td style="font-size: smaller"> {{$item->rq->fecha_necesaria}} </td>
                                    <td style="font-size: smaller"> {{$item->rq->usuario->name}}   </td>




                                    <td>
<!--
                                        <a href="javascript:;" data-id="{{$item->id}}" class="  hidden-print     btnConfirmar "  data-placement="left"  data-toggle="confirmation"  data-btn-ok-label="Continuar" data-btn-ok-class="btn-success"
                                           data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                                           data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger"
                                           data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?">
                                            <i class="fa fa-remove "></i></a>
-->
                                    </td>
                                </tr>
                                <?php $i++;
                                $suma=$suma+ $item->rq->monto;
                                ?>
                            @endforeach
                            <input type="hidden" id="cantidad" name="cantidad" value="{{$i}}">

                            <input type="hidden" id="suma" name="suma" value="{{$suma}}">


                            <tr>
                                <td colspan="10">  </td>
                                <td style="text-align: right;font-size: smaller">
                                    S/{{number_format($suma,2,".",",")}}
                                </td>

                                <td>
                                <!--
                                        <a href="javascript:;" data-id="{{$item->id}}" class="  hidden-print     btnConfirmar "  data-placement="left"  data-toggle="confirmation"  data-btn-ok-label="Continuar" data-btn-ok-class="btn-success"
                                           data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                                           data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger"
                                           data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?">
                                            <i class="fa fa-remove "></i></a>
-->
                                </td>
                            </tr>

                            @else
                                <td colspan="7"><div class="note note-danger">
                                        <h4 class="block">Alerta! </h4>
                                        <p>  Ud. no tiene permiso para ver esto  </p>
                                    </div></td>
                                @endcanatleast

                            </tbody>
                        </table>


                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->




        </div>
    </div>
    </form>

@endsection
@section ('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script language="javascript">

        $(".btnConfirmar").on("confirmed.bs.confirmation", function() {
            var del="{{route("caja.quitar_txt","xxx")}}";
            var url=del.replace("xxx",$(this).data("id"));
            $.ajax({
                url: url,
                type: 'post',  // user.destroys
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