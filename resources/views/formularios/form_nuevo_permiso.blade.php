

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Nuevo permiso</h4>
		</div>
		<div class="modal-body">




			<div class="form-body">
				<form   action="{{ url('asignar_permiso') }}"  method="post" id="f_asignar_permiso" class="formentrada"  >

				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

				<div class="form-group">
					<label class="col-md-3 control-label">Rol*</label>
					<div class="col-md-9">

						<select id="rol_sel" name="rol_sel" class="form-control" required>
							@foreach($roles as $rol)
								<option value="{{ $rol->id }}">{{ $rol->name }}</option>
							@endforeach
						</select>

					</div>
				</div>


				<div class="form-group">
					<label class="col-md-3 control-label">Permiso</label>
					<div class="col-md-9">

						<select id="permiso_rol" name="permiso_rol" class="form-control" required>
							@foreach($permisos as $permiso)
								<option value="{{ $permiso->id }}">{{ $permiso->name }}</option>
							@endforeach
						</select>

					</div>
				</div>

					<button type="submit" class="btn btn-primary">Agregar Permiso</button>

				</form>



				<form   action="{{ url('crear_permiso') }}"  method="post" id="f_crear_permiso" class="formentrada"  >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">




					<div class="col-md-12">
						<div class="form-group">
							<label class="col-sm-2" for="apellido">Permiso*</label>
							<div class="col-sm-10" >
								<input type="text" class="form-control" id="permiso_nombre" name="permiso_nombre" " required >
							</div>
						</div><!-- /.form-group -->

					</div><!-- /.col -->

					<div class="col-md-12">
						<div class="form-group">
							<label class="col-sm-2" for="apellido">Slug*</label>
							<div class="col-sm-10" >
								<input type="text" class="form-control" id="permiso_slug" name="permiso_slug" " required >
							</div>
						</div><!-- /.form-group -->

					</div><!-- /.col -->

					<div class="col-md-12">
						<div class="form-group">
							<label class="col-sm-2" for="apellido">Descripcion*</label>
							<div class="col-sm-10" >
								<input type="text" class="form-control" id="permiso_descripcion" name="permiso_descripcion" " required >
							</div>
						</div><!-- /.form-group -->

					</div><!-- /.col -->




					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Crear Nuevo Permiso</button>
					</div>




				</form>


				@foreach($roles as $rol)

					<div class="table-responsive" >

						<table  class="table table-hover table-striped" cellspacing="0" width="100%">

							<thead>
							<th colspan="5" style="text-align: center; background-color: #b8ccde;" >Permisos del Usuario {{ $rol->name }}</th>
							</thead>
							<thead>
							<th>codigo</th>
							<th>nombre</th>
							<th>slug</th>
							<th>descripcion</th>
							<th>Acción</th>

							</thead>
							<tbody>


							@foreach($rol->permissions as $permiso)


								<tr role="row" class="odd" id="filaP_{{ $permiso->id }}">
									<td>{{ $permiso->id }}</td>
									<td><span class="label label-default">{{ $permiso->name or "Ninguno" }}</span></td>
									<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"></i>&nbsp;&nbsp;{{ $permiso->slug  }}</a></td>
									<td>{{ $permiso->description }}</td>
									<td>
										<button type="button"  class="btn  btn-danger btn-xs"  onclick="borrar_permiso({{ $rol->id }},{{ $permiso->id }});"  ><i class="fa fa-fw fa-remove"></i></button>
									</td>
								</tr>

							@endforeach
							</tbody>
						</table>

					</div>
				@endforeach


			</div>


		</div>









