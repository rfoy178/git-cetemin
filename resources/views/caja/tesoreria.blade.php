@extends('layout.app4')

@section('cabecera')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link href="{{ asset('/js/auto/easy-autocomplete.min.css') }}" rel="stylesheet" />
    <link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />

    <link href="{{asset("assets/global/plugins/datatables/datatables.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")}}" rel="stylesheet" type="text/css" />

@endsection


@section('main-content')
    <form id="frm" name="frm" method="post" action="{{route("caja.banco")}}">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Solicitudes de dinero a rendir</span>
                    </div>

                    <div class="actions">
                        <a href="" class=" expand " data-original-title="" title=""> </a>
                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                     </div>

                </div>
                <div class="portlet-body">



    <table class="table table-hover table-light"  id="tbl-tesoreria">
                            <thead>
                            <tr>
                                <td> <input type="checkbox" id="select_all"> </td>
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

                            @foreach($rq as $item)
                                <tr>
                                    <td> <input type="checkbox" name="caja[]" value="{{$item->id}}"> </td>
                                    <td style="font-size: smaller"> {{$item->fecha_aprobacion}} </td>
                                    <td>
                                        <a href="{{route("caja.show",$item->id)}}">
                                        <span class="label label-sm label-success"> {{$item->area->abreviatura}}-{{str_pad($item->id, 5, "0", STR_PAD_LEFT)}} </span></a>



                                    </td>
                                    <td style="font-size: smaller">
                                        <strong>
                                        @if($item->usuario->sede_id==1)
                                           LIM
                                            @else
                                            AQP
                                            @endif</strong> <br>
                                            {{$item->area->area}} </td>

                                    <td style="font-size: smaller"> <strong>{{$item->dni}}</strong><br>{{$item->nombre}}  </td>



                                    <td  style="font-size: smaller"> {{$item->descripcion}} </td>
                                    <td style="font-size: smaller"> {{$item->fecha_necesaria}} </td>
                                    <td style="font-size: smaller"> {{$item->usuario->name}}   </td>



                                    <td style="text-align: right;font-size: smaller">
                                        {{number_format($item->monto,2,".",",")}}
                                    </td>

                                    <td>
                                        @if($item->user_id==\Auth::user()->id)
                                            <a href="{{route("caja.editar_estado",['id' =>$item->id ,'valor' => 0])}}" >
                                                <i class="fa fa-edit"></i></a>
                                        @endif
                                        @if($item->usuario->jefe==\Auth::user()->id)
                                            @if($item->estado==1)
                                                <a href="#" onclick="estado('{{route('caja.editar_estado',['id'=>$item->id ,'estado'=>8])}}')" class="btn btn-xs   green">
                                                    <i class="glyphicon glyphicon-ok"> </i>
                                                </a>
                                                <a href="#" onclick="estado('{{route('caja.editar_estado',['id'=>$item->id ,'estado'=>7])}}')" class="btn btn-xs   red">
                                                    <i class="glyphicon glyphicon-remove"> </i>
                                                </a>
                                            @endif
                                        @endif
                                        @if($item->usuario->area==13)
                                            @if($item->estado==1)
                                                <a href="#" onclick="estado('{{route('caja.editar_estado',['id'=>$item->id ,'estado'=>8])}}')" class="btn btn-xs   green">
                                                    <i class="glyphicon glyphicon-ok"> </i>
                                                </a>
                                                <a href="#" onclick="estado('{{route('caja.editar_estado',['id'=>$item->id ,'estado'=>7])}}')" class="btn btn-xs   red">
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
                             @endforeach



                            @else
                                <td colspan="7"><div class="note note-danger">
                                        <h4 class="block">Alerta! </h4>
                                        <p>  Ud. no tiene permiso para ver esto  </p>
                                    </div></td>
                                @endcanatleast

                            </tbody>
                        </table>





                    </div>

                    <div class="row">

                    <div class="form-group">
                        <div class="col-md-8">
                            <select class="form-control input-sm  " id="cuenta" name="cuenta">
                                @foreach($cuentas as $cuenta)
                                    <option value="{{$cuenta->id}}">{{$cuenta->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn blue btn-sm  btn-block">Agregar</button>
                        </div>

                        <div class="col-md-2">
                            <button type="button" id="btnVer" class="btn  btn-sm  btn-block">Ver TXT</button>
                        </div>
                    </div>
                    </div>




                </div>
             <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
    </form>
<form id="frmTxt" name="frmTxt" action="{{route("caja.listado_txt","id")}}" method="get">



</form>
@endsection
@section ('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>


    <script src="{{asset("assets/global/scripts/datatable.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/global/plugins/datatables/datatables.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")}}" type="text/javascript"></script>




    <script language="javascript">
        $('#btnVer').click(function() {





            var txt=$("#frmTxt").attr('action');

            txt=txt.replace("id",$("#cuenta").val());




            $("#frmTxt").attr('action', txt);
            $("#frmTxt").submit();
        });

            var e = $("#tbl-tesoreria");
            e.dataTable({
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                bStateSave: !0,
                lengthMenu: [
                    [20, 30, 100, -1],
                    [20, 30, 100, "Todos"]
                ],
                pageLength: 30,
                pagingType: "bootstrap_full_number",
                columnDefs: [{
                    orderable: !1,
                    targets: [0,9]
                }, {
                    searchable: !1,
                    targets: [0,9]
                }, {
                    className: "dt-right"
                }],
                order: [
                    [1, "asc"]
                ]
            });



        $('#select_all').change(function() {
            var checkboxes = $(this).closest('form').find(':checkbox');
            checkboxes.prop('checked', $(this).is(':checked'));
        });

    </script>
@endsection