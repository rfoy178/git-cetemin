<style>


    #tb-lista-mov{
        font-size: 10px;
    }
    #tb-lista-mov tr{
        font-size: 10px;
    }
    #tb-lista-mov td{
        font-size: 10px;
    }


    #tb-lista-mov th{
        font-size: 10px;
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


    #tb-cca th{
        font-size: 10px;
    }

</style>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-puzzle font-grey-gallery"></i>
            <span class="caption-subject bold font-grey-gallery uppercase"> Rendición de dinero </span>
            <span class="caption-helper"></span>
        </div>
        <div class="tools hidden-print ">
            <a href="" class="@if($rq->estado==9) expand @else collapse @endif " data-original-title="" title=""> </a>
            <a href="" class="fullscreen" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body"  >

        <div class="row hidden-print">
            <div class="col-md-6">
                <div class="btn-group">
                    <button id="sample_editable_1_new" class="btn sbold green popovers" onclick="javascript:$('#modalNew').modal();"   data-trigger="hover"  data-container="body" data-content="Añade documento a tu rendición como boletas, facturas, movilidades, etc." data-original-title="Ayuda">Añadir documentos
                        <i class="fa fa-plus"></i>
                    </button>
                </div>


            </div>

        </div>

<p></p>


        <div class="row">
            <div class="col-md-12 col-sm-12">


                <div id="tabla"  >

                <table class="table table-striped table-bordered table-advance table-hover" id="tb-lista">
                    <thead>
                    <tr>



                        <th style="min-width: 15px;max-width: 15px">#</th>
                        <th> CC </th>
                        <th> <i class="fa fa-calendar"></i>  Fecha </th>
                        <th> <i class="fa fa-file-pdf-o"></i>  Documento </th>
                        <th> <i class="fa fa-users"></i> Proveedor </th>
                        <th> <i class="fa fa-reorder "></i> Concepto</th>
                        <th> <i class="fa fa-money "></i> Total </th>
                        <th class=" ">   </th>



                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>




            </div>



        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 name"> </div>

                <div class="col-md-12 name">{{$rq->Comments}}</div>

            </div>

            @if(isset($total))
            <div class="col-md-6">
                <div class="well">
                    <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> TOTAL GASTO: </div>
                        <div class="col-md-3 value" id="divSubTotal"> </div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> TOTAL RECIBIDO: </div>
                        <div class="col-md-3 value" id="divRecibido"> </div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> TOTAL DEVUELTO: </div>
                        <div class="col-md-3 value" id="divDevuelto">   </div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> TOTAL A REEMBOLSAR: </div>
                        <div class="col-md-3 value" id="divReembolsar">   </div>
                    </div>
                </div>
            </div>
            @endif



        </div>
        @if($rq->estado=9)

            @if(($rq->user_id==\Auth::user()->id)||($rq->email==\Auth::user()->email))
                <div class="row">
                    <div class="col-md-12" id="divBtn">
                     </div>
                </div>





                @endif

        @endif

    </div>
</div>
<style>

    .sweet-alert{
        z-index: 9999999;
    }
</style>
<div class="modal fade"   id="modalCC"  role="dialog"  >
    <div class="modal-dialog" role="document">
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
                                <th>Porcentaje  </th>
                                <th>  </th>

                            </tr>

                            </thead>
                            <tbody>

                            </tbody>
                </table>
                        <button class="btn blue btn-block" onclick="javascript:aplicarTodos()" >Aplicar CC a todos las documentos.</button>
                    </div>


                </div>
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
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalMovilidad"  role="dialog"  >
    <div class="modal-dialog" role="document">
        <div class="modal-content"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Movilidades</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="frmMovilidad">
                            <input type="hidden" name="movilidad" id="movilidad">
                            <table class="table table-responsive table-bordered table-striped table-condensed flip-content " id="tb-lista-mov">

                                <thead>

                            <tr>
                                <th>#</th>
                                <th style="width: 150px"> Fecha </th>
                                <th> Concepto</th>
                                <th> Monto </th>
                                <th> </th>


                            </tr>
                            <tr>
                                <td style="    padding: 0px 0px 0px 0px !important;"></td>
                                <td style="    padding: 0px 0px 0px 0px !important;">
                                    <div class="input-group input-xs date date-picker"  data-date-end-date="0d"   data-date-format="dd-mm-yyyy"  >
                                        <input type="text" class="form-control" readonly=""   required id="fecha_movilidad" name="fecha_movilidad">
                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                </td>
                                <td style="    padding: 0px 0px 0px 0px !important;">  <input type="text" class="form-control input-sm" required="" id="motivo_movilidad" name="motivo_movilidad"> </td>
                                <td style="    padding: 0px 0px 0px 0px !important;">  <input type="text" class="form-control input-sm" required="" id="monto_movilidad" name="monto_movilidad"> </td>
                                <td style="    padding: 0px 0px 0px 0px !important;"> <a href="javascript:add_mov()" class="btn btn-xs default">
                                        <i class="fa fa-plus-square"></i>
                                    </a> </td>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                        </form>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalNew"   role="dialog"  >
    <div class="modal-dialog" role="document">
        <div class="modal-content"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Datos del documento</h4>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; font-size: 12px">

                <form id="frmRendir">
                    {{ csrf_field() }}
                    <input type="hidden" id="deposito_id" name="deposito_id" value="{{$rq->id}}">

                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fecha Documento </label>
                            <div class="col-md-3">

                                <div class="input-group input-xs date date-picker"   data-date-end-date="0d"  data-date-format="dd-mm-yyyy"  >


                                    <input type="text" class="form-control" readonly=""   required id="fecha" name="fecha">
                                    <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                </div>


                                </div>

                            <label class="col-md-2 control-label">Tipo Doc </label>
                            <div class="col-md-4">

                                <select class="form-control  input-sm"  id="tipo" name="tipo" required>
                                    @foreach($tip as $item)
                                        <option    value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group ocultar">
                            <label class="col-md-3 control-label"> RUC</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-sm   "   required id="ruc" name="ruc">
                            </div>
                            <label class="col-md-2 control-label">Numero </label>
                            <div class="col-md-4">

                                <input type="text" class="form-control input-sm   "   required id="serie" name="serie">


                            </div>

                        </div>
                        <div class="form-group ocultar">
                            <label class="col-md-3 control-label">Proveedor </label>
                            <div class="col-md-9">

                                <input type="text" class="form-control input-sm"   required id="proveedor" name="proveedor">


                                 </div>
                        </div>

                        <div class="form-group ocultar">
                            <label class="col-md-3 control-label">Concepto </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-sm"   required id="concepto" name="concepto"></div>
                        </div>

                        <div class="form-group ocultar">
                            <label class="col-md-3 control-label">Total </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-sm   "   required id="monto" name="monto"> </div>
                        </div>
                    </div>


                </form>


            </div>

            <div class="modal-footer" style="padding-top: 0px !important;">



                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn green" onclick="javascript:add();">Guardar</button>
            </div>

        </div>
    </div>
</div>

<script src="{{asset("assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")}}" type="text/javascript"></script>

<script language="JavaScript">
    var falta_c=false;

    $("#serie").inputmask({
        mask: "**99[-9{1,10}]", greedy: false ,
        placeholder: "0000-00000000"
    });
    $("#ruc").inputmask({
        mask: "99999999999",
        placeholder: ""
    });
    $( "#tipo" )
        .change(function () {

            if($("#tipo").val()=="MV"){

                $(".ocultar").addClass("hidden")
            }else{

                $(".ocultar").removeClass("hidden")

            }


        }).change();
    function popupMovilidad(id){
        $("#modalMovilidad").modal();
        $("#movilidad").val(id);
        cargarMovilidad($("#movilidad").val());
     }
    function aplicarTodos() {


        var data = {};

        data["_token"]="{{ csrf_token() }}";
        data["deposito_id"]={{$rq->id}};
        data["rendir_id"]=$("#fila").val();


        var url="{{route("caja.aplicar_todos")}}";
         $.post(url, data, "json")
            .done(function( result ) {
                if(result.error){
                    toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                }else{
                    cargar({{$rq->id}});
                    $("#modalCC").modal('hide');

                 }
            });

    }
    function add() {

        var val;
        val=0;

        if($("#tipo").val()=="MV"){

             if($("#fecha").val()==""){
                swal("Mensaje!", "Por favor escriba la fecha!", "info");
                val=1;
            }

        }else{
            if($("#fecha").val()==""){
                swal("Mensaje!", "Por favor escriba la fecha!", "info");
                val=1;
            }

            if($("#concepto").val()==""){
                swal("Mensaje!", "Por favor escriba concepto!", "info");
                val=1;
            }
            if($("#monto").val()=="") {
                swal("Mensaje!", "Por favor escriba monto!", "info");
                val = 1;
            }
            if($("#ruc").val()==""){
                swal("Mensaje!", "Por favor escriba numero de RUC!", "info");
                val=1;            }
            if($("#serie").val()==""){
                swal("Mensaje!", "Por favor escriba serie!", "info");
                val=1;            }

        }

        if( val==0){

            var url="{{route("caja.rendir_fila")}}";
            bloqueo("#tb-lista");
            $.post(url, $("#frmRendir").serialize(), "json")
                .done(function( result ) {
                    if(result.error){
                        toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                    }else{
                        cargar({{$rq->id}});
                        desbloqueo("#tb-lista");
                    }
                    document.getElementById("frmRendir").reset();
                    $('#modalNew').modal('hide');

                })
            ;
        }
    }
    function cargar(id){
        var data = {};
        data["id"]=id;
        data["_token"]="{{ csrf_token() }}";
        var url = "{{route("caja.rendir_listado")}}";
        $.post(url,data,function(resp){
            $("#tb-lista tbody").empty()
            if(resp.error){
                toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
            }else{
                var i=0;
                falta_c=false;
                $.each(resp.data,function(key,item) {
                    i++;
                    var tr = "";
                    tr += '<tr>';
                    tr += '<td>' + i +'</td>';
                    var sum=0;
                    $.each(item.cc,function(key2,item2) {
                        sum=sum+eval(item2.porcentaje);
                        console.log(sum);
                    });
                    var color;
                    if(eval(sum)==100){
                        color="blue";
                    }else{
                        color="red";
                        if(falta_c==false){
                            falta_c=true;
                        }
                    }


                    tr += '<td><a href="javascript:popup(' + item.id +');" ><i class="fa font-' + color +' fa-cc"></i> </a></td>';
                    tr += '<td>' + item.fecha +'</td>';

                    if(item.tipo.id=="MV"){
                        tr += '<td ><a href="javascript:popupMovilidad(' + item.id +')">' + item.tipo.nombre+'</a></td>';
                        tr += '<td></td>';
                        tr += '<td></td>';
                    }else{
                        tr += '<td >' + item.tipo.nombre+'<br>' + item.serie +'</td>';
                        tr += '<td>' + item.ruc +'<br>' + item.proveedor.razon_social +'</td>';
                        tr += '<td>' + item.concepto +'</td>';
                    }
                    tr += '<td style="text-align: right">' + Number(item.monto).toFixed(2) +'</td>';
                    tr += '<td style="width: 20px" class="hidden-print "><a href="javascript:eliminar(' + item.id +');" class="btn btn-xs red"><i class="fa fa-trash-o"></i>       </a></td>';
                    tr += '</tr>';
                    $('#tb-lista').append(tr);
                });


                $("#divSubTotal").html(resp.gastos);
                $("#divRecibido").html(resp.total);
                $("#divDevuelto").html(resp.devolucion);
                $("#divReembolsar").html(resp.reembolso);

                btn='<a  class="btn   green hidden-print margin-bottom-5" href="{{route("caja.send",$rq->id)}}"> Enviar a contabilidad <i class="fa fa-check"></i> </a>';
                btn2='<a disabled="" class="btn    green hidden-print margin-bottom-5"   > Enviar a contabilidad <i class="fa fa-check"></i> </a>';


                $("#divBtn").html("");

                if(falta_c==false) {
                    $("#divBtn").html(btn);
                }else{
                    $("#divBtn").html(btn2);

                }







             }
        }).fail(function(){
            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")
        });
    }
    cargar({{$rq->id}});
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
        data["rendir_id"]=$("#fila").val();

        var url="{{route("caja.rendir_fila_cc")}}";
            bloqueo("#tb-cca");
            $.post(url, data, "json")
                .done(function( result ) {
                    if(result.error){
                        toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                    }else{
                        cargarCC($("#fila").val());
                        desbloqueo("#tb-cca");
                        cargar({{$rq->id}});

                    }
                });

    }
    function actualizarCC(id) {
        var data = {};
        data["id"]=id;
        data["_token"]="{{ csrf_token() }}";
        data["porcentaje"]=$("#P"+id).val();
        var url="{{route("caja.update_cc")}}";
        bloqueo("#tb-cca");
        $.post(url, data, "json")
            .done(function( result ) {
                if(result.error){
                    toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                }else{
                    cargarCC($("#fila").val());
                    cargar({{$rq->id}});

                    desbloqueo("#tb-cca");
                }
            })
        ;


    }
    function eliminarCC(id) {
        var data = {};
        data["id"]=id;

        data["_token"]="{{ csrf_token() }}";


        var url="{{route("caja.eliminar_cc")}}";
        bloqueo("#tb-cca");

        $.post(url, data, "json")
            .done(function( result ) {
                if(result.error){
                    toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                }else{
                    cargarCC($("#fila").val());
                    cargar({{$rq->id}});

                    desbloqueo("#tb-cca");
                }
            })
        ;

        cargar({{$rq->id}});

    }
    function cargarCC(id){

        var data = {};
        data["id"]=id;
        data["_token"]="{{ csrf_token() }}";

        var url = "{{route("caja.rendir_listado_cc")}}";
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
                    tr += '<td> <input type="text" value="' + item.porcentaje +'" class="form-control input-xsmall  input-sm" name="P' + item.id+ '" id="P' + item.id+ '"> </td>';
                    tr += '<td><a href="javascript:actualizarCC(' + item.id + ');" class="btn btn-xs default"><i class="fa fa-save"></i></a><a href="javascript:eliminarCC(' + item.id + ');" class="btn btn-xs default"><i class="fa fa-trash-o"></i></a></td>';
                    tr += '</tr>';
                    $('#tb-cca').append(tr);
                });

                tr='';
                tr += '<tr';
                if(resp.total!=100){
                    tr += ' class="danger" ';
                }else{
                    tr += ' class="success" ';
                }

                tr += '><td colspan="6">TOTAL PORCENTAJE</td>';
                tr += '<td >' + resp.total +'</td>';
                tr += '<td>  </td>';
                tr += '</tr>';


                $('#tb-cca').append(tr);
                cargar({{$rq->id}});

            }

        }).fail(function(){

            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

        });

    }
    $( "#ruc" ).keyup(function( event ) {
        var ruc=$("#ruc").val();
        x=ruc.length
        if(x==11){
            $("#ruc").addClass("loading2");
            $("#proveedor").val("");
            var url;
            url="{{route("api.ruc","xxx")}}";
            url=url.replace("xxx",$("#ruc").val());
            $.post(url, "json")
                .done(function( result ) {
                    $("#proveedor").val(result.razon_social);
                    $("#ruc").removeClass("loading2");
                })
            ;
        }
    }).keydown(function( event ) {
        if ( event.which == 13 ) {
            event.preventDefault();
        }
    });
    function eliminar(id){

        var url;

        url="{{route("caja.del_articulo","xxxx")}}";

        url=url.replace("xxxx",id)

        $.ajax({
            // la URL para la petición
            url : url,
            type : 'POST',
            dataType : 'html',

            success : function(resul) {
                cargar({{$rq->id}});
                toastr["success"]("Se guardo registro ", "SAP Online")
            },
            error : function(xhr, status) {
                toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")
            }
        });
    }
    function add_mov() {
        var val;
        val=0;
            if($("#fecha_movilidad").val()==""){
                swal("Mensaje!", "Por favor escriba la fecha!", "info");
                val=1;
            }
            if($("#motivo_movilidad").val()==""){
                swal("Mensaje!", "Por favor escriba concepto!", "info");
                val=1;
            }
            if($("#monto_movilidad").val()=="") {
                swal("Mensaje!", "Por favor escriba monto!", "info");
                val = 1;
            }
        if( val==0){
            var url="{{route("caja.movilidad_fila")}}";
            bloqueo("#tb-lista-mov");
            $.post(url, $("#frmMovilidad").serialize(), "json")
                .done(function( result ) {
                    if(result.error){
                        toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                    }else{
                        cargarMovilidad($("#movilidad").val());
                        desbloqueo("#tb-lista-mov");
                        $("#fecha_movilidad").val("");
                        $("#motivo_movilidad").val("");
                        $("#monto_movilidad").val("");
                    }
                })
            ;
        }





    }
    function cargarMovilidad(id){
        var data = {};
        data["id"]=id;
        data["_token"]="{{ csrf_token() }}";
        var url = "{{route("caja.movilidad_listado")}}";
        $.post(url,data,function(resp){
            $("#tb-lista-mov tbody").empty()
            if(resp.error){
                toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
            }else{
                var i=0;
                $.each(resp.data,function(key,item) {
                    i++;
                    var tr = "";
                    tr += '<tr>';
                    tr += '<td>' + i +'</td>';
                    tr += '<td>' + item.fecha +'</td>';
                    tr += '<td>' + item.concepto +'</td>';
                     tr += '<td style="text-align: right">' + Number(item.monto).toFixed(2) +'</td>';
                    tr += '<td style="width: 20px"><a href="javascript:eliminar_mov(' + item.id +');" class="btn btn-xs red"><i class="fa fa-trash-o"></i>       </a></td>';
                    tr += '</tr>';
                    $('#tb-lista-mov').append(tr);
                });
                cargar({{$rq->id}});

            }
        }).fail(function(){
            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")
        });
    }
    function eliminar_mov(id){

        var url;

        url="{{route("caja.movilidad_eliminar","xxxx")}}";

        url=url.replace("xxxx",id)

        $.ajax({
            // la URL para la petición
            url : url,
            type : 'POST',
            dataType : 'html',

            success : function(resul) {
                cargarMovilidad($("#movilidad").val());
                toastr["success"]("Se guardo registro ", "SAP Online")
            },
            error : function(xhr, status) {
                toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")
            }
        });
    }

</script>