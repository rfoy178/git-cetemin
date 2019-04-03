<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use App\User;
 use Carbon\Carbon;

 class Solicitud extends Entity
{
    protected $table = 'dinero';




     protected $fillable = [ 'estado', 'mensaje_jefe','fecha_necesaria','tipo','area_id',
 'prioridad',
 'destino',
 'estadia',
 'centro_id',
 'descripcion',
 'dni',
 'nombre',
 'cargo',
 'banco',
 'cta',
 'aprobacion',
'fecha_aprobacion',
'aprobacion_code','email','caja'
];

     function setFechaNecesariaAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         $this->attributes['fecha_necesaria']=Carbon::parse($dateFormat);
     }


     function getFechaNecesariaAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         return $dateFormat;
     }


     function getFechaAprobacionAttribute($date)
     {
         if(isset($date)){
             $dia=substr($date,0,10);
             $datePartes = explode("-",$dia);
             $hora=substr($date,10,10);
             $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0]." ".$hora;
         }else{
             $dateFormat="";
         }
         return $dateFormat;
     }


     public function deposito(){
         return $this->belongsTo(Deposito::getClass(),"id","dinero_id");
     }
     public function area(){
         return $this->belongsTo(Area::getClass(),"area_id");
     }

     public function estados(){
         return $this->belongsTo(Estado::getClass(),"estado");
     }

     public function usuario(){
         return $this->belongsTo(User::getClass(),"user_id");
     }
}
