<?php
namespace App\Entidad;
 use App\Entidad\Entity;

 class Texto extends Entity
{
    protected $table = 'caja_texto';
     protected $fillable = [ 'requerimiento_id','cuenta_id','estado','txt','monto','mensaje_sap','docEntry'];

     public function rq(){
         return $this->belongsTo(Solicitud::getClass(),"requerimiento_id");
     }
     public function cuenta(){

         return $this->belongsTo(Cuenta::getClass(),"cuenta_id");

     }




}
