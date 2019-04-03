<?php
namespace App\Entidad;
 use App\Entidad\Entity;

 class Centro extends Entity
{
    protected $table = 'centro';
     protected $fillable = ['Linea',
'LineaCode',
'Sede',
'SedeCode',
'ModalidadCode',
'Especialidad',
'EspecialidadCode',
'Admision',
'AdmisionCode',
'Usuario_id'];

}
