@extends('layout.app4')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

	

<div class="box box-primary box-gris">

     <div class="box-header">
        <h4 class="box-title">Usuarios</h4>	        
        <form   action="{{ url('buscar_usuario') }}"  method="post"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
				<div class="input-group input-group-sm">
					<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>

				</div>
						
        </form>


		<div class="margin" id="botones_control">
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(1);">Agregar Usuario</a>
              <a href="{{ url("/listado_usuarios") }}"  class="btn btn-xs btn-primary" >Listado Usuarios</a> 
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(2);">Roles</a> 
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(3);" >Permisos</a>                                 
		</div>

    </div>

<div class="box-body box-white">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
				<thead>
						<tr>    <th>codigo</th>
								<th>Rol</th>
								<th>Nombre</th>
								<th>Email</th>
							    <th>Acción</th>
						</tr>
				</thead>
	    <tbody>

	    @foreach($usuarios as $usuario)
		<tr role="row" class="odd">
			<td>{{ $usuario->id }}</td>
			<td><span class="label label-default">
             
             @foreach($usuario->getRoles() as $roles)
			 {{  $roles.","  }}
             @endforeach
           
             -</span>
			</td>
			<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"  style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $usuario->name  }}</a></td>
			<td>{{ $usuario->email }}</td>
			<td>
			
			<button type="button" class="btn  btn-default btn-xs" onclick="verinfo_usuario({{  $usuario->id }})" ><i class="fa fa-fw fa-edit"></i></button>
			<button type="button"  class="btn  btn-danger btn-xs"  onclick="borrado_usuario({{  $usuario->id }});"  ><i class="fa fa-fw fa-remove"></i></button>
			<a href="{{route("requerimiento.centro",$usuario->id)}}">Centro</a>

			</td>
		</tr>
	    @endforeach



		</tbody>
		</table>

	</div>
</div>




{{ $usuarios->links() }}

@if(count($usuarios)==0)


<div class="box box-primary col-xs-12">

<div class='aprobado' style="margin-top:70px; text-align: center">
 
<label style='color:#177F6B'>
              ... no se encontraron resultados para su busqueda...
</label> 

</div>

 </div> 


@endif

</div></section>


<!--
<div id="capa_modal" class="div_modal" style="display: none;"></div>
<div id="capa_formularios" class="div_contenido" style="display: none;"></div>

-->
<div class="modal fade" id="modalFormulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content"  id="capa_formularios">
		</div>
	</div>
</div>


<div style="display: none;" id="cargador_empresa" align="center">
	<br>
	<label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

	<img src="{{ url('/img/cargando.gif') }}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>

	<br>
	<hr style="color:#003" width="50%">
	<br>
</div>

@endsection
@section ('script')
	<script src="{{ asset('/js/plusis.js') }}" type="text/javascript"></script>

@endsection