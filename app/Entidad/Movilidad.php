<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use App\User;
 use Carbon\Carbon;

 class Movilidad extends Entity
{
    protected $table = 'mov_detalle';




     protected $fillable = [ 'detalle_id','fecha','concepto','monto'];

     function setFechaAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         $this->attributes['fecha']=Carbon::parse($dateFormat);
     }


     function getFechaAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         return $dateFormat;
     }


}
