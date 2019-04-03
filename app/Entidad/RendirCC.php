<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use Carbon\Carbon;

 class RendirCC extends Entity
{
    protected $table = 'rendir_cc';

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