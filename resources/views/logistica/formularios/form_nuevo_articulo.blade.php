<style >
    .select2 {
        width:100%!important;
    }

    #tbd {
        font-size: 10px;
    }

    #tbd th{
        font-size: 10px;
    }


    #tbd td {
        font-size: 10px;
    }

    #tbd tr {
        font-size: 10px;
    }

    #tbd tbody{
        font-size: 10px;
    }

    .odd{
        font-size: 10px;

    }
</style>
<form role="form"  action="{{route('requerimiento.add_crear_articulo') }}"  method="post" id="f_crear_usuario" class="formentrada" >

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Agregar detalle</h4>
</div>
<div class="modal-body">




    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="form-body">


<div class="form-group">
    <label class="col-md-3 control-label">Articulos</label>
    <div class="col-md-9">


    </div>


</div>


        <div class="form-group">
            <label class="col-md-3 control-label">Cantidad</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="cantidad" name="cantidad" required placeholder="Cantidad">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Referencia WEB</label>
            <div class="col-md-9">
                <input type="url" class="form-control" id="web" name="web"  placeholder="Referencia Web">
            </div>
        </div>

        <h4>Centro de costos</h4>

        <table class="table table-hover table-light"  id="tbd"  >
            <thead>
            <tr class="uppercase">
                <th >  </th>

                <th  > Linea de Negocio </th>

                <th > Sede</th>
                <th > Modalidad</th>

                <th  > Especialidad</th>

                <th  > Admision </th>

            </tr>
            </thead>
            <tbody>

            @foreach($centro as $item1)
                <tr style="font-size: 12px">
                    <td> <input type="radio" name="centro" required value="{{$item1["id"]}}"> </td>
                    <td  > {{$item1["Linea"]}} </td>
                     <td   > {{$item1["Sede"]}} </td>
                     <td  > {{$item1["Modalidad"]}} </td>

                    <td  > {{$item1["Especialidad"]}} </td>

                    <td  > {{$item1["Admision"]}} </td>

                </tr>
            @endforeach

            </tbody>
        </table>






    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
</form>

<script language="javascript">







    $("#tbd").dataTable({

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