<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use Illuminate\Support\Carbon;

 class RqDetalle extends Entity
{
    protected $table = 'rq_detalle';

     protected $fillable = ['id',
         'articulo_id',
         'cantidad',
         'referencia',
         'linea',
         'sucursal',
         'modalidad',
         'especialidad',
         'admision',
         'requerimiento_id',
         'articulo_nombre',
         'fecha_doc',
         'centro_id',
         'servicio','precio_referencial','total_referencial','unidad'];

     function getCreatedAtAttribute($date)
     {
         //  dd($date);
         if(($date!=null))
             return Carbon::parse($date)->format('d-m H:i');

     }

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

     public function cc()
     {
         return $this->hasMany(RqCC::getClass(),"detalle_id","id");
     }



 }
