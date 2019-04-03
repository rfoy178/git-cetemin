@extends('layout.app4')

@section('cabecera')


<style>
    .loading2 {
        background-color: #ffffff;
        background-image: url("{{asset("load.gif")}}");
        background-size: 15px 15px;
        background-position:right center;
        background-repeat: no-repeat;
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



</style>
@endsection


@section('main-content')

    <div class="row">

    <div class="col-md-12 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-puzzle font-grey-gallery"></i>
                    <span class="caption-subject bold font-grey-gallery uppercase"> Solicitud de dinero a rendir </span>
                    <span class="caption-helper"> </span>
                </div>
                <div class="tools">

                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                 </div>
            </div>
            <div class="portlet-body"  style="  font-size: 12px">
                <div class="row">

                    <div class="mt-element-step">
                        <div class="row step-no-background-thin">
                            <div class="col-lg-3 mt-step-col   active ">
                                <div class="mt-step-number first bg-white font-grey">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Solicitud</div>
                                <div class="mt-step-content font-grey-cascade">Solicitud de dinero a rendir</div>

                            </div>
                            <div class="col-lg-3 mt-step-col   ">
                                <div class="mt-step-number bg-white font-grey">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Tesoreria</div>
                                <div class="mt-step-content font-grey-cascade">Esperando deposito</div>

                            </div>

                            <div class="col-lg-3 mt-step-col  ">
                                <div class="mt-step-number bg-white font-grey">3</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Rendir</div>
                                <div class="mt-step-content font-grey-cascade">Sustentar el gasto</div>
                            </div>

                            <div class="col-lg-3 mt-step-col   ">
                                <div class="mt-step-number bg-white font-grey">4</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Contabilidad</div>
                                <div class="mt-step-content font-grey-cascade">Validación contable</div>
                            </div>

                        </div>
                    </div>
                </div>

                <br>
                @can(['crear.dinero'])
                    <div class="row">

                        <div class="col-md-12 ">
                    <form role="form"  action="{{route('caja.store') }}"  method="post" id="frm"   >
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <input type="hidden" id="id_temp" name="id_temp" value="{{$id}}">

                        <div class="form-body">
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">AREA</label>
                                <div class="col-md-9">
                                    <select class="form-control input-sm" id="cboArea" name="cboArea" required>
                                        @foreach($area as $item)
                                            <option value="{{$item->id}}">{{$item->abreviatura}} {{$item->area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <input type="hidden"  required id="centro" name="centro">

                                <div class="form-group  col-md-6">
                                <label class="col-md-3 control-label">Fecha Necesaria</label>
                                <div class="col-md-9">


                                    <div class="input-group input-medium date date-picker"   data-date-format="dd-mm-yyyy" data-date-start-date="+1d"  >
                                        <input type="text" class="form-control input-sm" readonly="" value="{{$endDate}}"  required id="fecharq" name="fecharq">
                                        <span class="input-group-btn" >
                                                            <button class="btn default btn-sm " type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">

                                <div class="form-group  col-md-6">
                                    <label class="col-md-3 control-label">Tipo</label>
                                    <div class="col-md-9">
                                        <select class="form-control input-sm" id="tiporq" name="tiporq"  required>

                                            <option value="VIA" selected>Dinero a rendir</option>
                                         <!--  <option value="CAJ">Caja Chica Lima</option>  <option value="SUM">Compra de suministros</option>
-->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label class="col-md-3 control-label">Prioridad</label>
                                    <div class="col-md-9">
                                        <select class="form-control input-sm"  id="prioridad" name="prioridad"  required >
                                            <option value="1">Normal</option>
                                            <option value="2" selected>Baja</option>
                                            <option value="3">Alta</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div id="rowViatico" class="row  ">

                                                 <input type="hidden" class="form-control input-sm viatico"  value="-"    id="destino" name="destino">


                                <div class="form-group  col-md-6">
                                    <label class="col-md-3 control-label">Plazo de ejecucion del gasto</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control input-sm viatico popovers" value="1"  min="1"    id="estadia" name="estadia"   data-trigger="hover"  data-container="body" data-content="Determina los días en que gastara el dinero solicitado, despues de ese plazo se notificara que debe rendir el gasto" data-original-title="Ayuda">
                                        <span class="help-block">días. </span>
                                    </div>



                                </div>
                            </div>

                            </div>








                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label class="col-md-12 control-label">Descripción del Motivo</label>
                                    <div class="col-md-12">
                                        <textarea id="descripcion" name="descripcion" class="form-control input-sm" rows="3"  required></textarea>
                                    </div>
                                </div>
                            </div>




                        <div class="row">

                            <div class="form-group  col-md-6">
                                <label class="col-md-3 control-label">Monto S/</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm viatico"   required id="monto" name="monto">

                                </div>
                            </div>
                            <div class="form-group  col-md-6">
                                <a href="javascript:popup();" class="btn btn-sm red btn-block cccc">
                                    <i class="fa fa-cc"></i> Centro de costos </a>
                            </div>
                        </div>










                        <!--

                        <div  class="row">
                            <div class="form-group  col-md-12">
                                <label class="col-md-2 control-label">Centro de costos</label>
                                <div class="col-md-8">
                                    <a href="javascript:popup();" ><i class="fa font-red fa-cc"></i> </a>
                                </div>
                                <div class="col-md-2">

                                </div>
                            </div>
                        </div>

           -->



                        <br>
                        <br>
                            <div class="row">
                            <label class="col-md-12"><b>Datos del beneficiario</b></label>

                            <div class="form-group  col-md-12">
                                <label class="col-md-2 control-label">DNI</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-sm"   required id="dni" name="dni">
                                </div>
                            </div>

                            <div class="form-group  col-md-12">
                                <label class="col-md-2 control-label">Apellidos y Nombres</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control input-sm"   required id="nombre" name="nombre">
                                </div>
                            </div>
                            <div class="form-group  col-md-12">
                                <label class="col-md-2 control-label">Cargo</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control input-sm"   required id="cargo" name="cargo">
                                </div>
                            </div>


                                <div class="form-group  col-md-12">
                                    <label class="col-md-2 control-label">Email</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control input-sm"   required id="b_email" name="b_email">
                                    </div>
                                </div>


                            <div class="form-group  col-md-12">
                                <label class="col-md-2 control-label">Banco</label>
                                <div class="col-md-2">
                                        <select id="t_banco" class="form-control input-sm"  name="t_banco">
                                            <option value="A">BCP</option>
                                            <option value="B">Interbancaria</option>
                                            <option value="EFE">Efectivo</option>

                                        </select>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control input-sm"   required id="cta" name="cta">
                                </div>


                            </div>
                                <div class="form-actions   col-md-12">
                                    <button type="button" class="btn default">Cancelar</button>
                                    <button type="submit" class="btn green">Enviar</button>
                                </div>
                         </div>


                    </form>


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
    <div class="modal fade" id="modalCC"   role="dialog"  >
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

    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Centro de Costos</h4>
                </div>
                <div class="modal-body">



                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-hover" id="tbCC">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Linea</th>

                                    <th> Sede </th>
                                    <th> Tipo </th>
                                    <th>  Especialidad </th>
                                    <th> Admision </th>

                                 </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;?>
                                @foreach($cc as $item)
                                <?php $i++; ?>
                                    <tr data-id="{{$item->id}}">
                                    <td> {{$i}}</td>
                                    <td> {{$item->Linea}} </td>
                                    <td> {{$item->Sede}} </td>
                                    <td> {{$item->ModalidadCode}} </td>

                                    <td> {{$item->Especialidad}}</td>
                                    <td> {{$item->Admision}}
                                     </td>

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section ('script')



    <script src="{{asset("assets/global/plugins/inputmask/dist/jquery.inputmask.bundle.js?V=12")}}" type="text/javascript"></script>



    <script language="javascript">


        $("#monto").inputmask("currency");  //static mask





       $( "#dni" ).keyup(function( event ) {

           var dni=$("#dni").val();

           x=dni.length

           if(x==8){

               $("#dni").addClass("loading2");

               $("#cargo").val("");
               $("#b_email").val("");
               $("#nombre").val("");
               $("#cta").val("");
               $("#t_banco").val("");

               var url;

               url="{{route("api.dni","xxx")}}";
               url=url.replace("xxx",$("#dni").val());

               $.post(url, "json")
                   .done(function( result ) {
                       if(result.Tipo==0){


                           $("#cargo").val(result.cargo);
                           $("#b_email").val(result.email);
                           $("#nombre").val(result.nombre);
                           $("#cta").val(result.cta);
                           $("#t_banco").val(result.banco);


                         }

                       if(result.Tipo==1){


                            $("#nombre").val(result.nombre);


                       }

                       $("#dni").removeClass("loading2");

                   })
               ;
           }
       }).keydown(function( event ) {
           if ( event.which == 13 ) {
               event.preventDefault();
           }
       });


       function addCC(id) {
           var data = {};
           data["id"]=id;

           data["_token"]="{{ csrf_token() }}";
           data["cc_id"]=id;
           data["rendir_id"]="{{$id}}";


           var url="{{route("caja.caja_fila_cc")}}";
           bloqueo("#tb-cca");
           $.post(url, data, "json")
               .done(function( result ) {
                   if(result.error){
                       toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                   }else{
                       cargarCC("{{$id}}");
                       desbloqueo("#tb-cca");
                   }
               })
           ;


       }
       function popup(){
           $("#modalCC").modal();
            cargarCC("{{$id}}")
       }
       function actualizarCC(id) {
           var data = {};
           data["id"]=id;

           data["_token"]="{{ csrf_token() }}";
           data["porcentaje"]=$("#P"+id).val();


           var url="{{route("caja.caja_update_cc")}}";
           bloqueo("#tb-cca");

           $.post(url, data, "json")
               .done(function( result ) {
                   if(result.error){
                       toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                   }else{
                       cargarCC("{{$id}}");

                       desbloqueo("#tb-cca");
                   }
               })
           ;


       }
       function eliminarCC(id) {
           var data = {};
           data["id"]=id;

           data["_token"]="{{ csrf_token() }}";


           var url="{{route("caja.caja_eliminar_cc")}}";
           bloqueo("#tb-cca");

           $.post(url, data, "json")
               .done(function( result ) {
                   if(result.error){
                       toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")

                   }else{
                       cargarCC("{{$id}}");

                       desbloqueo("#tb-cca");
                   }
               })
           ;


       }
       function cargarCC(id){

           var data = {};
           data["id"]=id;
           data["_token"]="{{ csrf_token() }}";

           var url = "{{route("caja.caja_listado_cc")}}";
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


                       $(".cccc").removeClass("blue");
                       $(".cccc").removeClass("red");

                       $(".cccc").addClass("red");

                   }else{
                       tr += ' class="success" ';
                       $(".cccc").removeClass("blue");
                       $(".cccc").removeClass("red");
                       $(".cccc").addClass("blue");


                   }

                   tr += '><td colspan="6">TOTAL PORCENTAJE</td>';
                   tr += '<td >' + resp.total +'</td>';
                   tr += '<td>  </td>';
                   tr += '</tr>';


                   $('#tb-cca').append(tr);

               }
           }).fail(function(){

               toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Onlie")

           });

       }

    </script>|
@endsection