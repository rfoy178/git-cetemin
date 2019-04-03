<?php
namespace App\Entidad;
 use App\Entidad\Entity;

 class SapAlumno extends Entity
{
    protected $table = 'sap_orden';




     protected $fillable = ['id','nombre1','nombre2','ape_pat','ape_mat','dni'];

}
