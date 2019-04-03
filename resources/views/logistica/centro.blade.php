@extends('layout.app4')

@section('cabecera')


@endsection


@section('main-content')
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-grey-gallery"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> Centro de Costos </span>
                        <span class="caption-helper"> </span>
                    </div>

                </div>
                <div class="portlet-body">
                    <h5>Aplicados para el usuario {{$usuario->name  }}</h5>
                    <div class="row">
                        <div class="col-md-12 ">
                            <table class="table table-hover table-light"   >
                                <thead>
                                <tr class="uppercase">
                                    <th >  </th>
                                    <th > Codigo </th>

                                    <th  > Linea de Negocio </th>
                                    <th > Codigo </th>

                                    <th > Sede</th>
                                    <th > Modalidad</th>
                                    <th > Codigo </th>

                                    <th  > Especialidad</th>
                                    <th > Codigo </th>

                                    <th  > Admision </th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($centro as $item1)
                                    <tr style="font-size: 12px">
                                        <td> <a href="javascript:deleteX({{$item1["id"]}});" class="btn btn-xs red"> Eliminar
                                                <i class="fa fa-trash"></i>
                                            </a></td>
                                        <td style="font-size: 12px"> {{$item1["LineaCode"]}} </td>
                                        <td style="font-size: 12px"> {{$item1["Linea"]}}  </td>
                                        <td style="font-size: 12px"> {{$item1["SedeCode"]}} </td>
                                        <td style="font-size: 12px"> {{$item1["Sede"]}}  </td>
                                        <td style="font-size: 12px"> {{$item1["ModalidadCode"]}} </td>

                                        <td style="font-size: 12px"> {{$item1["EspecialidadCode"]}} </td>
                                        <td style="font-size: 12px"> {{$item1["Especialidad"]}}  </td>

                                        <td style="font-size: 12px"> {{$item1["AdmisionCode"]}} </td>
                                        <td style="font-size: 12px"> {{$item1["Admision"]}}  </td>

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
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-puzzle font-grey-gallery"></i>
                                <span class="caption-subject bold font-grey-gallery uppercase"> Centro de Costos Validos </span>
                                <span class="caption-helper"> </span>
                            </div>

                        </div>
                        <div class="portlet-body">

                <div class="row">


                    <div class="col-md-12 ">
                        <table class="table table-hover table-light" id="tb-centro" >
                            <thead>
                            <tr class="uppercase">
                                <th >  </th>
                                <th > Codigo </th>

                                <th  > Linea de Negocio </th>
                                <th > Codigo </th>

                                <th > Sede</th>
                                <th > Modalidad</th>
                                <th > Codigo </th>

                                <th  > Especialidad</th>
                                <th > Codigo </th>

                                <th  > Admision </th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($linea as $item1)
                            <tr style="font-size: 12px">
                                <td> <a href="javascript:add('{{$item1["Code"]}}',{{$id}});" class="btn btn-xs green"> Añadir
                                        <i class="fa fa-plus"></i>
                                    </a></td>
                                <td style="font-size: 12px"> {{$item1["LineaCode"]}} </td>
                                <td style="font-size: 12px"> {{$item1["Linea"]}}  </td>
                                <td style="font-size: 12px"> {{$item1["SedeCode"]}} </td>
                                <td style="font-size: 12px"> {{$item1["Sede"]}}  </td>
                                <td style="font-size: 12px"> {{$item1["ModalidadCode"]}} </td>

                                <td style="font-size: 12px"> {{$item1["EspecialidadCode"]}} </td>
                                <td style="font-size: 12px"> {{$item1["Especialidad"]}}  </td>

                                <td style="font-size: 12px"> {{$item1["AdmisionCode"]}} </td>
                                <td style="font-size: 12px"> {{$item1["Admision"]}}  </td>

                            </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
                </div>
            </div>
            <!-- END GRID PORTLET-->
        </div>
    </div>







@endsection
@section ('script')
    <script language="javascript">


        function add(id,user){
            var url="{{route("requerimiento.add_centro")}}";
            var data = {};
            data["id"]=id;
            data["user"]=user;
            $.post(url, data, "json")
                .done(function( result ) {
                    if(result.error){
                        toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                    }else{
                        location.reload();

                    }
                });
        }




        function deleteX(id){
            var url="{{route("requerimiento.delete_centro")}}";
            var data = {};
            data["id"]=id;
             $.post(url, data, "json")
                .done(function( result ) {
                    if(result.error){
                        toastr["error"]("Ha ocurrido un error, revise su conexion e intentelo nuevamente", "SAP Online")
                    }else{
                        location.reload();

                    }
                });
        }







        $('#tb-centro').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
@endsection