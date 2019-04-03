<style>
     #tb-lista-cc{
        font-size: 10px;
    }
    #tb-lista-cc tr{
        font-size: 10px;
    }
    #tb-lista-cc td{
        font-size: 10px;
    }


    #tb-lista-mov th{
        font-size: 10px;
    }
    #tb-lista-mov{
        font-size: 10px;
    }
    #tb-lista-cmovc tr{
        font-size: 10px;
    }
    #tb-lista-mov td{
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-puzzle font-grey-gallery"></i>
            <span class="caption-subject bold font-grey-gallery uppercase"> Validación contable </span>
            <span class="caption-helper"></span>
        </div>
        <div class="tools">
            <a href="" class="@if($rq->estado==9) expand @else collapse @endif " data-original-title="" title=""> </a>
            <a href="" class="fullscreen" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body"  >


        <div class="row hidden-print">
            <div class="col-md-6">


                <a class="btn   blue hidden-print  " target="_blank" href="{{route("caja.pdf",$rq->id)}}"  > Imprimir
                    <i class="fa fa-print"></i>
                </a>
            </div>

        </div>


        <div class="row">
            <form id="frmRendir">

@if (\Auth::user()->can("contabilidad"))
                <div class="row">
                    <div class="col-md-12 col-sm-12">



                <div class="form-group">
                    <label class="col-md-2 control-label">Codigo Rendición</label>
                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fa fa-bars  fa-bars"></i>
                                <input id="codigo_caja" class="form-control" type="text" name="codigo_caja" placeholder="Codigo de caja" value="{{$rq->caja}}"> </div>
                            <span class="input-group-btn">
                                                            <button id="genpassword" class="btn btn-success" type="button" onclick="javascript:rendicion()">
                                                                <i class="fa fa-save   "></i> Guardar</button>
                                                        </span>
                        </div>




                    </div>
                </div>




                    </div>
                </div><br>
@endif


                <div class="row">

                <div class="col-md-12 col-sm-12">
                <div id="tabla" class="table-responsive col-sm-12">


                        {{ csrf_field() }}

                        <input type="hidden" id="deposito_id" name="deposito_id" value="{{$rq->id}}">



                    <table class="table table-responsive table-bordered table-striped table-condensed flip-content " id="tb-lista">
                        <thead>

                        <tr>

                            @if (\Auth::user()->can("contabilidad"))

                            <th  style="width: 20px"></th>

@endif

                            <th  style="width: 30px">#</th>
                            <th style="width: 110px">Fecha Documento </th>
                            <th  >SAP </th>
                            <th style="width: 110px">Documento </th>

                            <th>Proveedor</th>
                            <th>Concepto</th>
                            <th>Total </th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
                </div>

            </form>



        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 name">Comentarios</div>

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
                            <div class="col-md-3 value" id="divRecibido"> }</div>
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


    </div>
</div>

@if (\Auth::user()->can("contabilidad"))
<div class="modal fade" id="modalCC"   role="dialog"  >
    <div class="modal-dialog" >
        <div class="modal-content"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Datos del documento</h4>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; font-size: 12px">
                <form   id="frmMovilidad">
                    <div class="row">
                        <div class="col-sm-12">
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
                                        <div class="input-group input-xs date date-picker"   data-date-format="dd-mm-yyyy"  >
                                            <input type="text" class="form-control  input-sm" readonly  required id="fecha_movilidad" name="fecha_movilidad">
                                            <span class="input-group-btn">
                                                                <button class="btn default btn-xs" type="button">
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
                        </div>
                    </div>

            </form>
                <form action="" name="frmF" id="frmF">

                    <input type="hidden"  id="c_id" name="c_id"  >

                <div class="row">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fecha Documento </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control   input-sm "    id="c_fecha" name="c_fecha"  > </div>

                        <label class="col-md-3 control-label">Fecha Contable </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control  input-sm "  id="c_fecha_contable" name="c_fecha_contable"   > </div>
                    </div>
                    <div class="form-group mov">
                        <label class="col-md-3 control-label">RUC </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control  input-sm  "    id="c_ruc" name="c_ruc"  > </div>
                    </div>

                    <div class="form-group mov">
                        <label class="col-md-3 control-label">Proveedor </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control  input-sm  "    id="c_proveedor" name="c_proveedor"  > </div>
                    </div>


                    <div class="form-group mov">
                        <label class="col-md-3 control-label">Tipo Doc </label>
                        <div class="col-md-3">

                            <select class="form-control  input-sm"  id="c_tipo" name="c_tipo" required>
                                @foreach($tip as $item)
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>

                        </div>
                        <label class="col-md-3 control-label mov">Serie </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control  input-sm " id="c_serie" name="c_serie"   > </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Concepto </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control  input-sm " id="c_concepto" name="c_concepto"   >
                        </div>
                    </div>






                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipo Gasto </label>
                        <div class="col-md-9">
                            <select class="form-control  input-sm" id="c_servicio_id" name="c_servicio_id" >
                                @foreach($servicios as $item)
                                    <option value='{{$item["ItemCode"]}}'>{{$item["ItemCode"]}} - {{$item["ItemName"]}}</option>
                                @endforeach

                            </select></div>
                    </div>
                    <div class="form-group mov">
                        <label class="col-md-3 control-label">Impuesto </label>
                        <div class="col-md-9">
                            <select class="form-control  input-sm" id="c_impuesto" name="c_impuesto">
                                @foreach($iva as $item)
                                    <option value='{{$item["id"]}}'>{{$item["codigo"]}} - {{$item["nombre"]}}</option>
                                @endforeach
                            </select></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Total </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control  input-sm  "    id="c_total" name="c_total"  > </div>
                    </div>
                </div>

<div class="row">
    <div class="col-md-12">
    <div class="form-group">
        <div class="mt-checkbox-list">
            <label class="mt-checkbox">Enviar a SAP
                <input type="checkbox" value="1" name="sap" id="sap">
                <span></span>
            </label>

        </div>

    </div>
    </div>



                </div>
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_15_1" data-toggle="tab" aria-expanded="true"> Centro de Costos </a>
                        </li>
                        <li class="">
                            <a href="#tab_15_2" data-toggle="tab" aria-expanded="false"> Centro de costos validos </a>
                        </li>

                    </ul>
                    <div class="tab-content" style="padding-top: 0px !important;padding-bottom: 0px !important;">
                        <div class="tab-pane active" id="tab_15_1">
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

                                </div>


                            </div>

                        </div>
                        <div class="tab-pane" id="tab_15_2">
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
                </form>

            </div>
            <div class="modal-footer" style="padding-top: 0px !important;">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancelar</button>
                <button type="button"   class="btn green btnActualizar"  onclick="javascript:actualizarF();">Guardar</button>
            </div>

        </div>
    </div>
</div>
@endif

<script src="{{asset("assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")}}" type="text/javascript"></script>

<script language="JavaScript">

    $("#ruc").inputmask({
        mask: "99999999999",
        placeholder: ""
    });
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
    function rendicion() {
        var data = {};
        data["_token"]="{{ csrf_token() }}";
        data["codigo"]=$("#codigo_caja").val();
        data["deposito_id"]={{$rq->id}};

        var url="{{route("caja.rendicion")}}";
        $.post(url, data, "json")
            .done(function( result ) {
                if(result.error){
                    toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                }else{
                    cargar({{$rq->id}});
                }
            });
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
                $.each(resp.data,function(key,item) {
                    i++;
                    var tr = "";
                    tr += '<tr>';

                    @if (\Auth::user()->can("contabilidad"))

                    if(item.sap==1){
                            tr += '<td><span class="item-status"><span class="badge badge-empty badge-warning"></span>  </span></td>';
                        }
                        if(item.sap==0){
                            tr += '<td><span class="item-status"><span class="badge badge-empty badge-danger"></span>  </span></td>';
                        }
                        if(item.sap==2){
                            tr += '<td><span class="item-status"><span class="badge badge-empty badge-success"></span>  </span></td>';
                        }
                    if(item.sap>2){
                        tr += '<td> <i class="fa fa-exclamation-circle popovers"  data-trigger="hover" data-container="body" data-content="' + item.mensaje_sap +'" data-original-title="Ayuda"></i>    </td>';
                    }




                      @endif

  //                  }
                    tr += '<td>' + i +'</td>';
                    tr += '<td>' + item.fecha +'</td>';


                    if(item.sap==2){
                        tr += '<td>' + item.docEntry+'<br><b>' + item.docNum +'</b></td>';
                    }else{
                        tr += '<td> </td>';
                    }
                    if(item.tipo.id=="MV"){

                        @if (\Auth::user()->can("contabilidad"))
                        tr += '<td ><a href="javascript:popup(' + item.id +')">' + item.tipo.nombre+'</a></td>';
                        @else
                        tr += '<td >' + item.tipo.nombre+'</td>';

                        @endif

                        tr += '<td></td>';
                        tr += '<td></td>';
                    }else{

                        @if (\Auth::user()->can("contabilidad"))
                        tr += '<td><a href="javascript:popup(' + item.id +');" >' + item.tipo.nombre+'<br><b>' + item.serie +'</b></a></td>';
                        @else
                        tr += '<td>' + item.tipo.nombre+'<br><b>' + item.serie +'</b></td>';
                        @endif

                        tr += '<td>' + item.ruc ;
                        if(item.proveedor.estado==0) {
                            tr += '<i class="fa fa-exclamation red"></i>';
                        }else{
                            tr +=    '<i class="fa fa-check-circle-o green"></i>';
                        }
                        tr +=    '<br><b>' + item.proveedor.razon_social +'</b></td>';
                        tr += '<td>' + item.concepto +'</td>';
                    }

                    tr += '<td style="text-align: right">' + Number(item.monto).toFixed(2) +'</td>';
                    tr += '</tr>';
                    $('#tb-lista').append(tr);
                });
                $("#divSubTotal").html(resp.gastos);
                $("#divRecibido").html(resp.total);
                $("#divDevuelto").html(resp.devolucion);
                $("#divReembolsar").html(resp.reembolso);
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
                    }
                })
            ;


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

                    desbloqueo("#tb-cca");
                }
            })
        ;


    }
    function actualizarF(){

        var data = {};
        data["id"]=$("#c_id").val();
        data["_token"]="{{ csrf_token() }}";
        data["_method"]="PUT";
        data["fecha"]=$("#c_fecha").val();
        data["fecha_contable"]=$("#c_fecha_contable").val();
        data["proveedor"]=$("#c_proveedor").val();
        data["tipo"]=$("#c_tipo").val();
        data["serie"]=$("#c_serie").val();
        data["concepto"]=$("#c_concepto").val();
        data["servicio_id"]=$("#c_servicio_id").val();
        data["impuesto"]=$("#c_impuesto").val();
        data["total"]=$("#c_total").val();
        data["empleado"]=$("#c_empleado").val();
        data["ruc"]=$("#c_ruc").val();
        data["proveedor"]=$("#c_proveedor").val();


        if( $('#sap').prop('checked') ) {
            data["sap"]=1;
        }else{
            data["sap"]=0;
        }



        var str = "{{route("caja.update","xxx")}}";
        var url = str.replace("xxx", $("#c_id").val());

        $.post(url,data,function(resp){

            $("#tb-cca tbody").empty();
            if(resp.error)
            {

                if(resp.msg!="0") {

                    toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                }
            }
            else
            {

                cargar({{$rq->id}});

                $('#modalCC').modal('toggle');


            }

        }).fail(function(){

            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

        });



    }
    function cargarCC(id){

        var data = {};
        data["id"]=id;
        data["_token"]="{{ csrf_token() }}";

        var url = "{{route("caja.rendir_listado_cc")}}";
        $.post(url,data,function(resp){

            $("#tb-cca tbody").empty();
            if(resp.error)
            {

                if(resp.msg!="0") {

                    toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                }
            }
            else
            {
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
                    tr += '<td> <input type="text" value="' + item.porcentaje +'" class="form-control input-xsmall  input-sm " name="P' + item.id+ '" id="P' + item.id+ '"> </td>';
                    tr += '<td><a href="javascript:actualizarCC(' + item.id + ');" class="btn btn-xs default btnActualizar"><i class="fa fa-save"></i></a><a href="javascript:eliminarCC(' + item.id + ');" class="btn btn-xs default btnActualizar"><i class="fa fa-trash-o"></i></a></td>';
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
                tr += '<tr>';

                tr += '<td colspan="8"> <button class="btn btn-small blue btn-block btnActualizar" onclick="javascript:aplicarTodos()" >Aplicar CC a todos las documentos.</button> </td>';
                tr += '</tr>';


                $('#tb-cca').append(tr);

            }

        }).fail(function(){

            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

        });

        var urlD = "{{route("caja.conta")}}";
        $.post(urlD,data,function(resp){

             if(resp.error)
            {
                if(resp.msg!="0") {
                    toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                }
            }
            else
            {
                $("#c_id").val(resp.data.id);

                $("#c_fecha").val(resp.data.fecha);
                $("#c_fecha_contable").val(resp.data.fecha_contable);
                $("#c_proveedor").val(resp.data.proveedor);
                $("#c_serie").val(resp.data.serie);
                $("#c_concepto").val(resp.data.concepto);
                $("#c_tipo").val(resp.data.tipo);
                $("#c_ruc").val(resp.data.ruc);

                if(resp.data.tipo=="MV") {


                    $("#frmMovilidad").removeClass("hidden")

                    $(".mov").addClass("hidden")

                }else{
                    $("#frmMovilidad").addClass("hidden")

                    $(".mov").removeClass("hidden")

                }


                $("#c_servicio_id").val(resp.data.servicio_id);
                $("#c_impuesto").val(resp.data.impuesto);
                $("#c_total").val(resp.data.monto);


                if((resp.data.sap==1)||(resp.data.sap==2)) {
                    $("#sap").prop("checked", true);

                    $(".btnActualizar").addClass("hidden");

                }else{
                    $( "#sap" ).prop( "checked", false )
                    $(".btnActualizar").removeClass("hidden");


                }

                if(resp.data.sap==2) {


                }else{

                }



                }

        }).fail(function(){

            toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

        });
        cargarMovilidad(id);

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
        $("#movilidad").val(id);

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


    $('#c_empleado').select2({
        minimumInputLength: 3,
        ajax: {
            method:'POST',
            dataType: 'json',
            url: '{{route("api.empleado")}}',
            processResults: function (data) {
                return {
                    results: $.map(data, function(obj) {


                        return { id: obj.CardCode, text:"[" + obj.CardCode + "] [" +  obj.LicTradNum + "] " + obj.CardName };
                    })
                };
            }
        }
    });


</script>