<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use App\User;
 use Illuminate\Support\Carbon;

 class Rq extends Entity
{
    protected $table = 'requerimiento';

     function setFechaAttribute($date)
     {
         $datePartes = explode("-",$date);
         $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
         $this->attributes['fecha']=Carbon::parse($dateFormat);
     }


     function getFechaAttribute($date)
     {
         if(isset($date)){
             $datePartes = explode("-",$date);
             $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
             return $dateFormat;
         }else{
             return $date;
         }


     }

     public function log(){
         return $this->belongsTo(Log::getClass(),"requerimiento_id");
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
     public function detalle()
     {
         return $this->hasMany(RqDetalle::getClass(),"requerimiento_id","id");
     }

     public function getDiferenciaAttribute() {

         Carbon::setLocale('es');

         $dt = Carbon::parse($this->created_at);

         return $dt->diffForHumans();


         // return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
     }


     public function getLogisticaAttribute(){


         if(isset($this->fecha_aprobacion)){
             $sum=11;
             $holidays = ["2018-12-08", "2018-12-25", "2019-01-01"];

             $date =  Carbon::parse($this->fecha_aprobacion);

             $MyDateCarbon = Carbon::parse($date);

             $MyDateCarbon->addDay( $sum);

             for ($i = 1; $i <=  $sum; $i++) {
                 $date->addDay();
                 if ((in_array(Carbon::parse($date)->toDateString(), $holidays))||($date->isWeekend())) {
                     $MyDateCarbon->addDay();

                 }
             }

             $endDate = $MyDateCarbon->format('d-m-Y');
         }else{
             $endDate="";
         }



         return $endDate;


     }





     public function getFecha2Attribute()
     {
         Carbon::setLocale('es');

         $dt = Carbon::parse($this->fecha);

         return $dt->format('d/m/Y');



     }


     public function scopeOperador2($query, $type)
     {
         if(($type=="x")||($type==null)){
             return $query;

         }
         else{
             return $query->where('operador_id', $type);

         }

     }

     public function scopeFechas($query, $inicio,$fin)
     {


         $from = date($inicio);
         $to = date($fin);




         if(($inicio==null)||($fin==null)){
             return $query;

         }
         else{

             return $query->whereBetween('fecha_aprobacion', [$from, $to]);

         }

     }
}
