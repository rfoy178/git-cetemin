<style >
    .select2 {
        width:100%!important;
    }
</style>
<form role="form"  action="{{route('requerimiento.edit_crear_articulo') }}"  method="post" id="f_crear_usuario" class="formentrada" >

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Actualizar</h4>
</div>
<div class="modal-body">




    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

    <input type="hidden" name="tipo" value="{{$tipo}}" id="tipo">

    <div class="form-body">
        <input type="hidden" id="id" name="id" value="{{$detalle->id}}"">

        <input type="hidden" id="nameArticuloX" name="nameArticuloX" value="{{$detalle->articulo_nombre}}"">
        <input type="hidden" id="requerimiento_id" name="requerimiento_id" value="{{$detalle->requerimiento_id}}">

        @if($detalle->articulo_id=="NUEVO")
            <div class="alert alert-warning">
                <strong>Alerta!</strong> Cambie el articulo/servicio por uno existente. </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Articulos</label>
                <div class="col-md-9">

                    <div id="dcboArticulo"  class="xx">
                        <select class="form-control" id="cboArticuloE"  name="cboArticuloE">
                        </select>
                    </div>
                </div>


            </div>
        @else


            @if($tipo=='I')
            <div class="form-group">
                <label class="col-md-3 control-label">Articulos</label>
                <div class="col-md-9">
                    <input type="hidden" id="cboArticulo" name="cboArticulo" value="{{$detalle->articulo_id}}">
                    <input type="text" disabled="disabled" value="{{$detalle->articulo_nombre}}" class="form-control" name="cantidad" >

                </div>
            </div>
            @else
                <div class="form-group">
                    <label class="col-md-3 control-label">Servicio</label>
                    <div class="col-md-9">
                        <input type="hidden" id="cboArticulo" name="cboArticulo" value="{{$detalle->articulo_id}}">
                        <input type="text" disabled="disabled" value="{{$detalle->servicio}}" class="form-control" name="servicio" >

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tipo </label>
                    <div class="col-md-9">
                         <input type="text" disabled="disabled" value="{{$detalle->articulo_nombre}}" class="form-control" name="cantidad" >

                    </div>
                </div>
            @endif


        @endif

        @if($detalle->articulo_id!="NUEVO")

        <div class="form-group">
            <label class="col-md-3 control-label">Cantidad</label>
            <div class="col-md-9">
                <input type="text" value="{{$detalle->cantidad}}" class="form-control" id="cantidad" name="cantidad" required placeholder="Cantidad">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Referencia WEB</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="web" name="web" value="{{$detalle->referencia}}"  placeholder="Referencia Web">
            </div>
        </div>


        @endif

    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
</form>

<script language="javascript">


    $('#cboArticuloE').select2({
        minimumInputLength: 3,
        ajax: {
            method:'GET',
            dataType: 'json',
            url: '{{route("api.item",['id'=>$tipo,'id2'=>$detalle->requerimiento_id])}}',
            processResults: function (data) {
                return {
                    results: $.map(data, function(obj) {
                        $("#cboArticuloE").text("");

                        return { id: obj.ItemCode, text: obj.ItemCode + " " + obj.ItemName };
                    })
                };
            }
        }
    });









    $(document).on('change', '#cboArticuloE', function(event) {

       $("#idArticuloX").val($("#cboArticuloE").val());
        $("#nameArticuloX").val($("#cboArticuloE").text());

    });

    $(document).on('click', '#btnmostar', function(event) {

        $(".xx").toggle();

    });


    $( "#nArticulo" ).change(function() {
        $("#idArticulo").val("NUEVO");
        $("#nameArticulo").val($(this).val());
    });


</script>