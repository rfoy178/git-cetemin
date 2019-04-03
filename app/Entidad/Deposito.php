<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use App\User;
 use Carbon\Carbon;

 class Deposito extends Entity
{
    protected $table = 'deposito';




     protected $fillable = [ 'dinero_id',
'dni',
'nombre',
'cargo',
'banco',
'cta',
'monto',
'fecha_deposito',
'operacion'
];

     function setFechaDepositoAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         $this->attributes['fecha_deposito']=Carbon::parse($dateFormat);
     }


     function getFechaDepositoAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         return $dateFormat;
     }


}
