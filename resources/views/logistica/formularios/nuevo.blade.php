
@can(['crear.rq'])
<form role="form"  action="{{route('rq.store') }}"  method="post" id="frmNuevox"   >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Requerimiento</h4>
    </div>
    <div class="modal-body">

        <div id="divAlert" class="alert alert-warning  " style="display: none">
            <strong>Atención! </strong> Está incumpliendo un procedimiento de CETEMIN, esto será considerado en sus KPI.</div>
        <div class="row">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">AREA</label>
                <div class="col-md-9">
                    <select class="form-control" id="cboArea" name="cboArea" required>
                        @foreach($area as $item)
                            <option value="{{$item->id}}">{{$item->abreviatura}} {{$item->area}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Fecha Necesaria</label>
                <div class="col-md-6">
                    <div class="input-group input-medium date date-picker"   data-date-format="dd-mm-yyyy" data-date-start-date="{{$endDate}}">


                        <input type="text" class="form-control" readonly=""   required id="fecharq" name="fecharq">
                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                    </div>
                </div>

                <label class="mt-checkbox col-md-3 red   ">
                    <input type="checkbox" value="1"  name="urgente" id="urgente"> Urgente
                    <span></span>
                </label>


            </div>

             <div class="form-group">
                <label class="col-md-3 control-label">Tipo</label>
                <div class="col-md-9">
                    <select class="form-control" id="tiporq" name="tiporq"  required>
                        <option value="I">Articulo</option>
                        <option value="S">Servicio</option>
                    </select>
                </div>
            </div>
            <input id="prioridad" name="prioridad" type="hidden" value="1">

            <div class="form-group">
                <label class="col-md-3 control-label">Motivo</label>
                <div class="col-md-9">
                    <textarea id="comentario" name="comentario" class="form-control" rows="3"  required></textarea>
                </div>
            </div>

        </div>
    </div>

        <div class="alert alert-info">
            <strong>Info! </strong>La fecha necesaria es informativa, logistica atendera su RQ como maximo en 10 dias habiles despues de la aprobación del jefe directo. </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
<script language="javascript">
    $(".date-picker").datepicker({
        language: 'es',
        daysOfWeekDisabled: '0,6'

    });


    $("#urgente").change(function() {
         if(this.checked) {
             $("#fecharq").val("");

                $("#divAlert").show();
             $(".date-picker").datepicker('remove');

             $(".date-picker").datepicker({
                 language: 'es',
                 startDate: '0d',
                 datesDisabled:['25-12-2018','01-01-2019']

             });

        }else{
             $("#fecharq").val("");

             $("#divAlert").hide();
             $(".date-picker").datepicker('remove');
             $(".date-picker").datepicker({
                 language: 'es',
                 daysOfWeekDisabled: '0,6',
                 datesDisabled:['25-12-2018','01-01-2019']
             });
        }


    });


</script>
@else

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Requerimiento</h4>
    </div>
    <div class="modal-body">



     <div class="note note-danger">
            <h4 class="block">Alerta! </h4>
            <p>  Ud. no tiene permiso para ver esto  </p>
        </div>
    @endcanatleast
    </div>
