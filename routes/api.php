<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('migrar_socios_json', [
    'as' => 'migrar_socios_json', 'uses' => 'ApiController@migrar_socios_json_post'
]);
Route::post('migrar_rq_json', [
    'as' => 'migrar_rq_json_post', 'uses' => 'ApiController@migrar_rq_json_post'
]);

Route::post('migrar_pago_efectuados_json', [
    'as' => 'migrar_pago_efectuados_json_post', 'uses' => 'ApiController@migrar_pago_efectuados_json_post'
]);



Route::post('migrar_caja_json', [
    'as' => 'migrar_caja_json_post', 'uses' => 'ApiController@migrar_caja_json_post'
]);


Route::get('siga_marcas/{inicio}/{fin}', [
    'as' => 'siga_marcas', 'uses' => 'ApiController@siga_marcas'
]);
