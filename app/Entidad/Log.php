<?php

namespace App\Entidad;

use App\Entidad\Entity;
use Illuminate\Support\Carbon;

class Log extends Entity
{

protected $table="log";
    protected $fillable = ['tipo','requerimiento_id','accion_id','user_id','detalle','mensaje_id','caja_id'];

    public function accion(){
        return $this->belongsTo(Accion::getClass(),"accion_id");
    }


    public function mensaje(){
        return $this->belongsTo(Mensaje::getClass(),"log_id");
    }


    public function getDiferenciaAttribute() {

        Carbon::setLocale('es');

        $dt = Carbon::parse($this->created_at);

        return $dt->diffForHumans();


        // return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}
