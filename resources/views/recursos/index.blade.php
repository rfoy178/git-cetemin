@extends('layout.app4')
@section('cabecera')
 @endsection
@section('main-content')


    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-red"></i>
                <span class="caption-subject font-red sbold uppercase">Light Table 1</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                        <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                    <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                        <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> First Name </th>
                        <th> Last Name </th>
                        <th> Username </th>
                        <th> Status </th>
                        <th>  </th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($personal as $item)

                    <tr>
                        <td> 1 </td>
                        <td> {{$item->nombre}} </td>
                        <td> Otto </td>
                        <td> makr124 </td>
                        <td>
                            <span class="label label-sm label-success"> Approved </span>
                        </td>

                        <td style="font-size: smaller">


                            <a href="http://localhost/cobranzas/public/logistica/editar_estado/1391/0">
                                <i class="fa fa-edit"></i></a>

                            <a href="javascript:;" data-id="1391" class="       btnConfirmar " data-placement="left" data-toggle="confirmation" data-btn-ok-label="Continuar" data-btn-ok-class="btn-success" data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check" data-btn-cancel-label="No!" data-btn-cancel-class="btn-danger" data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close" data-title="¿Estas seguro?" data-original-title="" title="">
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