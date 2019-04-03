<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use Carbon\Carbon;

 class CajaCC extends Entity
 {
    protected $table = 'caja_cc';

     protected $fillable = [ 'id',
         'cc_id',
         'porcentaje',
         'rendir_id',
         'created_at',
         'updated_at'
     ];

     public function centro(){
         return $this->belongsTo(Centro::getClass(),"cc_id");
     }
}