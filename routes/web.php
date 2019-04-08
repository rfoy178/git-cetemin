<?php







Route::get('aprobacion_caja/{aprobacion_code}', [
    'as' => 'caja.aprobacionget', 'uses' => 'Caja\CajaController@aprobacion'
]);



Route::get('aprobacion_rq/{aprobacion_code}', [
    'as' => 'rq.aprobacionget', 'uses' => 'Logistica\RequerimientoController@aprobacion'
]);


Route::get('ruc2', [
    'as' => 'ruc2', 'uses' => 'ApiController@ruc2'
]);






/*
Route::get('migrar_socios', [
    'as' => 'migrar_socios', 'uses' => 'ApiController@migrar_socios'
]);
*/




Route::get('migrar_socios_json', [
    'as' => 'migrar_socios_json', 'uses' => 'ApiController@migrar_socios_json'
]);

Route::get('migrar_rq_json', [
    'as' => 'migrar_rq_json', 'uses' => 'ApiController@migrar_rq_json'
]);


Route::get('migrar_pago_efectuados_json', [
    'as' => 'migrar_pago_efectuados_json', 'uses' => 'ApiController@migrar_pago_efectuados_json'
]);

Route::get('migrar_caja_json', [
    'as' => 'migrar_caja_json', 'uses' => 'ApiController@migrar_caja_json'
]);


Route::post('mensaje_jefe_rq', [
    'as' => 'requerimiento.mensaje_jefe', 'uses' => 'Logistica\RequerimientoController@mensaje_jefe'
]);

Route::post('mensaje_jefe_caja', [
    'as' => 'caja.mensaje_jefe', 'uses' => 'Caja\CajaController@mensaje_jefe'
]);


Route::post('api/empleado', [
    'as' => 'api.empleado', 'uses' => 'ApiController@empleado'
]);

Route::post('api/dni/{dni}', [
    'as' => 'api.dni', 'uses' => 'ApiController@dni'
]);
Route::post('api/ruc/{ruc}', [
    'as' => 'api.ruc', 'uses' => 'ApiController@ruc'
]);


Route::get('sap1', [
    'as' => 'sap1', 'uses' => 'Logistica\RequerimientoController@sap1'
]);


Route::get('api/item/{id}/{id2}', [
    'as' => 'api.item', 'uses' => 'ApiController@item'
]);
Route::get('sunat', [
    'as' => 'sunat', 'uses' => 'UsuariosController@sunat'
]);


Route::get('alumnos', [
    'as' => 'alumnos', 'uses' => 'HomeController@alumnos'
]);
Route::get('/', 'Auth2\LoginController@signin');

Route::get('/signin', 'Auth2\LoginController@signin');


Route::get('/authorize', [
    'as' => 'authorize', 'uses' => 'Auth2\LoginController@gettoken'
]);



Route::get('/mail', 'Auth2\LoginController@mail')->name('mail');


Route::get('cotizacion', [
    'as' => 'requerimiento.cotizacion', 'uses' => 'Logistica\RequerimientoController@cotizacion'
]);


Route::get('/estado', function () {
    return view ('caja.email.aprobacion');
});


Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', 'Logistica\RequerimientoController@index');

    Route::get('prueba', [
        'as' => 'prueba', 'uses' => 'PreController@prueba'
    ]);
    Route::get('presupuesto', [
        'as' => 'presupuesto', 'uses' => 'PreController@margen1'
    ]);
    Route::post('presupuesto', [
        'as' => 'presupuesto', 'uses' => 'PreController@margen2'
    ]);

    Route::get('gyp', [
        'as' => 'presupuestos', 'uses' => 'PreController@gyp'
    ]);
    Route::post('gyp_detalle', [
        'as' => 'gyp_detalle', 'uses' => 'PreController@gyp_detalle'
    ]);

    });

Route::group([ 'middleware' => 'auth'], function() {

    Route::resource('tareo', 'TareoController');



});
Route::group([ 'middleware' => 'auth'], function() {

    Route::resource('comedor', 'Comedor\ComedorController');



});



Route::group(['prefix' => 'Caja','namespace' => 'Caja','middleware' => 'auth'], function() {
    Route::resource('caja', 'CajaController');



    Route::get('descargar/{id}', [
        'as' => 'caja.descargar', 'uses' => 'CajaController@descargar'
    ]);

    Route::get('pdf/{id}', [
        'as' => 'caja.pdf', 'uses' => 'CajaController@pdf'
    ]);



    Route::post('generar_txt', [
        'as' => 'caja.generar_txt', 'uses' => 'CajaController@generar_txt'
    ]);



    Route::post('quitar_txt/{id}', [
        'as' => 'caja.quitar_txt', 'uses' => 'CajaController@quitar_txt'
    ]);


    Route::post('upload', [
        'as' => 'caja.upload', 'uses' => 'CajaController@upload'
    ]);



    Route::post('banco', [
        'as' => 'caja.banco', 'uses' => 'CajaController@banco'
    ]);
    Route::get('listado_txt/{id}', [
        'as' => 'caja.listado_txt', 'uses' => 'CajaController@listado_txt'
    ]);

    Route::post('ope/{id}', [
        'as' => 'caja.ope', 'uses' => 'CajaController@ope'
    ]);


    Route::get('edit_txt/{id}', [
        'as' => 'caja.edit_txt', 'uses' => 'CajaController@edit_txt'
    ]);



    Route::get('tesoreria', [
        'as' => 'caja.tesoreria', 'uses' => 'CajaController@tesoreria'
    ]);

    Route::get('editar_estado/{id}/{estado}', [
        'as' => 'caja.editar_estado', 'uses' => 'CajaController@editar_estado'
    ]);

    Route::post('editar_estado/{id}/{estado}', [
        'as' => 'caja.editar_estado', 'uses' => 'CajaController@editar_estadoP'
    ]);



    Route::post('aprobacion/{aprobacion_code}', [
        'as' => 'caja.aprobacion', 'uses' => 'CajaController@aprobacion'
    ]);


    Route::get('send/{id}', [
        'as' => 'caja.send', 'uses' => 'CajaController@send'
    ]);


    Route::post('deposito', [
        'as' => 'caja.deposito', 'uses' => 'CajaController@deposito'
    ]);

    Route::post('movilidad_fila', [
        'as' => 'caja.movilidad_fila', 'uses' => 'CajaController@movilidad_fila'
    ]);
    Route::post('rendir_listado', [
        'as' => 'caja.rendir_listado', 'uses' => 'CajaController@rendir_listado'
    ]);

    Route::post('movilidad_listado', [
        'as' => 'caja.movilidad_listado', 'uses' => 'CajaController@movilidad_listado'
    ]);

    Route::post('rendir_fila', [
        'as' => 'caja.rendir_fila', 'uses' => 'CajaController@rendir_fila'
    ]);
    Route::post('rendir_listado', [
        'as' => 'caja.rendir_listado', 'uses' => 'CajaController@rendir_listado'
    ]);
    Route::post('movilidad_eliminar/{id}', [
        'as' => 'caja.movilidad_eliminar', 'uses' => 'CajaController@movilidad_eliminar'
    ]);

    Route::post('caja_fila_cc', [
        'as' => 'caja.caja_fila_cc', 'uses' => 'CajaController@caja_fila_cc'
    ]);
    Route::post('caja_listado_cc', [
        'as' => 'caja.caja_listado_cc', 'uses' => 'CajaController@caja_listado_cc'
    ]);
    Route::post('caja_update_cc', [
        'as' => 'caja.caja_update_cc', 'uses' => 'CajaController@caja_update_cc'
    ]);
    Route::post('caja_eliminar_cc', [
        'as' => 'caja.caja_eliminar_cc', 'uses' => 'CajaController@caja_eliminar_cc'
    ]);

    Route::post('aplicar_todos', [
        'as' => 'caja.aplicar_todos', 'uses' => 'CajaController@aplicar_todos'
    ]);
    Route::post('update_cc', [
        'as' => 'caja.update_cc', 'uses' => 'CajaController@update_cc'
    ]);

    Route::post('rendir_listado_cc', [
        'as' => 'caja.rendir_listado_cc', 'uses' => 'CajaController@rendir_listado_cc'
    ]);
    Route::post('rendir_fila_c', [
        'as' => 'caja.rendir_fila_cc', 'uses' => 'CajaController@rendir_fila_cc'
    ]);
    Route::post('eliminar_cc', [
        'as' => 'caja.eliminar_cc', 'uses' => 'CajaController@eliminar_cc'
    ]);


    Route::post('conta', [
        'as' => 'caja.conta', 'uses' => 'CajaController@conta'
    ]);
    Route::get('sap/{id}', [
        'as' => 'caja.sap', 'uses' => 'CajaController@sap'
    ]);
    Route::post('rendicion', [
        'as' => 'caja.rendicion', 'uses' => 'CajaController@rendicion'
    ]);
    Route::post('del_articulo/{id}', [
        'as' => 'caja.del_articulo', 'uses' => 'CajaController@del_articulo'
    ]);
});

Route::group(['prefix' => 'presupuesto','middleware' => 'auth'], function() {

    Route::post('validar/{id}', [
        'as' => 'presupuesto.validar', 'uses' => 'PresupuestoController@validar'
    ]);

});
Route::group(['prefix' => 'logistica','namespace' => 'Logistica','middleware' => 'auth'], function() {



    Route::post('comentario', [
        'as' => 'rq.comentario', 'uses' => 'RequerimientoController@comentario'
    ]);





    Route::post('rendir_fila_c', [
        'as' => 'rq.rendir_fila_cc', 'uses' => 'RequerimientoController@rendir_fila_cc'
    ]);

    Route::post('rendir_listado_cc', [
        'as' => 'rq.rendir_listado_cc', 'uses' => 'RequerimientoController@rendir_listado_cc'
    ]);
    Route::post('update_cc', [
        'as' => 'rq.update_cc', 'uses' => 'RequerimientoController@update_cc'
    ]);

    Route::post('eliminar_cc', [
        'as' => 'rq.eliminar_cc', 'uses' => 'RequerimientoController@eliminar_cc'
    ]);
    Route::post('aplicar_todos', [
        'as' => 'rq.aplicar_todos', 'uses' => 'RequerimientoController@aplicar_todos'
    ]);




    Route::resource('orden', 'OrdenController');
    Route::resource('rq', 'RequerimientoController');

    Route::get('imprimir/{id}', [
        'as' => 'requerimiento.imprimir', 'uses' => 'RequerimientoController@imprimir'
    ]);

    Route::get('show_crear_articulo/{id}', [
        'as' => 'requerimiento.show_crear_articulo', 'uses' => 'RequerimientoController@show_nuevo_articulo'
    ]);

    Route::get('show_edit_articulo/{id}', [
        'as' => 'requerimiento.show_edit_articulo', 'uses' => 'RequerimientoController@show_edit_articulo'
    ]);

    Route::post('add_crear_articulo', [
        'as' => 'requerimiento.add_crear_articulo', 'uses' => 'RequerimientoController@add_nuevo_articulo'
    ]);

    Route::post('edit_crear_articulo', [
        'as' => 'requerimiento.edit_crear_articulo', 'uses' => 'RequerimientoController@edit_nuevo_articulo'
    ]);

    Route::post('rq/del_articulo/{id}', [
        'as' => 'requerimiento.del_articulo', 'uses' => 'RequerimientoController@del_articulo'
    ]);

    Route::get('rq/comparativo/{id}', [
        'as' => 'requerimiento.comparativo', 'uses' => 'RequerimientoController@comparativo'
    ]);

    Route::post('lista_articulo', [
        'as' => 'requerimiento.lista_articulo', 'uses' => 'RequerimientoController@lista_articulo'
    ]);

    Route::post('send/{id}', [
        'as' => 'requerimiento.sap', 'uses' => 'RequerimientoController@sap'
    ]);


    Route::get('estado_rq/{id}', [
        'as' => 'estado_rq', 'uses' => 'RequerimientoController@estado_rq'
    ]);
    Route::post('upload', [
        'as' => 'requerimiento.upload', 'uses' => 'RequerimientoController@upload'
    ]);

    Route::post('delete_file', [
        'as' => 'requerimiento.delete_file', 'uses' => 'RequerimientoController@delete_file'
    ]);

    Route::post('add_centro', [
        'as' => 'requerimiento.add_centro', 'uses' => 'RequerimientoController@add_centro'
    ]);
    Route::post('delete_centro', [
        'as' => 'requerimiento.delete_centro', 'uses' => 'RequerimientoController@delete_centro'
    ]);



    Route::get('editar_estado/{id}/{estado}', [
        'as' => 'requerimiento.editar_estado', 'uses' => 'RequerimientoController@editar_estado'
    ]);

    Route::post('editar_estado/{id}/{estado}', [
        'as' => 'requerimiento.editar_estado', 'uses' => 'RequerimientoController@editar_estadoP'
    ]);

    Route::get('cotizacion', [
        'as' => 'requerimiento.cotizacion', 'uses' => 'RequerimientoController@cotizacion'
    ]);

    Route::get('download_file', [
        'as' => 'requerimiento.download_file', 'uses' => 'RequerimientoController@download_file'
    ]);

    Route::get('centro/{id}', [
        'as' => 'requerimiento.centro', 'uses' => 'RequerimientoController@centro'
    ]);



    Route::get('send/{id}', [
        'as' => 'requerimiento.email', 'uses' => 'RequerimientoController@send'
    ]);

    Route::get('sendPreview/{id}', [
        'as' => 'requerimiento.emailPreview', 'uses' => 'RequerimientoController@sendPreview'
    ]);
    Route::get('estado/{id}/{estado}', [
        'as' => 'requerimiento.estado', 'uses' => 'RequerimientoController@estado'
    ]);


    Route::post('api_centro', [
        'as' => 'requerimiento.api_centro', 'uses' => 'RequerimientoController@api_centro'
    ]);

});
Route::group(['prefix' => 'proveedor','namespace' => 'Proveedor','middleware' => 'auth'], function() {
    Route::resource('proveedor', 'ProveedorController');

});
Route::post('cambiar', [
    'as' => 'cambiar', 'uses' => 'UsuariosController@postPassword'
]);


Route::get('/clima', 'PresupuestoController@margen1');
Route::get('/clima2', 'PreController@margen1');

Route::post('/margen2', 'PresupuestoController@margen2');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');
    Route::post('crear_usuario', 'UsuariosController@crear_usuario');
    Route::post('editar_usuario', 'UsuariosController@editar_usuario');
    Route::post('buscar_usuario', 'UsuariosController@buscar_usuario');
    Route::post('borrar_usuario', 'UsuariosController@borrar_usuario');
    Route::post('editar_acceso', 'UsuariosController@editar_acceso');
    Route::post('crear_rol', 'UsuariosController@crear_rol');
    Route::post('crear_permiso', 'UsuariosController@crear_permiso');
    Route::post('asignar_permiso', 'UsuariosController@asignar_permiso');
    Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso');
    Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
    Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol');
    Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso');
    Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario');
    Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario');
    Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol');
    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol');
    Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario');
    Route::get('borrar_rol/{idrol}', 'UsuariosController@borrar_rol');

});
Auth::routes();

Route::resource('recursos', 'Recursos\RecursosController');

Route::get('logout', [
    'as' => 'logout', 'uses' => '\App\Http\Controllers\Auth\LoginController@logout'
]);