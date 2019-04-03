<?php
namespace App\Entidad;
 use App\Entidad\Entity;
 use Carbon\Carbon;

 class RqCC extends Entity
{
    protected $table = 'rq_cc';

     protected $fillable = [ 'id',
                'cc_id',
                'porcentaje',
                'detalle_id',
                'created_at',
                'updated_at','EXC_DESVIACION',
'U_EXC_MONTO',
'EXC_REAL',
'EXC_REAL_F'
     ];

     public function centro(){
         return $this->belongsTo(Centro::getClass(),"cc_id");
     }
}