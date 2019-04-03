<?php

namespace App\Exports;

use App\Entidad\VistaPagosEfectuadosExcel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BancoExport implements FromView,ShouldAutoSize
{
    //use Exportable;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

   /* public function query()
    {

$sql=;
          return $sql;


        //return Invoice::query()->whereYear('created_at', );
    }*/

    public function view(): View
    {
        return view('caja.excel', [
            'rq' => VistaPagosEfectuadosExcel::query()->where("txt","=",$this->year)->get()
        ]);
    }

}


