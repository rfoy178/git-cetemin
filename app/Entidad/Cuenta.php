<?php namespace App\Entidad;
use Carbon\Carbon;

class Cuenta extends Entity {

    protected $table = 'cuentas';
    protected $fillable = ['abreviatura','nombre','estado','contable'];
    //protected $auditStrict = true;
    public function getModel()
    {
        return new Cuenta();
    }
    function getCreatedAtAttribute($date)
    {
        if(isset($date)){


            return Carbon::parse($date)->format('d-m-Y');



        }else{
            return $date;
        }


    }



}
