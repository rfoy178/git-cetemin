<?php
namespace App\Entidad;
use App\Entidad\Entity;
use App\User;
use Carbon\Carbon;

class TextoA extends Entity
{
    protected $table = 'texto';
    protected $fillable = [ 'nombre','user_id','cuenta_id','ope','fecha'];



    public function usuario(){
        return $this->belongsTo(User::getClass(),"user_id");
    }




    function setFechaAttribute($date)
    {
        $datePartes = explode("-",$date);
        $dateFormat = $datePartes[2]."-".$datePartes[1]."-".$datePartes[0];
        $this->attributes['fecha']=Carbon::parse($dateFormat);
    }


    function getFechaAttribute($date)
    {

        if(isset($date)){
            $datePartes = explode("-", $date);
            $dateFormat = $datePartes[2] . "-" . $datePartes[1] . "-" . $datePartes[0];
        }else {
            $dateFormat="";
        }

        return $dateFormat;
    }

}
