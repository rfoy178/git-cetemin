
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Centro Tecnológico Minero</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #2 for 500 page option 2" name="description" />
    <meta content="" name="author" />
    <meta name="_token" content="{{ csrf_token() }}"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/pages/css/error.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->
<body class=" page-500-full-page">
@if($estado==2)

<div class="row">
    <div class="col-md-12 page-500">
        <div class=" number font-blue"> <i class="fa fa-check-circle"></i> </div>
        <div class=" details">
            <h3>Bien! </h3>
            <p> El requerimiento se aprobo, se notificara al solicitante.
                <br/> </p>
            <div id="mensaje"  >
                <h5>Escriba algun mensaje [Opcional] </h5>
                <p> <textarea class="form-control" name="txtArea" id="txtArea"></textarea>
                    <br/>
                    <button class="btn-small btn" style="float: right"  onclick="enviar()">Enviar</button>

            </div>
        </div>
    </div>
</div>
@endif
@if($estado==3)
<div class="row">
    <div class="col-md-12 page-500">
        <div class=" number font-red" style="vertical-align: top"> <i class="fa fa-times-circle"></i> </div>
        <div class=" details">

            <p> Se denego el requerimiento, se notificara al solicitante.
               </p>

            <div id="mensaje"  >
                <h5>Escriba algun mensaje [Opcional] </h5>
                <p> <textarea class="form-control" name="txtArea" id="txtArea"></textarea>
                    <br/>
                <button class="btn-small btn" style="float: right"  onclick="enviar()">Enviar</button>

            </div>

        </div>
    </div>


</div>
@endif


<!--[if lt IE 9]>
<script src="{{ asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{ asset('assets/global/plugins/excanvas.min.js')}}"></script>
<script src="{{ asset('assets/global/plugins/ie8.fix.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
<script language="javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
function enviar(){
    var url="{{route("requerimiento.mensaje_jefe")}}";
    var data = {};
    data["id"]="{{$id}}";
    data["mensaje"]=$("#txtArea").val();

    $.post(url, data, "json")
        .done(function( result ) {
            if(result.error){
                toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

            }else{
                // location.reload();

                $("#mensaje").hide();

            }
        })
    ;
}

</script>
</body>

</html>