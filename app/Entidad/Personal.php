<?php
namespace App\Entidad;
use App\Entidad\Entity;

 class Personal extends Entity
{
    protected $table = 'personal_1';
    protected $primaryKey='dni';
     public  $incrementing =false;

     protected $fillable = [
         'dni',
         'nombre',
         'sede',
         'gerencia',
         'fecha_nacimiento',
         'segundo_nombre',
         'apellido_paterno',
         'apellido_materno'
     ];



 }
