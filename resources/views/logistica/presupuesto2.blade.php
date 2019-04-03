<style>

    #tb-presupuesto tr{
        font-size: 11px;
    }

    #tb-presupuesto th{
        font-size: 11px;
    }
    #tb-presupuesto td{
        font-size: 11px;
    }
</style>
<h4>Validación de presupuesto</h4>

<table id="tb-presupuesto" class="table table-hover table-bordered table-striped  flip-content  ">
    <thead>
        <tr>
            <th> # </th>
            <th> Linea</th>
            <th> Sede </th>
            <th > Tipo </th>

            <th > Especialidad </th>

            <th> Admisión</th>

            @if($rq->usuario->jefe==\Auth::user()->id)

            <th> Presupuestado</th>
            <th> Ejecutado</th>
            <th> Saldo </th>
            <th> Solicitado </th>
            @endif


            <th>  </th>

        </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
    ?>
    @foreach($presupuesto as $item)
    <?php
    $i++;
    ?>
        <tr  @if($item->monto>=($item->U_EXC_MONTO - $item->EXC_REAL_F))  class="danger " @endif>
            <td>{{$i}}  </td>
            <td>{{$item->OcrCode1}}   </td>
            <td>{{$item->OcrCode2}}  </td>
            <td>{{$item->OcrCode3}}   </td>
            <td>{{$item->OcrCode4}}   </td>
            <td>{{$item->OcrCode5}}   </td>

            @if($rq->usuario->jefe==\Auth::user()->id)


            <td style="text-align: right"> {{"S/ ".number_format($item->U_EXC_MONTO, 2, '.', ',')}} </td>
            <td style="text-align: right"> {{"S/ ".number_format($item->EXC_REAL_F, 2, '.', ',')}}    </td>
            <td style="text-align: right"> {{"S/ ".number_format(($item->U_EXC_MONTO - $item->EXC_REAL_F), 2, '.', ',')}}    </td>
            <td style="text-align: right">{{"S/ ".number_format($item->monto, 2, '.', ',')}} </td>

@endif

            <td>
            @if($item->monto<($item->U_EXC_MONTO - $item->EXC_REAL_F))
                <i class="fa fa-check-circle    text-success "></i>


                
                @else
                <i class="fa fa-times-circle text-danger "></i>
            @endif
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">


</div>


@switch($rq->estado)
    @case(0)



    <a class="btn   green hidden-print margin-bottom-5 btn-block" href="{{route("requerimiento.email",$id)}}" > Enviar a aprobación JEFE
        <i class="fa fa-check"></i>
    </a>
    @break
    @case(1)


    @if($rq->usuario->jefe==\Auth::user()->id)

        <div class="row">


            <div class="col-md-6">

            <a   href="#" onclick="estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>2])}}')" class="btn green btn-block">
                <i class="glyphicon glyphicon-ok"></i> Aprobar </a>

            </div>

            <div class="col-md-6">


            <a  href="#" onclick="estado('{{route('requerimiento.editar_estado',['id'=>$rq->id ,'estado'=>3])}}')"  class="btn red btn-block">
            <i class="glyphicon glyphicon-remove"></i> Denegar</a>
            </div>




        </div>

        @else
        @canatleast(['crear.rq'])

        <a class="btn   green hidden-print margin-bottom-5 btn-block" href="{{route("requerimiento.email",$rq->id)}}"> Volver a Enviar a aprobación JEFE
            <i class="fa fa-check"></i>
        </a>


        @endcanatleast
    @endif





    @break
    @endswitch

