<?php
namespace App\Entidad;
 use App\Entidad\Entity;

 class Proveedor extends Entity
{
    protected $table = 'proveedor';
     protected $fillable = [
         'ruc',
         'razon_social','estado','mensaje','primer_nombre',
'segundo_nombre',
'apellido_paterno',
'apellido_materno','tipo'

     ];

}
