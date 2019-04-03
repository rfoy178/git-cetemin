@if($rq->estado==1)

    @if($rq->usuario->jefe==\Auth::user()->id)
        <h5><b>Se solicita su aprobación de jefe directo</b></h5>
    <form action="{{route("caja.aprobacion",$rq->aprobacion_code)}}" method="POST" name="frm_e" id="frm_e">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-sm-12">
                <h5>Escriba un mensaje[Opcional]</h5>
                <textarea class="form-control" id="txtmensaje" name="txtmensaje"></textarea>
            </div>

        </div>


        <div class="row">
            <div class="form-group  col-md-12">
                <label class="col-md-2 control-label">Monto a depositar</label>
                <div class="col-md-10">
                    <input type="text" class="form-control input-sm"   required id="b_monto" name="b_monto">
                </div>
            </div>
        </div>

        <button type="button" class="btn green"  onclick="javascript:aprobar(8);">Aprobar</button>
        <button type="button" onclick="javascript:aprobar(7);" class="btn red">Denegar</button>
        <button type="button" onclick="javascript:aprobar(6);" class="btn yellow ">Observar</button>
        <input type="hidden" value="{{$rq->id}}" name="id_e" id="id_e">
        <input type="hidden" name="estado_e" id="estado_e">

    </form>
    <script language="JavaScript">
        function aprobar(x) {

            $("#estado_e").val(x);
            $("#frm_e").submit();

        }
    </script>
    @else

        <div class="alert alert-warning">
            <strong>Esperando aprobación!</strong> de jefe directo. </div>
    @endif




@endif
@if($rq->estado==7)

    <div class="note note-danger">
        <h4 class="block">Denegado!  </h4>
        <p>{{$rq->updated_at}} {{$rq->mensaje_jefe}}</p>
    </div>

@endif
@if($rq->estado==6)

    <div class="note note-warning">
        <h4 class="block">Observado!  </h4>
        <p>{{$rq->updated_at}} {{$rq->mensaje_jefe}}</p>
    </div>

@endif

@if($rq->estado==8)

    @can(['tesoreria'])

        <h5><b>Salida de dinero</b></h5>
     <form action="{{route("caja.deposito")}}" method="POST" name="frm_e" id="frm_e">
        {{ csrf_field() }}


         <div class="row">
             <label class="col-md-12"><b>Datos del beneficiario</b></label>

             <div class="form-group  col-md-12">
                 <label class="col-md-2 control-label">DNI</label>
                 <div class="col-md-4">
                     <input type="text"   class="form-control"   value="{{$rq->dni}}"   required id="dni" name="dni">
                 </div>
             </div>

             <div class="form-group  col-md-12">
                 <label class="col-md-2 control-label">Apellidos y Nombres</label>
                 <div class="col-md-10">
                     <input type="text"   class="form-control" value="{{$rq->nombre}}"    required id="nombre" name="nombre">
                 </div>
             </div>
             <div class="form-group  col-md-12">
                 <label class="col-md-2 control-label">Cargo</label>
                 <div class="col-md-10">
                     <input type="text"   class="form-control"  value="{{$rq->cargo}}"    required id="cargo" name="cargo">
                 </div>
             </div>
             <div class="form-group  col-md-12">
                 <label class="col-md-2 control-label">Banco</label>
                 <div class="col-md-2">
                     <select id="t_banco"   class="form-control"  name="t_banco">
                         <option value="BCP"   @if($rq->banco=="BCP") selected @endif  >BCP</option>
                         <option value="I"   @if($rq->banco=="I") selected @endif >Interbancaria</option>

                         <option value="EFE"   @if($rq->banco=="EFE") selected @endif >Efectivo</option>

                     </select>
                 </div>
                 <div class="col-md-8">
                     <input type="text"   class="form-control"   required id="cta" name="cta"   value="{{$rq->cta}}" >
                 </div>


             </div>

             <div class="form-group  col-md-12">
                 <label class="col-md-2 control-label">Monto S/</label>
                 <div class="col-md-4">
                     <input type="text"   class="form-control"   value="{{$rq->monto}}"   required id="monto" name="monto">
                 </div>

                 <label class="col-md-2 control-label">Fecha</label>
                 <div class="col-md-4">


                     <div class="input-group input-medium date date-picker"   data-date-format="dd-mm-yyyy" data-date-start-date="+1d">
                         <input type="text" class="form-control" readonly="" value="{{\Carbon\Carbon::now()->format("d-m-Y")}}"  required id="fecha_deposito" name="fecha_deposito">
                         <span class="input-group-btn" >
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                     </div>
                 </div>
             </div>

             <div class="form-group  col-md-12">
                 <label class="col-md-2 control-label">Operación</label>
                 <div class="col-md-4">
                     <input type="text"   class="form-control"      required id="operacion" name="operacion">
                 </div>
             </div>
         </div>






         <button type="submit" class="btn green"  >Listo</button>
         <a   href="{{route("caja.index")}}" class="btn yellow ">Esperar</a>
        <input type="hidden" value="{{$rq->id}}" name="id_e" id="id_e">


    </form>
    @else
        <div class="alert alert-warning">
            Esperando a   <strong> Tesoreria.</strong> </div>
    @endcanatleast

@endif




