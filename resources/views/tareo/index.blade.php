@extends('layout.app4')

@section('cabecera')


    <link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />



@endsection


@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Fecha</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                         <a href="javascript:;" class="reload"> </a>
                     </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal form-bordered">
                        <div class="form-body">

                            <div class="form-group ">
                                <label class="control-label col-md-3">Seleccione Rango</label>
                                <div class="col-md-4">
                                    <div id="reportrange" class="btn default">
                                        <i class="fa fa-calendar"></i> &nbsp;
                                        <span> </span>
                                        <b class="fa fa-angle-down"></b>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                    <!-- END FORM-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Detalles</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="reload"> </a>
                    </div>
                </div>
                <div class="portlet-body detalle">
                    <!-- BEGIN FORM-->

                    <!-- END FORM-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>

@endsection
@section ('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script language="javascript">
        moment.locale('es');

        $("#reportrange").daterangepicker(
            {
                opens:  "right",
                startDate: moment().subtract(29,"days"),
                endDate: moment(),
                dateLimit: {
                    days: 60
                },
                showDropdowns: !0,
                timePicker: !1,
                timePickerIncrement: 1,
                timePicker12Hour: !0,
                ranges: {
                    Hoy: [moment(), moment()],
                    Ayer: [moment().subtract(1,"days"), moment().subtract(1,"days")],
                    "Ultimos 7 dias": [moment().subtract(6,"days"), moment()],
                    "Ultimo 30 dias": [moment().subtract(29,"days"), moment()],
                    "Este mes": [moment().startOf("month"), moment().endOf("month")],
                    "Ultimo mes": [moment().subtract(1,"month").startOf("month"), moment().subtract(1,"month").endOf("month")]
                },
                buttonClasses: ["btn"],
                applyClass: "green",
                cancelClass: "default",
                format: "DD/MM/YYYY",
                "maxDate": moment(),

                separator: " a ",
                locale: {
                    applyLabel: "Aplicar",
                    fromLabel: "De",
                    toLabel: "a",
                    customRangeLabel: "Rango personalizado",
                    daysOfWeek: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
                    firstDay: 1
                }
            }, function(t, e) {
                $("#reportrange span").html(t.format("D MMMM , YYYY") + " - " + e.format("D MMMM , YYYY"));
                tareo(t.format("DD-MM-YYYY"),e.format("DD-MM-YYYY"));

            });


        $("#reportrange span").html(moment().subtract(29,"days").format("D MMMM, YYYY") + " - " + moment().format("D MMMM, YYYY"));




        function tareo(inicio,fin){
            var url="{{route("tareo.show","detalle")}}";
             var data = {};
            data["inicio"]=inicio;
            data["fin"]=fin;
            bloqueo($(".detalle"));

            $.get(url, data, "html")
                .done(function( result ) {
                    desbloqueo($(".detalle"));

                    $(".detalle").html(result)
                });
        }


    </script>
@endsection