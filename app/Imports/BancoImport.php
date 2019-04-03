<?php

namespace App\Imports;

use App\Entidad\Texto;
use App\Entidad\TextoA;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BancoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $cant=count($rows);
        for ($x = 1; $x < $cant; $x++) {
            $rq= (int)$rows[$x][5];
            $t=Texto::where("requerimiento_id",$rq)->first();
            $t->estado=3;
            $t->monto=$rows[$x][7];;

            $t->save();
        }



     }
}
