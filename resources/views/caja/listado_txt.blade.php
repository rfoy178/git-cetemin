@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />
    <link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput-master/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/plugins/piexif.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/plugins/purify.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/fileinput.min.js')}}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/themes/fa/theme.js')}}"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput-master/js/locales/es.js')}}"></script>



    <meta name="viewport" content="width=device-width, initial-scale=0.75">

<style>

    @media screen and (max-width: 320px) {

    }
</style>
@endsection


@section('main-content')



    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <form id="frm" name="frm" method="post" action="{{route("caja.generar_txt")}}">
                {{ csrf_field() }}
                <input type="hidden" id="cuenta" name="cuenta" value="{{$cuenta->cuenta}}">

                <input type="hidden" id="id" name="id" value="{{$cuenta->id}}">   <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject   sbold uppercase">{{$cuenta->nombre}}</span>
                    </div>



                    <div class="actions hidden-print">
                        <a href="javascript:;"  onclick="javascript:window.print();" class="btn btn-circle btn-default btn-sm">
                            <i class="fa fa-print"></i> Imprimir </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""></a>
                    </div>







                </div>
                <div class="portlet-body">
                    <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <td> # </td>
                                <th> Fecha Aprobación </th>
                                <th> Codigo </th>
                                <th> Area </th>
                                <th> Beneficiario </th>
                                <th> Asunto </th>
                                <th> Fecha Necesaria </th>
                                <th> Solicitante </th>

                                <th> Monto S/ </th>
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
                                    <td> {{$i}}</td>
                                    <td style="font-size: smaller"> {{$item->rq->fecha_aprobacion}} </td>
                                    <td>
                                        <a href="{{route("caja.show",$item->rq->id)}}" class="hidden-print">
                                            <span class="label label-sm label-success"> {{$item->rq->area->abreviatura}}-{{str_pad($item->rq->id, 5, "0", STR_PAD_LEFT)}} </span></a>
<span class="visible-print">{{$item->rq->area->abreviatura}}-{{str_pad($item->rq->id, 5, "0", STR_PAD_LEFT)}}</span>


                                    </td>
                                    <td style="font-size: smaller">
                                        <strong>
                                            @if($item->rq->usuario->sede_id==1)
                                                LIM
                                            @else
                                                AQP
                                            @endif</strong> <br>
                                        {{$item->rq->area->area}} </td>

                                    <td style="font-size: smaller"> <strong>{{$item->rq->dni}}</strong><br>{{$item->rq->nombre}}  </td>



                                    <td  style="font-size: smaller"> {{$item->rq->descripcion}} </td>
                                    <td style="font-size: smaller"> {{$item->rq->fecha_necesaria}} </td>
                                    <td style="font-size: smaller"> {{$item->rq->usuario->name}}   </td>



                                    <td style="text-align: right;font-size: smaller">
                                        {{number_format($item->rq->monto,2,".",",")}}
                                    </td>

                                    <td>

                                        <a href="javascript:;" data-id="{{$item->id}}" class="  hidden-print     btnConfirmar "  data-placement="left"  data-toggle="confirmation"  data-btn-ok-label="Continuar" data-btn-ok-class="btn-success"
                                           data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                                           data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger"
                                           data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?">
                                            <i class="fa fa-remove "></i></a>

                                    </td>
                                </tr>
                                <?php $i++;
                                $suma=$suma+ $item->rq->monto;
                                ?>
                            @endforeach
                            <input type="hidden" id="cantidad" name="cantidad" value="{{$i}}">

                            <input type="hidden" id="suma" name="suma" value="{{$suma}}">


                            @else
                                <td colspan="7"><div class="note note-danger">
                                        <h4 class="block">Alerta! </h4>
                                        <p>  Ud. no tiene permiso para ver esto  </p>
                                    </div></td>
                                @endcanatleast

                            </tbody>
                        </table>
                    <div class="row hidden-print">

                    <div class="form-group">
                        <div class="col-md-2">
Nombre de archivo                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm  "     id="descripcion" name="descripcion">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn blue btn-sm  btn-block">Generar TXT</button>
                        </div>


                    </div>
                    </div>

                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

    </form>


            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject   sbold  ">Archivos TXT</span>
                    </div>

                    <div class="actions hidden-print">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""></a>
                    </div>

                </div>
                <div class="portlet-body">


                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <td> # </td>
                            <th> Fecha Descarga </th>
                            <th> Nombre </th>
                            <th> Creado por </th>
                            <th> Fecha Deposito  </th>

                            <th>   </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php  $ii=1;
                        $suma=0;
                        ?>
                        @foreach($texto as $item2)
                            <tr>
                                <td style="font-size: smaller"> {{$ii}} </td>
                                <td style="font-size: smaller"> {{$item2->created_at}} </td>
                                <td style="font-size: smaller"> {{$item2->nombre}} </td>

                                <td style="font-size: smaller"|> {{$item2->usuario->name}} </td>
                                <td style="font-size: smaller"> {{$item2->fecha}} </td>

                                <td style="font-size: smaller">
                                    @if($item2->estado==1)
                                        <div class="input-group">
                                            <div class="">
                                                <input   class="form-control input-sm" type="text" name="txtOpe{{$item2->id}}" id="txtOpe{{$item2->id}}" placeholder="Operación"> </div>
                                            <span class="input-group-btn">
                                                            <button id="genpassword" class="btn btn-success btn-sm" type="button" onclick="ope({{$item2->id}})">
                                                                <i class="fa fa-save"></i> Guardar</button>
                                                        </span>
                                        </div>
                                    @endif
                                        @if($item2->estado==2)
                                            {{$item2->ope}}
                                        @endif

                                </td>
                                <td>

                                  <a href="{{route("caja.edit_txt",$item2->id)}}" target="_blank" data-id="72" class="       btnConfirmar " ><i class="fa fa-external-link"></i></a>


                                    @if($item2->estado==1)
                                        <a href=""  class="" title=""><i class="fa fa-download"></i></a>

                                    @endif

                                    @if($item2->estado==0)
                                        <a href="javascript:popup({{$item2->id}})"  class="" title=""><i class="fa fa-upload"></i></a>



                                    <a href="javascript:;" data-id="72" class="       btnConfirmar " data-placement="left" data-toggle="confirmation" data-btn-ok-label="Continuar" data-btn-ok-class="btn-success" data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check" data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger" data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?" data-original-title="" title=""><i class="fa fa-remove"></i></a>

                                    @endif




                                </td>
                             </tr>
<?php
                            $ii++;
                            ?>
                        @endforeach




                        </tbody>
                    </table>

                </div>
            </div>





        </div>
    </div>
    <div class="modal fade" id="modalAdjuntar"   role="dialog"  >
        <div class="modal-dialog" role="document">
            <div class="modal-content"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Asignar CC</h4>
                </div>

                <div class="modal-body"  >
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fecha Deposito</label>
                            <div class="col-md-9">
                                <div class="input-group input-medium date date-picker" data-date-date="0d"   data-date-format="dd-mm-yyyy" data-date-end-date="0d">


                                    <input type="text" class="form-control" readonly="" value="{{date("d-m-Y")}}"   required id="fecharq" name="fecharq">
                                    <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                </div>
                            </div>




                        </div>

                    </div>

                    <div class="row">
                        <div   id="divFile" class="col-sm-12">
                            <input id="idV" name="idV" type="hidden" >

                            <input id="file-es" name="file-es[]" type="file" multiple>
                            <script>
                                $('#file-es').fileinput({
                                    language: 'es',
                                    theme: 'explorer-fa',
                                    uploadUrl: '{{route("caja.upload")}}',
                                        uploadExtraData: function(previewId, index){

                                            var tempData = {};

                                                tempData["id"] = $("#idV").val();
                                            tempData["fecha"] = $("#fecharq").val();
                                            tempData["_token"] = "{{ csrf_token() }}";

                                             return tempData;
                                        },
                                    allowedFileExtensions: [ 'xlsx', 'xls']
                                });
                            </script>

                        </div>

                    </div>


                </div>


            </div>
        </div>
    </div>
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

        function popup(id){

            $("#idV").val(id);
            $("#modalAdjuntar").modal();
        }

        function ope(id){
            var data={};
                data["ope"]=$("#txtOpe"+id).val();
            var del="{{route("caja.ope","xxx")}}";
            var url=del.replace("xxx",id);

                $.ajax({
                url: url,
                    data: data,
                    type: 'post',  // user.destroys
                success: function(result) {
                    if(result["error"] ){
                        swal("Ups!", result["msg"], "warning");

                    }else{
                        location.reload();
                    }
                }
            })

        }

    </script>
@endsection