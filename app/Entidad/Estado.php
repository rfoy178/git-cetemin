<?php

namespace App\Entidad;

use App\Entidad\Entity;

class Estado extends Entity
{

protected $table="sap_estados";
    protected $fillable = ['name','class'];
}
