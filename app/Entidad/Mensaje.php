<?php

namespace App\Entidad;

use App\Entidad\Entity;

class Mensaje extends Entity
{
    protected $table="mensajes";
    protected $fillable = ['mensaje','leido','user_id','rq_id','log_id'];
}
