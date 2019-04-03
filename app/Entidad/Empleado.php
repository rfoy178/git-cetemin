<?php
namespace App\Entidad;
 use App\Entidad\Entity;

 class Empleado extends Entity
{
    protected $table = 'empleado';
     protected $fillable = [
         'dni',
         'nombre'
     ];
}
