
	<form   action="{{ url('crear_rol') }}"  method="post" id="f_crear_rol" class="formentrada"  >

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Nuevo Rol</h4>
		</div>
		<div class="modal-body">




			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			<div class="form-body">


				<div class="form-group">
					<label class="col-md-3 control-label">Nombre del Rol*</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="rol_nombre" name="rol_nombre"  required placeholder="Nombre Rol" >
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-3 control-label">Etiqueta</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="rol_slug" name="rol_slug"  required placeholder="Slug" >
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-3 control-label">Descripción</label>
					<div class="col-md-9">
						<input  type="text" class="form-control" id="rol_descripcion" name="rol_descripcion"  required placeholder="Descripción"  >
					</div>
				</div>



			</div>


		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</div>


	</form>

	<div class="modal-body">

	<div class="table-responsive" >

		<table  class="table table-hover table-striped" cellspacing="0" width="100%">
			<thead>
			<tr>    <th>codigo</th>
				<th>nombre</th>
				<th>slug</th>
				<th>descripcion</th>
				<th>Acción</th>
			</tr>
			</thead>
			<tbody>

			@foreach($roles as $rol)
				<tr role="row" class="odd" id="filaR_{{  $rol->id }}">
					<td>{{ $rol->id }}</td>
					<td><span class="label label-default">{{ $rol->name or "Ninguno" }}</span></td>
					<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $rol->slug  }}</a></td>
					<td>{{ $rol->description }}</td>
					<td>
						<button type="button"  class="btn  btn-danger btn-xs" onclick="borrar_rol({{ $rol->id }});"   ><i class="fa fa-fw fa-remove"></i></button>
					</td>
				</tr>
			@endforeach



			</tbody>
		</table>

	</div>


</div>