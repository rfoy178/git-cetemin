@extends('layout.app4')
@section('cabecera')
@endsection
@section('main-content')


    <div class="portlet light ">

        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-red"></i>
                <span class="caption-subject font-red sbold uppercase">Personal de Planilla del Centro Tecnologico Minero</span>
            </div>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn red btn-lg dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true" aria-expanded="false">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"> Gestión </font>
                        </font><i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="javascript:void(0);" onclick="cargar_formulario(8);">
                                <i class="icon-user"></i> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Nuevo Colaborador  </font></font> </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-calendar"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">  Cumpleaños </font></font></a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-note"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">  Contratos</font></font></a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#">
                                <i class="icon-bag"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Enlace separado</font></font></a>
                        </li>
                    </ul>
                </div>
            </div>

    </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th> DNI </th>
                        <!--<th> 2 Nombre </th> -->
                        <th> Apellido Paterno </th>
                        <th> Apellido Materno </th>
                        <th> Nombres </th>
                        <th> Fecha de Nacimiento </th>
                        <th> Gerencia </th>
                        <th> Sede </th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($personal as $item)

                    <tr>
                        <td> {{$item->dni}} </td>
                        <td> {{$item->apellido_paterno}}</td>
                        <td> {{$item->apellido_materno}}</td>
                        <td> {{$item->nombre}} {{$item->segundo_nombre}} </td>
                        <td> {{$item->fecha_nacimiento}}</td>
                        <td> {{$item->sede}}</td>
                        <td> {{$item->gerencia}}</td>


                        <td>
                            <span class="label label-sm label-success"> Sin Contrato </span>
                        </td>

                        <td style="font-size: smaller">


                            <a href="http://localhost/cobranzas/public/logistica/editar_estado/1391/0">
                                <i class="fa fa-edit"></i></a>

                            <a href="javascript:" data-id="1391" class="       btnConfirmar " data-placement="left" data-toggle="confirmation" data-btn-ok-label="Continuar" data-btn-ok-class="btn-success" data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check" data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger" data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?" data-original-title="" title="">
                                <i class="fa fa-trash-o"></i></a>




                        </td>


                    </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    {{$personal->links()}}

@endsection
@section ('script')

@endsection