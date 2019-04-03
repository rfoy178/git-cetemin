<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use Carbon\Carbon;

 class Rendir extends Entity
{
    protected $table = 'rendir';

     protected $fillable = [ 'fecha','caja',
        'tipo',
        'serie',
        'ruc',
        'proveedor',
        'centro',
         'concepto',
        'monto',
         'deposito_id',
         'fecha_contable',
'servicio_id',
'impuesto',
         'docEntry',
'docNum',
'sap','sap_p','cardcode','mensaje_sap'
];

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

     function setFechaContableAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         $this->attributes['fecha_contable']=Carbon::parse($dateFormat);
     }


     function getFechaContableAttribute($date)
     {

         if(isset($date)){
             $datePartes = explode("-",$date);
             $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
             return $dateFormat;
         }else{
             return $date;

         }




     }

     public function iva(){
         return $this->belongsTo(Iva::getClass(),"impuesto","id");
     }
     public function tipo(){
         return $this->belongsTo(TipoComprobante::getClass(),"tipo");
     }

     public function cc()
     {
         return $this->hasMany(RendirCC::getClass(),"rendir_id","id");
     }

     public function proveedor(){
         return $this->belongsTo(Proveedor::getClass(),"ruc","ruc");
     }


 }
