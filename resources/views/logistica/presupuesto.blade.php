@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />

    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/lang/es.js"></script>

    <style>
        #table1  th {
            font-size: 11px !important;
            font-weight: bold;
        }
        #table1  tr {
            font-size: 11px !important;
        }
        #table1 tr td {
            font-size: 11px !important;
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
                        <i class="fa fa-bar-chart"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase">Control de Presupuesto </span>

                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                     </div>
                </div>
                <div class="portlet-body">
                    <form class="row" id="frm">
                        <div class="col-md-6">
                            <select class="form-control" name="presupuesto" id="presupuesto">
                                @foreach($presupuesto as $itemx)
                                    <option value="{{$itemx->id}}" style="{{$itemx->style}}">{{$itemx->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="0">ACUMULADO</option>
                                <option value="1">MENSUAL</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select class="form-control" name="mes" id="mes">
                                <?php
                                use Carbon\Carbon;$date = Carbon::now();
                                $ano = $date->format('Y');
                                $mes = $date->format('m');
                                ?>
                                    @for ($i = 1; $i <= $mes; $i++)
                                        <option value="{{$ano}}{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}">{{$ano}}{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</option>
                                    @endfor
                            </select>
                        </div>

                        <div class="col-md-2">
                        <button type="button" class="btn blue btn-block" onclick="mostrar()">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="divMostrar">
        </div>
    </div>


@endsection
@section ('script')
    <script language="javascript">
        jQuery(document).ajaxComplete(function() {
            jQuery("a[title='JavaScript charts']").remove();
        });
        function mostrar(){
            var url="{{route("presupuesto")}}";
            var data = $("#frm").serialize();
            bloqueo("#divMostrar");
            $.post(url, data, "html")
                .done(function( result ) {
                    if(result.error){
                        toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                    }else{
                        // location.reload();
                        $("#divMostrar").html(result);
                        desbloqueo("#divMostrar");
                    }
                })
            ;
        }
    </script>
@endsection