<form role="form"  action="{{ url('crear_usuario') }}"  method="post" id="f_crear_usuario" class="formentrada" >

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
</div>
<div class="modal-body">




    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="form-body">


<div class="form-group">
    <label class="col-md-3 control-label">Nombres</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres"  required >
    </div>
</div>


<div class="form-group">
    <label class="col-md-3 control-label">Apellidos</label>
    <div class="col-md-9">
        <input class="form-control" id="apellidos" name="apellidos" type="text" required  placeholder="Apellidos">
    </div>
</div>


<div class="form-group">
    <label class="col-md-3 control-label">Telefono</label>
    <div class="col-md-9">
        <input type="text" class="form-control" id="telefono" name="telefono" required placeholder="Telefono">
    </div>
</div>

<hr>
<h4>Datos de Acceso</h4>

        <div class="form-group">
            <label class="col-md-3 control-label">Email</label>
            <div class="col-md-9">
                <input type="email" class="form-control" id="email" name="email"  required placeholder="Email">
            </div>
        </div>



        <div class="form-group">
            <label class="col-md-3 control-label">Contraseña</label>
            <div class="col-md-9">
                <input type="password" class="form-control" id="password" name="password"  required >
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Area</label>
            <div class="col-md-9">
                <select id="area" name="area" class="form-control" >
                    <option value=""></option>
                    @foreach($area as $item)
                        <option value="{{$item->id}}">{{$item->area}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-3 control-label">Aprueba</label>
            <div class="col-md-9">
                <select id="jefe" name="jefe" class="form-control" >
                    <option value=""></option>
                    @foreach($jefes as $item)
                     <option value="{{$item->id}}">{{$item->name}} {{$item->apellidos}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
</form>
